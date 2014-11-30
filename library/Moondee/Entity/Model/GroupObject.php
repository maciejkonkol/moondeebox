<?php

/**
 * Model tablicy przechowywującej połączenia między grupami a użytkownikami
 *
 * @package    Moondee_Application
 */


class Moondee_Entity_Model_GroupObject extends Zend_Db_Table_Abstract
{
	protected $_name = 'group-object';
	protected $_primary = 'id';

	protected $_referenceMap = array(
        'Moondee_Entity_Model_User' => array(
            'columns' => 'object_id',
            'refColumns' => 'id',
            'refTableClass' => 'Moondee_Entity_Model_User',
        ),
        'Moondee_Entity_Model_Group' => array(
            'columns' => 'group_id',
            'refColumns' => 'id',
            'refTableClass' => 'Moondee_Entity_Model_Group',
        ),
        'Moondee_Entity_Model_Place' => array(
            'columns' => 'group_id',
            'refColumns' => 'id',
            'refTableClass' => 'Moondee_Entity_Model_Place',
        )
    );
}


?>