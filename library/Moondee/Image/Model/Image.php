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
			'column' => 'album',
            'refColumn' => 'id', 
			'refTableClass'   => 'Moondee_Image_Model_Album',
		)  
	); 
}


?>