<?php

/**
 * Model tablicy przechowywującej uprawnienia do obiektu typu user
 *
 * @package    Moondee_Application
 */


class Moondee_Acl_Model_User extends Zend_Db_Table_Abstract
{
	protected $_name = 'user_permission';
	protected $_primary = 'id';
	

}


?>