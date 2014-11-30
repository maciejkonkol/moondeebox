<?php

class Entity_UserController extends Zend_Controller_Action
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
			$this->view->entity_script = 'user/'.$this->getRequest()->getActionName().'.phtml';
		}
		
		
    }

    public function indexAction(){
        $object_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $object_id ){
			$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		}else{
			$this->redirect('');			
		}
		
		
		
		$this->view->user = $object;
		$this->view->entity = $object;
    }

    public function aboutAction(){
        $user_id  = (int)$this->_request->getParam( 'entity', null );
		
		if( $user_id ){
			$user = Moondee_Application_Factory::getMoondeeObject( $user_id );
		}else{
			$this->redirect('');
		}
		
        
		$this->view->user = $user;
		$this->view->entity = $user;
    }

    public function groupsAction(){
        $user = Zend_Auth::getInstance()->getIdentity();
		
		if( !$user ){
			$this->redirect('');
		}
		
		$this->view->groups = $user->getGroups();
		
		if( $this->view->groups == Moondee_Acl_Result::failed() ){
			$this->redirect('');
		}
        
		$this->view->user = $user;
		$this->view->entity = $user;
    }

    public function groupAction(){
        $user_id  = (int)$this->_request->getParam( 'entity', null );
        $group_id  = (int)$this->_request->getParam( 'group', 0 );
		
		if( $user_id ){
			$user = Moondee_Application_Factory::getMoondeeObject( $user_id );
		}else{
			$this->redirect('');
		}
		
		$this->view->group = $user->getGroup( $group_id );
		
		if( $this->view->group == Moondee_Acl_Result::failed() ){
			$this->redirect('');
		}
		        
		$this->view->user = $user;
		$this->view->entity = $user;
    }

    public function addgroupAction(){
        $user = Zend_Auth::getInstance()->getIdentity();
		$form = new Entity_Form_AddGroup();
		
		
		if ( $this->_request->isPost() ) {
			$postData = $this->_request->getPost();
			
			if( $form->isValid( $postData )){
				$user->addGroup( $postData['name'] );
				
				$user->saveGroups();
				$this->getHelper('Redirector')->setGotoRoute( array(), 'user-groups');
			}
			
		}
		
		$this->view->entity = $user;
		$this->view->form = $form;
		
    }

    public function addtogroupAction(){
        $user = Zend_Auth::getInstance()->getIdentity();
		
		if( !$user ){
			$this->redirect('');
		}
		
		$object_id  = (int)$this->_request->getParam( 'entity', null );
		$group_id  = (int)$this->_request->getParam( 'group', null );
		
		$user->getRealObject()->addToGroup( $object_id, $group_id );
		
		$this->view->entity = $user;
		
    }

    public function likeAction(){
        $user = Zend_Auth::getInstance()->getIdentity();
		
		if( !$user ){
			$this->redirect('');
		}
		
		$object_id  = (int)$this->_request->getParam( 'object', null );
		
		$user->like( $object_id );
		
		$this->view->entity = $user;
		
    }

    public function newAction(){
        //echo sprintf( "%1$020d", 2 );
		$id = 987624;
		
		$tab = str_split( sprintf( "%1$020d", $id ), 2 );
		$file = $tab[ count( $tab ) - 1 ];
		unset( $tab[ count( $tab ) - 1 ] );
		
		echo implode("/",$tab ).$file;
	}
}

