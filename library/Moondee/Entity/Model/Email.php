<?php

/**
 * Model tablicy przechowywującej maile
 *
 * @package    Moondee_Application
 */


class Moondee_Entity_Model_Email extends Zend_Db_Table_Abstract
{
	protected $_name = 'email';
	protected $_primary = 'id';
    protected $_dependentTables = array( 'Moondee_Entity_Model_User' );
	
	protected $_referenceMap = array(
        'Moondee_Entity_Model_User' => array(
            'column' => 'object_id',
            'refColumn' => 'id',
            'refTableClass' => 'Moondee_Entity_Model_User',
        )
    );

}


?>