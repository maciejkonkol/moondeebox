<?php

/**
 * Klasa pozycji menu zadan obiektu
 *
 * @package    Moondee_Entity
 */

abstract class Moondee_Entity_Menu_TaskPosition
{
	/**
     * Id obiektu do jakiego nalezy menu w ktorym znajduje sie bierzaca pozycja
     *
     * @var integer
	 * @access protected
     */
	protected $object_id;
	
	
	/**
     * Metoda zwraca kod html wyrenderowanej pozycji menu
     *
     * @return string
	 * @access public
     */
	public function render();
	

}
?>