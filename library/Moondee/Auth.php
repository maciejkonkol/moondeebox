<?php

/**
 * Klasa autoryzacji użytkowników
 *
 * @package    Moondee_Auth
 */

class Moondee_Auth
{
	
	/**
     * Metoda loguje użytkownika
     *
	 * @param string $identity
	 * @param string $password
     * @return Moondee_Entity_User
     */ 
	static public function login( $identity, $password ){
		$adapter = new Moondee_Auth_Adapter( $identity, $password );
		$data = $adapter->authenticate();
		
		$result = $data->isValid();
		
		if( !$result ){
			return $result;
		}
		
		
		$auth = Zend_Auth::getInstance();
		$storage = $auth->getStorage();
		$storage->write( $data->getIdentity() );
		$storage->writeMain( $data->getIdentity()->getId() );
		
		return $result;
	}

	/**
     * Metoda sprawdza czy uzytkownik jest zalogowany
     *
     * @return boolean
     */ 
    static public function hasIdentity(){
		$auth = Zend_Auth::getInstance();
        return $auth->hasIdentity();
    }

	/**
     * Metoda zwraca obiekt ktory jest zalogowany i jest ustawiony jako aktualnie aktywny
     *
     * @return mixed|null
     */ 
    static public function getIdentity(){
		$auth = Zend_Auth::getInstance();
        return $auth->getIdentity();
    }

	/**
     * Metoda zwraca uzytkownika ktory jest zalogowany
     *
     * @return mixed|null
     */ 
    static public function getMainIdentity(){
		$auth = Zend_Auth::getInstance();
		$user_id = $auth->getStorage()->readMain();
		
		return Moondee_Application_Factory::getMoondeeObject( (int)$user_id );
    }

	/**
     * Metoda zmienia aktywny zalogowany obiekt
     *
     * @return boolean
     */ 
    static public function changeIdentity( $object_id ){
		$object = Moondee_Application_Factory::getMoondeeObject( $object_id );
		$auth = Zend_Auth::getInstance();
		
		if( !$object->getId() && !$auth ){
			return false;
		}
		
        $auth->getStorage()->write( $object );
		
		return true;
    }

	/**
     * Metoda ustawia zalogowanego uzytkownika jako aktywny zalogowany obiekt
     *
     * @return boolean
     */ 
    static public function setMainIdentity(){
		$user = self::getMainIdentity();
		return self::changeIdentity( $user>getId() );
    }
	

}
?>