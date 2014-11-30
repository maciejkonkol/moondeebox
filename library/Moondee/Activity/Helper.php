<?php

/**
 * Klasa pomocnicza aktywności
 *
 * @package    Moondee_Activity
 */


class Moondee_Activity_Helper extends Zend_Db_Table_Abstract
{
	

	/**
     * Metoda zwraca miejsca wobec ktorych aktywny jest obiekt o id podanym w parametrze
     *
	 * @param integer $object_id Id obiektu ktorego aktywne miejsca sa wyszukiwane
	 * @param integer $activity_id Opcjonalnie id aktywnosci wedlug ktorego ma byc wyszukiwane miejsce
     * @return Moondee_Entity_Attraction_Place
	 * @access protected
     */ 
	static public function getPlaces( $object_id, $activity_id = 0 ) {
		$model = new Moondee_Activity_Model_Activity();
		$data = $model->getPlaces( $object_id, $activity_id );
		
		$places = array();
		
		foreach( $data as $row ){
			$places[] = new Moondee_Application_Proxy( new Moondee_Entity_Attraction_Place( $row ) );
		}
		
		return $places;
	}
	
	/**
     * Metoda dodaje aktywność obiektu wobec innego obiektu
     *
	 * @param integer $object_id Id obiektu ktorego aktywne miejsca sa wyszukiwane
	 * @param integer $activity_id Opcjonalnie id aktywnosci wedlug ktorego ma byc wyszukiwane miejsce
     * @return bool
	 * @access protected
     */ 
	static public function addObjectToObjectActivity( $object1_id, $object2_id, $activity ) {
		$model = new Moondee_Activity_Model_Activity();
		$activity_data = $model->fetchRow('name = "'.$activity.'"');
		
		if( $activity_data['id'] ){
			
			$model_object_to_object_activity = new Moondee_Activity_Model_ObjectObjectActivity();
			$model_object_to_object_activity->insert( array(
				 'object1_id' => $object1_id,
				 'object2_id' => $object2_id,
				 'activity_id' => $activity_data['id']
			 ) );
			 
			 return true;
		}else{
			return false;
		}
	}
}


?>