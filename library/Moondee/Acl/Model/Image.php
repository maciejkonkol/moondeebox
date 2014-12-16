<?php

/**
 * Model tablicy przechowywującej uprawnienia do obiektu typu image
 *
 * @package    Moondee_Application
 */


class Moondee_Acl_Model_Image extends Zend_Db_Table_Abstract
{
	protected $_name = 'image_permission';
	protected $_primary = 'id';
	
}


?>