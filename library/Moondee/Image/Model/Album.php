<?php

/**
 * Model tablicy przechowywującej obrazki
 *
 * @package    Moondee_Image
 */


class Moondee_Image_Model_Album extends Zend_Db_Table_Abstract
{
	protected $_name = 'album';
	protected $_primary = 'id';

    protected $_dependentTables = array('Moondee_Image_Model_Image'); 
}


?>