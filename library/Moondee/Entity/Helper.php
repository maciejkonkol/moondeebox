<?php

/**
 * Klasa pomocnicza atrakcji i uzytkownikow
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Helper
{
	/**
     * Metoda dodaje tworzy nowe miejsce
     *
	 * @param integer $object_id Id obiektu dodającego miejsce
	 * @param array $params Tablica parametrów miejsca
     * @return void
	 * @access public
     */
	static public function addPlace( $object_id, $params ){
		$place = new Moondee_Entity_Attraction_Place();
		
		if( $params['name'] ){
			$place->setName( $params['name'] );
		}
		if( $params['type'] ){
			$place->setName( $params['type'] );
		}
		
		if( $params['public'] ){
			$place->setOwner( 0 );
		}else{
			$place->setOwner( $object_id );
		}
		
		$place->save();
		
		Moondee_Activity_Helper::addObjectToObjectActivity( $object_id, $place->getId(), 'creator' );
		
		return new Moondee_Application_Proxy( $place );
	}
}
?>