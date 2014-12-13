<?php

class IndexController extends Zend_Controller_Action
{

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
		//Zend_Auth::getInstance()->clearIdentity();
		$form = new Form_Login();
		$this->view->form = $form;
				
		if ( $this->_request->isPost() ) {
			$postData = $this->_request->getPost();
			
			if( $form->isValid( $postData )){
				
				$user = Moondee_Auth::login( $postData['email'], $postData['password'] );
				echo '<pre>ooo'.$user->id; print_r( $user ); echo '</pre>';
			}
			
		}
		
		echo '<pre>'; print_r( Moondee_Auth::getMainIdentity()); echo '</pre>';
		//echo '<pre>'; print_r( Moondee_Entity_Email_Helper::getEmailOwner('maciejkonkol@o2.pl') ); echo '</pre>';
    }


}

