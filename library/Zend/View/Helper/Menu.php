<?php
/**
 * Zend Framework
 *
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright Maciej Konkol
 */


/**
 * Proxy helper for retrieving navigational helpers and forwarding calls
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright Maciej Konkol
 */
class Zend_View_Helper_Menu extends Zend_View_Helper_Abstract
{

    /**
     * Metoda zwraca menu
     *
	 * @param Zend_Navigation_Container $container
     * @return Moondee_Application_Menu
	 * @access public
     */
    public function menu() {
        return Moondee_Application_Menu::getInstance();
    }

}
