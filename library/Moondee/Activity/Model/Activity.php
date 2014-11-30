<?php

/**
 * Model tablicy przechowywującej typy aktywności
 *
 * @package    Moondee_Activity
 */


class Moondee_Activity_Model_Activity extends Zend_Db_Table_Abstract
{
	protected $_name = 'activity';
	protected $_primary = 'id';
	

	/**
     * Metoda zwraca miejsca wobec ktorych aktywny jest obiekt o id podanym w parametrze
     *
	 * @param integer $object_id Id obiektu ktorego aktywne miejsca sa wyszukiwane
	 * @param integer $activity_id Opcjonalnie id aktywnosci wedlug ktorego ma byc wyszukiwane miejsce
     * @return void
	 * @access protected
     */ 
	public function getPlaces( $object_id, $activity_id = 0 ) {
		$select = $this->getAdapter()->select()
				->from( array( 'ooa' => 'object-object-activity' ), array() )
				->join( array( 'p' => 'place' ), 'p.id = ooa.object2_id' )
				->where( 'ooa.object1_id = ?', $object_id )
				->group( 'ooa.object2_id' );
		
		if( $activity_id ){
			$select->where( 'ooa.activity_id = ?', $activity_id );
		}
		
		return $this->getAdapter()->fetchAll( $select );
	}
}


?>