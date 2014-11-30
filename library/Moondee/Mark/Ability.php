<?php

/**
 * Cecha obiektow ktore maja mozliwosc dodawania oceny
 *
 * @package    Moondee_Mark
 */

trait Moondee_Mark_Ability
{
	

	/**
     * Metoda dodaje ocene do obiektu
     *
	 * @param integer $value Wartośc oceny
     * @return Moondee_Mark_Average | null
	 * @access public
     */ 
	public function addMark( $value, $judge = null ) {
		if( !$judge ){
			$judge = Zend_Auth::getInstance()->getIdentity()->getId();
		}
		
		Moondee_Mark_Helper::addMarkToObject( $this->id, $judge, $value );
	}

	/**
     * Metoda sprawdza czy uzytkownik ocenil obiekt
     *
	 * @param integer $user_id id uzytkownika opcjonalne (domyslnie id uzytkownika zalogowanego)
     * @return bool
	 * @access public
     */ 
	public function isUserMark( $user_id = null ) {
		if( !$user_id ){
			$user_id = Zend_Auth::getInstance()->getIdentity()->getId();
		}
		
		return Moondee_Mark_Helper::isUserMark( $this->id, $user_id );
	}

}
?>