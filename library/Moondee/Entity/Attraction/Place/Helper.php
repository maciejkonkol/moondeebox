<?php

/**
 * Klasa pomocnicza miejsca
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Attraction_Place_Helper
{
	
	/**
     * Metoda sprawdza czy uzytkownik byl w miejscu o id podanym w parametrze
     *
	 * @param integer $user_id
	 * @param integer $place_id
     * @return bool
	 * @access public
     */ 
	static public function ifWasThere( $user_id, $place_id ) {
		$model = new Moondee_Entity_Model_UserPlace();
		
		$data = $model->fetchRow('user_id = '.$user_id.' AND place_id = '.$place_id );
		
		if( $data ){
			return true;
		}
		
		return false;
	}
}
?>