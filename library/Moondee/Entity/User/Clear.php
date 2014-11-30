<?php

/**
 * Klasa pluginu uzytkownika
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_User_Clear extends Zend_Controller_Plugin_Abstract
{
	
	
	/**
     * Metoda usuwa dane z obiektu użytkownika ktore nie maja być przechowywane w sesji
     *
     * @return void
     */
	public function dispatchLoopShutdown() {
		
		if( Zend_Auth::getInstance()->hasIdentity() ){
			$user = Zend_Auth::getInstance()->getIdentity();
			$user->clearToSession();
		}
		
		
		parent::dispatchLoopShutdown();
	}
	

}
?>