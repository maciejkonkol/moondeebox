<?php

class Entity_IndexController extends Zend_Controller_Action
{

    public function init(){
        $this->_helper->viewRenderer->setNoController( true );
        $this->_helper->viewRenderer('entity/object');
		
		
		$this->view->object_script = 'index/'.$this->getRequest()->getActionName().'.phtml';
    }

	

	
	
	
	
}

