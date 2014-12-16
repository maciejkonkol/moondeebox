<?php

/**
 * Model tablicy przechowywującej obrazki
 *
 * @package    Moondee_Image
 */


class Moondee_Image_Model_Image extends Zend_Db_Table_Abstract
{
    protected $_name = 'image';
    protected $_primary = 'id';

    protected $_referenceMap = array(  
        'Moondee_Image_Model_Album' => array( 
            'columns' => 'album',
            'refColumn' => 'id',
            'refTableClass'   => 'Moondee_Image_Model_Album',
        )
    );
    
    
	
	/**
     * Metoda zwraca obrazy danego obiektu
     *
	 * @param integer $entity_id
	 * @param integer $limit ilosc obrazkow ktora ma zostac zwrocona
	 * @param integer $start pozycja od ktorej maja zostac pobrane obrazki
     * @return Zend_Db_Table_Row
     */
	public function getEntityImage( $entity_id, $limit = null, $start = null  ){
		$select = $this->getAdapter()->select()
			->from( array( 'i' => 'image' ) )
			->join( array( 'a' => 'album' ), 'i.album = a.id', array() )
			->where( 'a.owner = ?', $entity_id ) 
			->order( 'i.date_added DESC' )
			->columns( array( 
				'id' => 'i.id', 
				'album' => 'i.album', 
				'title' => 'i.title', 
				'describe' => 'i.describe',
				'date_execution' => 'i.date_execution',  
				'date_added' => 'i.date_added',
				'server' => 'i.server',  
				'path' => 'i.path',  
				'file' => 'i.file',  
				'extension' => 'i.extension'
			))
            ->limit( $limit, $start );
		
		
		return $this->getAdapter()->fetchAll( $select );
	}
}


?>