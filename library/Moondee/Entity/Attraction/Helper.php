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
    
    /**
    * Metoda zwraca id właściciela atrakcji
    *
    * @param integer $entity_id Id obiektu ktorego właściciel ma zostać zwrocony
    * @param string $class Klasa obiektu ktorego właściciel ma zostać zwrocony
    * @return integer
    * @access public
    */
    static public function getAttractionOwner( $entity_id, $class = null ){
		if( $class === null ){
			$class = Moondee_Entity_Helper::getEntityClass( $entity_id );
		}
		
		switch ( $class ) {
			case 'Moondee_Entity_Attraction_Place':
				$object_model = new Moondee_Entity_Model_Place();
				break;
			case 'Moondee_Entity_Attraction_Event':
				$object_model = new Moondee_Entity_Model_Event();
				break;
		}

        $row = $object_model->find( $entity_id )->current();

        if( $row ){
            return (integer) $row['owner'];
        }else{
            return null;
        }
    }
}
?>