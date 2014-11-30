<?php

class Entity_EntityController extends Zend_Controller_Action
{

    public function init(){
        
    }

	public function entityAction(){
		$object_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			$this->redirect('');			
		}
		
		
		$this->view->entity = $object;
	}

	
	
	
	
}

