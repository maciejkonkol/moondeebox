<?php

/**
 * Model tablicy przechowywującej zewnętrzne id obiektów
 *
 * @package    Moondee_Application
 */


class Moondee_Application_Model_Object extends Zend_Db_Table_Abstract
{
	protected $_name = 'moondee_object';
	protected $_primary = 'id';

}


?>