<?php

class Image_ImageController extends Zend_Controller_Action
{

    public function init(){
        /* 
        * zmienna Zend_View_Helper_Action pochodzi z przerobionego pliku Zend_View_Helper_Action linia 130
        */

        if( $this->_request->getParam( 'Zend_View_Helper_Action', 0 ) == 0 ){
            $no_layout  = (int)$this->_request->getParam( 'no_layout', 0 );
            $no_entity_template  = (int)$this->_request->getParam( 'no_entity_template', 0 );

            if( $no_layout != 0 || $no_entity_template != 0 ){
                $this->_helper->layout()->disableLayout(); 
            }

            if( $no_entity_template == 0 ){
                $this->_helper->viewRenderer->setNoController( true );				

                $this->_helper->viewRenderer('entity/object');
                $this->view->addScriptPath(APPLICATION_PATH.'/modules/entity/views/scripts/');
                $this->view->entity_script = 'image/'.$this->getRequest()->getActionName().'.phtml';
            }
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
        $form->setAction( $this->view->baseUrl( '/image/image/addimage/object/'.$album->getId() ) );

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
    
    /**
    * Metoda pomocna widoku odpowiadajaca za dodawanie obrazka
    *
    * @return void
    * @access public
    */
    public function addimageAction(){   
		$allowed_class = array(
			'Moondee_Entity_User',
			'Moondee_Entity_Attraction_Place',
			'Moondee_Entity_Attraction_Event',
			'Moondee_Image_Album'
		);
		
		$object_id  = (int) $this->_request->getParam( 'object', 0 );
		$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		
		if( !$object ){
			$this->redirect('/' );
		}
		
		$class = $object->getObjectClass();
		
		if( !in_array( $class, $allowed_class ) ){
			$this->redirect( '/' );
		}
		
		$form = new Image_Form_AddImage();
		
		if ( $form->isValid( $this->_request->getPost() ) ) { 
			if(  $form->getElement('file')->isUploaded() ){
				$image = $object->addImage( $form->getElement('file') );

				if( $class == 'Moondee_Image_Album' || $class == 'Moondee_Entity_User' ){
					$this->redirect('/album/'.$image->getAlbum() );
				}else{
					$this->redirect('/'.$object->getId().'/all-images' );
				}
			}else{
				$form->getElement('file')->addError('Wystąpił bład przy przesyłaniu pliku');
			}
		}
		
		if( $class === 'Moondee_Image_Album' ){
			$this->view->entity = Moondee_Application_Factory::getMoondeeObject( $object->getOwner() );
		}else{
			$this->view->entity = $object;
		}
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

    public function allImagesAction(){        
        $entity_id  = (int)$this->_request->getParam( 'entity', null );
        $num_images  = $this->_request->getParam( 'num', null );
		
        if( $entity_id && Moondee_Auth::hasIdentity() ){
            $entity = Moondee_Application_Factory::getMoondeeObject( $entity_id );
        }else{
            $this->redirect( '/' );
        }

        $form = new Image_Form_AddImage();
        $form->setAction( $this->view->baseUrl( '/image/image/addimage/object/'.$entity_id ) );

        $this->view->form = $form;
        
        $this->view->images = $entity->getImages( $num_images );
		
        $this->view->entity = $entity;
    }

}