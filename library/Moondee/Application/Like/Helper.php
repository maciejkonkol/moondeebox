<?php

/**
 * Klasa pomocnicza Like'ów
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Like_Helper 
{
		
	
	/**
     * Meteoda sprawdza czy istnieje polubienie obiektu przez użytkownika
     *
     * @param integer $object_id
     * @param integer $user_id
     * @return boll | Moondee_Application_Like
	 * @access public
     */
	static public function likeExists( $object_id, $user_id ){
		$model = new Moondee_Application_Model_Like();
		$data = $model->fetchRow( 'object_id = '.$object_id.' AND user_id = '.$user_id );
		
		if( $data ){
			return new Moondee_Application_Like( $data );
		}else{
			return false;
		}
    }
	
	
	
}
?>