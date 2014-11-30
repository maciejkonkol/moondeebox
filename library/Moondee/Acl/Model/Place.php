<?php

/**
 * Model tablicy przechowywującej uprawnienia do obiektu typu place
 *
 * @package    Moondee_Application
 */


class Moondee_Acl_Model_Place extends Zend_Db_Table_Abstract
{
	protected $_name = 'place_permission';
	protected $_primary = 'id';
	

}


?>