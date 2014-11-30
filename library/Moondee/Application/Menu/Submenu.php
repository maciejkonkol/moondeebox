<?php

/**
 * Klasa Submenu
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Menu_Submenu 
{
	/**
	 * Tablica pozycji submenu
	 *
	 * @var Moondee_Application_Menu_Submenu_Position[]
	 * @access protected
	 */	
	protected $positions = array();
	
	
	/**
     * Konstruktor ustawia pozycje menu jesli zostaly podane w parametrze
     *
	 * @param Moondee_Application_Menu_Submenu_Position[] $positions tablicja pozycji menu
     * @return void
	 * @access public
     */
	public function __construct( $positions = null ) {
		$this->setPositions( $positions );
	}
	
	/**
     * Metoda ustawia pozycje podane w parametrze
     *
	 * @param Moondee_Application_Menu_Submenu_Position[] $positions tablicja pozycji menu
     * @return void
	 * @access public
     */
	public function setPositions( $positions ) {
		$this->positions = $positions;
	}

	/**
     * Metoda dodaje pozycje submenu
     *
     * @return void
	 * @access public
     */
	public function addPosition( $position_name, $action, $controller, $module ) {
		$this->positions[] = new Moondee_Application_Menu_Submenu_Position( $position_name, $action, $controller, $module );
	}
	
	/**
     * Metoda zwraca pozycje submenu
     *
     * @return Moondee_Application_Menu_Submenu_Position[]
	 * @access public
     */
	public function getPositions() {
		return $this->positions;
	}
	
	/**
     * Metoda zwraca kod html wyrenderowanego submenu
     *
     * @return string
	 * @access public
     */
	public function render() {
		$html = '<div style="text-align: center;" ><ul style="padding: 0; border: solid #cdced0; border-width: 0 1px 0 0; display: inline-block; background: white; ">';

		foreach( $this->getPositions() as $position ){
			$html .= $position->render();
		}
		$html .= '</ul></div>';
		
		return $html;
	}

}
?>