<?php

class Entity_DesktopController extends Zend_Controller_Action
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
				$this->view->entity_script = 'desktop/'.$this->getRequest()->getActionName().'.phtml';
			}
		}
    }

    public function indexAction(){
        $object_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			$this->redirect('');			
		}
		
		$this->view->entity = $object;
    }

}

