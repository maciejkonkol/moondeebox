<?php

/**
 * Model tablicy przechowywującej zewnętrzne id obiektów
 *
 * @package    Moondee_Application
 */


class Moondee_Entity_Model_User extends Zend_Db_Table_Abstract
{
	protected $_name = 'user';
	protected $_primary = 'id';
    protected $_dependentTables = array(
		'Moondee_Entity_Model_Email',		
        'Moondee_Entity_Model_GroupUser',
		'Moondee_Entity_Model_UserPlace'
	);

	protected $_referenceMap = array(
        'Moondee_Entity_Model_Email' => array(
            'columns' => 'id',
            'refColumns' => 'object_id',
            'refTableClass' => 'Moondee_Entity_Model_Email',
        )
    );
	
}


?>