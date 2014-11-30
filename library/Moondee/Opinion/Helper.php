<?php

/**
 * Klasa pomocnicza opini
 *
 * @package    Moondee_Opinion
 */

class Moondee_Opinion_Helper
{
	
	
	/**
     * Metoda zwraca opinie obiektu
     *
	 * @param integer $object_id Id obiektu kotrego dotyczy opinia
     * @return Moondee_Description[]
	 * @access public
     */ 
	static public function getObjectOpinions( $object_id ) {
		$model = new Moondee_Opinion_Model_Opinion();
		$data = $model->fetchAll( 'object_id = '.$object_id );
		
		$opinions = array();
		
		if( $data ){
			foreach( $data as $row ){
				$opinions[ $row['id'] ] = new Moondee_Application_Proxy( new Moondee_Opinion( $row ) );
			}
		}
		
		return $opinions;
	}
	
	/**
     * Metoda usuwa opinie obiektu
     *
	 * @param integer[] $opinions_id Tablica id opini do usuniecia
     * @return void
	 * @access public
     */ 
	static public function deleteOpinions( $opinions_id ) {
		if( $opinions_id ){
			$model = new Moondee_Opinion_Model_Opinion();
			$model->delete( 'id IN ('.  implode( ',', $opinions_id ).') ' );
			
			$model_moondee_object = new Moondee_Application_Model_Object();
			$model_moondee_object->delete('id IN ('.implode( ', ', $opinions_id ).') ');
		}
	}

}
?>