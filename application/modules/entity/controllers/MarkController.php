<?php

class Entity_MarkController extends Zend_Controller_Action
{

    public function init(){
        $this->_helper->viewRenderer->setNoController( true );
        $this->_helper->viewRenderer('entity/object');
		
		
		$this->view->object_script = 'mark/'.$this->getRequest()->getActionName().'.phtml';
    }
	
	/**
     * Metoda widoku odpowiedzialnego za dodawanie oceny do obiektu
     *
     * @return void
	 * @access public
     */ 
    public function addmarkAction(){
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
		$this->view->entity = $object;
		
		//$this->_helper->viewRenderer('mark/addmark');
	}
	
	/**
     * Metoda widoku odpowiedzialnego za dodawanie oceny do obiektu
     *
     * @return void
	 * @access public
     */ 
    public function changemarkAction(){
        $object_id  = (int)$this->_request->getParam( 'object', null );
        $mark  = (int)$this->_request->getParam( 'mark', null );
		
		if( $object_id && ( $mark >= 1 && $mark <= 10 ) && Zend_Auth::getInstance()->hasIdentity() ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			$this->redirect( '/' );
		}
		
		
		
		$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		$this->view->result = $object->changeMark( Moondee_Auth::getIdentity()->getId(), $mark );
		$this->view->object = $object;
		//$this->_helper->viewRenderer('mark/changemark');
	}
	
	/**
     * Metoda widoku odpowiedzialnego za usuwanie oceny obiektu
     *
     * @return void
	 * @access public
     */ 
    public function deletemarkAction(){
        $object_id  = (int)$this->_request->getParam( 'object', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			if( Zend_Auth::getInstance()->hasIdentity() ){
				$object = Zend_Auth::getInstance()->getIdentity();	
			}else{
				$this->redirect( '/' );
			}	
		}
		
		$form = new Entity_Form_DeleteMark();
		
		if ( $this->_request->isPost() ) {
			$postData = $this->_request->getPost();
			
			if( $form->isValid( $postData )){
				$mark_object = Moondee_Application_Factory::getMoondeeObject( (int)$postData['object_id'] );
				$mark_object->deleteMark( $object->getId() );
				
			}
			
		}
		
		$this->view->form = $form;
		$this->view->object = $object;
	}
	
}

