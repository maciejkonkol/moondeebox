<?php

/**
 * Model tablicy przechowujaca dane o tym jaki uzytkownik byl w jakim miejscu
 *
 * @package    Moondee_Application
 */


class Moondee_Entity_Model_UserPlace extends Zend_Db_Table_Abstract
{
	protected $_name = 'user-place';
	protected $_primary = 'id';

	protected $_referenceMap = array(
        'Moondee_Entity_Model_User' => array(
            'columns' => 'user_id',
            'refColumns' => 'id',
            'refTableClass' => 'Moondee_Entity_Model_User',
        ),
        'Moondee_Entity_Model_Place' => array(
            'columns' => 'place_id',
            'refColumns' => 'id',
            'refTableClass' => 'Moondee_Entity_Model_Place',
        )
    );

	
}


?>