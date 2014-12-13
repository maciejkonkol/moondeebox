<?php

/**
 * Klasa pomocnicza atrakcji
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Attraction_Helper
{
	
	/**
     * Metoda sprawdza czy uzytkownik byl w atrakcji o id podanym w parametrze
     *
	 * @param integer $user_id
	 * @param integer $attraction_id
     * @return bool
	 * @access public
     */ 
	static public function ifWasThere( $user_id, $attraction_id ) {
        
        $attraction_class = Moondee_Entity_Helper::getEntityClass( $attraction_id );
        
        if( $attraction_class == 'Moondee_Entity_Attraction_Place' ){
            $model = new Moondee_Entity_Model_UserPlace();
            $data = $model->fetchRow('user_id = '.$user_id.' AND place_id = '.$attraction_id );
        }
        
        if( $attraction_class === 'Moondee_Entity_Attraction_Event' ){
            
        }
		
		if( $data ){
			return true;
		}
		
		return false;
	}
	
	/**
     *  Metoda dadaje atrakcje w ktorej byl uzytkownik
     *
	 * @param integer $user_id
	 * @param integer $attraction_id
     * @return bool
	 * @access public
     */ 
	static public function iWasThere( $user_id, $attraction_id ) {
        if ( !self::ifWasThere( $user_id, $attraction_id ) ) {
            $attraction_class = Moondee_Entity_Helper::getEntityClass( $attraction_id );
            
            echo $attraction_class.'555555'.' '.$attraction_id;
        
            if( $attraction_class == 'Moondee_Entity_Attraction_Place' ){
                $model = new Moondee_Entity_Model_UserPlace();
                $model->insert( array(
                    'user_id' => $user_id,
                    'place_id' => $attraction_id
                ) );
            }
            
            if( $attraction_class === 'Moondee_Entity_Attraction_Event' ){

            }
        }
	}
}
?>