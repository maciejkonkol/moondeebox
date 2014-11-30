<?php

class Entity_InformationController extends Zend_Controller_Action
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
				$this->view->entity_script = 'information/'.$this->getRequest()->getActionName().'.phtml';
			}
		}
    }
	
	
	/**
     * Metoda widoku odpowiedzialnego za wyświetlanie informacji o obiekcie
     *
     * @return void
	 * @access public
     */ 
    public function informationAction(){
        $entity_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $entity_id && Moondee_Auth::hasIdentity() ){
			$entity = Moondee_Application_Factory::getMoondeeObject( $entity_id );
		}else{
			$this->redirect( '/' );
		}
		
		switch ( $entity->getObjectClass() ) {
			case 'Moondee_Entity_Attraction_Place':
				$this->view->entity_script = 'place';
				break;
			case 'Moondee_Entity_User':
				$this->view->entity_script = 'user';
				break;
		}
		
				
		$this->view->entity = $entity;
	}
	
	
	/**
     * Metoda widoku odpowiedzialnego za wyświetlanie miejsca zamieszkania
     *
     * @return void
	 * @access public
     */ 
    public function homeAction(){
        $entity_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $entity_id && Moondee_Auth::hasIdentity() ){
			$entity = Moondee_Application_Factory::getMoondeeObject( $entity_id );
		}else{
			$this->redirect( '/' );
		}
				
		$this->view->entity = $entity;
	}
	
	
	/**
     * Metoda widoku odpowiedzialnego za wyświetlanie wszystkich informacji o obiekcie
     *
     * @return void
	 * @access public
     */ 
    public function allInformationAction(){
        $entity_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $entity_id && Moondee_Auth::hasIdentity() ){
			$entity = Moondee_Application_Factory::getMoondeeObject( $entity_id );
		}else{
			$this->redirect( '/' );
		}
		//$this->_helper->layout()->disableLayout(); 
		//$this->_helper->viewRenderer('information/'.$this->getRequest()->getActionName() );
		$this->view->entity = $entity;
	}
	

	
}

