<?php

/**
 * Klasa pomocnicza opisu
 *
 * @package    Moondee_Describe
 */

class Moondee_Description_Helper
{
	/**
     * Metoda dodaje opis
     *
	 * @param integer $object_id Id obiektu kotrego dotyczy opis
	 * @param integer $writer_id Id obiektu ktory dodaje opis
	 * @param sring $text  Tekst opisu
     * @return Moondee_Description
	 * @access public
     */ 
	static public function addDescription( $object_id, $writer_id, $text ) {
		$description = new Moondee_Description();
		$description->setObjectId( $object_id );
		$description->setOwner( $writer_id );
		$description->setText( $text );
		$description->save();
		
		return new Moondee_Application_Proxy( $description );
	}
	
	/**
     * Metoda zwraca opisy obiektu
     *
	 * @param integer $object_id Id obiektu kotrego dotyczy opis
     * @return Moondee_Description[]
	 * @access public
     */ 
	static public function getObjectDescriptions( $object_id ) {
		$model = new Moondee_Description_Model_Description();
		$data = $model->fetchAll( 'object_id = '.$object_id );
		
		$descriptions = array();
		
		if( $data ){
			foreach( $data as $row ){
				$descriptions[ $row['id'] ] = new Moondee_Application_Proxy( new Moondee_Description( $row ) );
			}
		}
		
		return $descriptions;
	}
	
	/**
     * Metoda zwraca najlepszy opis obiektu
     *
	 * @param integer $entity_id Id obiektu kotrego dotyczy opis
     * @return Moondee_Description | null
	 * @access public
     */ 
	static public function getObjectBestDescription( $entity_id ) {
		$model = new Moondee_Description_Model_Description();
		$data = $model->getBestDescription( $entity_id );
		
		if( $data ){
			return new Moondee_Application_Proxy( new Moondee_Description( $data ) );
		}
		
		return null;
	}
	
	/**
     * Get object descriptions
     *
	 * @param integer[] $descriptions_id Tablica id opisow do usuniecia
     * @return void
	 * @access public
     */ 
	static public function deleteDescriptions( $descriptions_id ) {
		if( $descriptions_id ){
			$model = new Moondee_Description_Model_Description();
			$model->delete( 'id IN ('.  implode( ',', $descriptions_id ).') ' );
			
			$model_moondee_object = new Moondee_Application_Model_Object();
			$model_moondee_object->delete('id IN ('.implode( ', ', $descriptions_id ).') ');
		}
	}
	
	/**
     * Metoda zwraca ilość opisów obiektu o id podanym w parametrze
     *
	 * @param integer $entity_id id obiektu
     * @return integer
	 * @access public
     */ 
	static public function getObjectNumDescription( $entity_id ) {
		$model = new Moondee_Description_Model_Description();
		return $model->getNumDescription( $entity_id )['num'];
	}


}
?>