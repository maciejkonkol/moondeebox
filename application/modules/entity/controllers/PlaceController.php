<?php

class Entity_PlaceController extends Zend_Controller_Action
{

    public function init(){
        $no_layout  = (int)$this->_request->getParam( 'no_layout', 0 );
		$no_entity_template  = (int)$this->_request->getParam( 'no_entity_template', 0 );
		
		if( $no_layout != 0 || $no_entity_template != 0 ){
			$this->_helper->layout()->disableLayout(); 
		}
		
		if( $no_entity_template == 0 ){
			$this->_helper->viewRenderer->setNoController( true );
			$this->_helper->viewRenderer('entity/object');
			$this->view->entity_script = 'place/'.$this->getRequest()->getActionName().'.phtml';
		}
		
    }
	
	/**
     * Metoda widoku odpowiedzialnego za wyswietlanie miejsc nalezacych do obiektu
     *
     * @return void
	 * @access public
     */ 
    public function indexAction(){
        $object_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			if( Zend_Auth::getInstance()->hasIdentity() ){
				$object = Zend_Auth::getInstance()->getIdentity();	
			}else{
				$this->redirect( '/' );
			}	
		}
		
		$this->view->places = $object->getActivePlaces();
		$this->view->entity = $object;
    }
	
	/**
     * Metoda widoku odpowiedzialnego za dodawanie nowego miejsca
     *
     * @return void
	 * @access public
     */ 
    public function addplaceAction(){
        $object_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			if( Zend_Auth::getInstance()->hasIdentity() ){
				$object = Zend_Auth::getInstance()->getIdentity();	
			}else{
				$this->redirect( '/' );
			}	
		}
		
		$form = new Entity_Form_AddPlace();
		
		if ( $this->_request->isPost() ) {
			$postData = $this->_request->getPost();
			
			if( $form->isValid( $postData )){
				$place_params = array();
				
				$place_params['name'] = $postData['name'];
				$place_params['public'] = $postData['public'];
				
				$place = Moondee_Entity_Helper::addPlace( $object->getId(), $place_params );		
				
				//$this->_forward( $action, $controller, $module, ( 'entity' => $place->getId() ) );
				//$this->view->url();
				
				$this->_redirector = $this->_helper->getHelper('Redirector');
				$this->_redirector->gotoRoute(
						array('entity' => $place->getId() ),
						'object-menu-getDesktop'
				);
			}			
		}
		echo $this->view->url( array( 'entity' => $object->getId() ), 'place') ;
		
		$this->view->form = $form;
		$this->view->entity = $object;
    }
	

	
}

