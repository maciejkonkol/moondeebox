<?php

class Entity_DescriptionController extends Zend_Controller_Action
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
				$this->view->entity_script = 'description/'.$this->getRequest()->getActionName().'.phtml';
			}
		}
    }
	

	/**
     * Metoda widoku odpowiedzialnego za dodawanie opisu do obiektu
     *
     * @return void
	 * @access public
     */ 
    public function addDescriptionAction(){
        $entity_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $entity_id && Moondee_Auth::hasIdentity() ){
			$entity = Moondee_Application_Factory::getMoondeeObject( $entity_id );
		}else{
			$this->redirect( '/' );
		}
		
		$form = new Entity_Form_Description();
	
		if ( $this->_request->isPost() ) {
			$postData = $this->_request->getPost();
			
			if( $form->isValid( $postData )){
				$description = $entity->addDescription( Moondee_Auth::getIdentity()->getId(), $postData['text'] );
				$entity->saveDescriptions();
				
				$this->_helper->getHelper('Redirector')->gotoRoute( array( 'description' => $description->id ), 'description'	);
			}
			
		}
		
		$this->view->form = $form;
		$this->view->entity = $entity;
	}
	
	/**
     * Metoda widoku odpowiedzialnego za usuwanie opisu z obiektu
     *
     * @return void
	 * @access public
     */ 
    public function deletedescriptionAction(){
        $object_id  = (int)$this->_request->getParam( 'entity', null );
        $description_id  = (int)$this->_request->getParam( 'description', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			if( Zend_Auth::getInstance()->hasIdentity() ){
				$object = Zend_Auth::getInstance()->getIdentity();	
			}else{
				$this->redirect( '/' );
			}	
		}
		
		$object_to_describie = Moondee_Application_Factory::getMoondeeObject( 10 );
		$object_to_describie->deleteDescription( $description_id );
		//echo '<pre>'; print_r( $object_to_describie->getDescriptions() ); echo '</pre>';
		$object_to_describie->saveDescriptions();
		
		$this->view->entity = $object;
	}
	
	/**
     * Metoda widoku odpowiedzialnego za wyswietlanie opisów obiektów
     *
     * @return void
	 * @access public
     */ 
    public function descriptionsAction(){
        $object_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			$this->redirect( '/' );
		}
		
		$this->view->descriptions = $object->getDescriptions();
		$this->view->entity = $object;
	}
	
	/**
     * Metoda widoku odpowiedzialnego za wyswietlanie opisów obiektów
     *
     * @return void
	 * @access public
     */ 
    public function bestDescriptionAction(){
        $entity_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $entity_id ){
			$entity = Moondee_Application_Factory::getMoondeeObject( $entity_id );
		}else{
			$this->redirect( '/' );
		}
		
		$this->view->description = $entity->getBestDescription();
		
		$this->view->entity = $entity;
	}
	
	/**
     * Metoda widoku odpowiedzialnego za dodawanie oceny opisy
     *
     * @return void
	 * @access public
     */ 
    public function markDescriptionAction(){
		
		$object_id  = (int)$this->_request->getParam( 'object', null );
        $mark  = (int)$this->_request->getParam( 'mark', null );
		
		if( $object_id && ( $mark >= 0 && $mark <= 10 ) && Zend_Auth::getInstance()->hasIdentity() ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			$this->redirect( '/' );
		}
		
		
		
		$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		$this->view->result = $object->addMark( $mark );
		
		$this->view->mark = $mark;
		$this->view->description = $object;
	}
	
	/**
     * Metoda widoku odpowiedzialnego za wyswietlanie opisu
     *
     * @return void
	 * @access public
     */ 
    public function descriptionAction(){
		
		$description_id  = (int)$this->_request->getParam( 'description', null );
		
		if( $description_id ){
			$description = new Moondee_Description( $description_id );
		}else{
			$this->redirect( '/' );
		}
		
		$this->view->description = $description;
		$this->view->entity = Moondee_Application_Factory::getMoondeeObject( $description->getObjectId() );
	}
	

	
}

