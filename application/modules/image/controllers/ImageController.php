<?php

class Image_ImageController extends Zend_Controller_Action
{

    public function init(){
        
		$no_layout  = (int)$this->_request->getParam( 'no_layout', 0 );
		$no_entity_template  = (int)$this->_request->getParam( 'no_entity_template', 0 );
		
		if( $no_layout != 0 || $no_entity_template != 0 ){
			$this->_helper->layout()->disableLayout(); 
		}
		
		if( $no_entity_template == 0 ){
			$this->_helper->viewRenderer->setNoController( true );
			$this->view->addBasePath( APPLICATION_PATH.'/modules/entity/views/' );
			
			//$this->_helper->viewRenderer->renderBySpec( 'object', array( 'module' => 'entity', 'controller' => 'entity' )); 

			$this->_helper->viewRenderer('entity/object');
			
			$this->view->entity_script = 'image/'.$this->getRequest()->getActionName().'.phtml';
		}
    }

    public function indexAction(){
        $object_id  = (int)$this->_request->getParam( 'object', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			$this->redirect('');			
		}
		
		
		$this->view->user = $object;
		$this->view->entity = $object;
    }

    public function addalbumAction(){
        $album_name  = (string) $this->_request->getParam( 'album', null );
		$user = Zend_Auth::getInstance()->getIdentity();
		
		$this->view->form = new Image_Form_AddAlbum();
		
		if( $album_name ){
			$user->addAlbum( $album_name );		
			$user->saveAlbums();
			
			$this->redirect('/albums');
		}
		
		$this->view->user = $user;
		$this->view->entity = $user;
		
    }

    public function albumsAction(){
		$object_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			$this->redirect('');			
		}
		
		$this->view->albums = $object->getAlbums();
        
		$this->view->user = $object;
		$this->view->entity = $object;
    }

    public function albumAction(){
        
		$album_id  = (int) $this->_request->getParam( 'album', null );
		$user = Zend_Auth::getInstance()->getIdentity();
		
		$album = $user->getAlbum( $album_id );
		$images = $album->getImages();
		
		$form = new Image_Form_AddImage();
		$form->setAction( $this->view->baseUrl( '/image/image/addimage/album/'.$album->getId() ) );
        
		$this->view->form = $form;
		$this->view->images = $images;
		$this->view->album = $album;
		$this->view->user = $user;
		$this->view->entity = $user;
    }

    public function deletealbumAction(){
        
		$album_id  = (int) $this->_request->getParam( 'album', null );
		$user = Zend_Auth::getInstance()->getIdentity();
		
		$user->deleteAlbum( $album_id );
		$user->saveAlbums();
        
		$this->view->user = $user;
		$this->view->entity = $user;
    }

    public function addimageAction(){        
		$album_id  = (int) $this->_request->getParam( 'album', null );
		$user = Zend_Auth::getInstance()->getIdentity();
		
		$form = new Image_Form_AddImage();
		
		$album = $user->getAlbum( $album_id );
				
		
		
		if ( $this->_request->isPost() ) {
			if ( $form->isValid( $this->_request->getPost() ) ) { 
				if( $form->getElement('file')->isUploaded() ){
					$album->addImage( $form->getElement('file') );
					
					$this->redirect('/album/'.$album->getId() );
				}else{
					$form->getElement('file')->addError('Wystąpił bład przy przesyłaniu pliku');
				}
			}
		}
		
		$this->view->entity = $user;
		$this->view->form = $form;
    }

    public function deleteimageAction(){        
		$image_id  = (int) $this->_request->getParam( 'image', null );
		$user = Zend_Auth::getInstance()->getIdentity();
		
		$user->deleteImage( $image_id );
		
		$this->view->entity = $user;
    }

    public function introImagesAction(){        
		$entity_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $entity_id && Moondee_Auth::hasIdentity() ){
			$entity = Moondee_Application_Factory::getMoondeeObject( $entity_id );
		}else{
			$this->redirect( '/' );
		}
		
		$this->view->entity = $entity;
    }

}