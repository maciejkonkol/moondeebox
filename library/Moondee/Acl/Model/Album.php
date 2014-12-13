<?php

/**
 * Model tablicy przechowywującej uprawnienia do obiektu typu album
 *
 * @package    Moondee_Application
 */


class Moondee_Acl_Model_Album extends Zend_Db_Table_Abstract
{
	protected $_name = 'album_permission';
	protected $_primary = 'id';
	

}


?>