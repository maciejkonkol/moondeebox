<?php

/**
 * Model tablicy przechowywującej opisy obiektow
 *
 * @package    Moondee_Description
 */


class Moondee_Description_Model_Description extends Zend_Db_Table_Abstract
{
	protected $_name = 'description';
	protected $_primary = 'id';

	
	/**
     * Metoda zwraca opis z najwyzsza ocena
     *
	 * @param integer $entity_id
     * @return Zend_Db_Table_Row
     */
	public function getBestDescription( $entity_id ){
		$select = $this->getAdapter()->select()
			->from( array( 'd' => 'description' ) )
			->joinLeft( array( 'ma' => 'mark_average' ), 'd.id = ma.object', array() )
			->where( 'd.object_id = ?', $entity_id ) 
			->order( 'ma.value DESC' )
			->columns( array( 
				'id' => 'd.id', 
				'writer' => 'd.writer', 
				'object_id' => 'd.object_id',
				'text' => 'd.text'
			));
		
		return $this->getAdapter()->fetchRow( $select );
	}
	
	/**
     * Metoda zwraca ilosc opisow obiektu o id podanym w parametrze
     *
	 * @param integer $entity_id
     * @return Zend_Db_Table_Row
     */
	public function getNumDescription( $entity_id ){
		$select = $this->getAdapter()->select()
			->from( array( 'd' => 'description' ), array(' count(*) as num') )
			->where( 'd.object_id = ?', $entity_id );
		
		return $this->getAdapter()->fetchRow( $select );
	}
}


?>