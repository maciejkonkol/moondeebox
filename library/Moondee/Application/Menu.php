<?php

/**
 * Klasa Menu
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Menu
{
	/**
	 * Obiekt instancji
	 *
	 * @var Moondee_Application_Menu
	 * @access private
	 * @static
	 */	
	static private $_instance;
	
	/**
	 * Tablica pozycji menu
	 *
	 * @var Moondee_Application_Menu_Position[]
	 * @access protected
	 */	
	protected $positions = array();
	
	/**
	 * Model menu
	 *
	 * @var Moondee_Application_Model_Menu
	 * @access protected
	 */	
	protected $model;
	
	
	/**
     * Metoda zwraca instance obiektu
     *
     * @static
     * @return Moondee_Application_Menu
     */
    static public function getInstance() {
        if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
	/**
     * Metoda ustawia model menu
     *
     * @return void
	 * @access public
     */
	public function setModel() {
		$this->model = new Moondee_Application_Model_Menu();
	}
	
	/**
     * Metoda zwraca model menu
     *
     * @return Moondee_Application_Model_Menu
	 * @access public
     */
	public function getModel() {
		if( !$this->model ){
			$this->setModel();
		}
		
		return $this->model;
	}
	
	/**
     * Metoda ustawia pozycje menu
     *
     * @return Moondee_Application_Menu_Position[]
	 * @access public
     */
	public function setPositions() {
		$data = $this->getModel()->fetchAll();
		
		foreach( $data as $row ){
			$this->positions[ $row['id'] ] = new Moondee_Application_Menu_Position( $row );
		}
	}
	
	/**
     * Metoda zwraca pozycje menu
     *
     * @return Moondee_Application_Menu_Position[]
	 * @access public
     */
	public function getPositions() {
		if( !$this->positions ){
			$this->setPositions();
		}
		
		return $this->positions;
	}
	
	/**
     * Metoda zwraca kod html wyrenderowanego menu
     *
     * @return string
	 * @access public
     */
	public function render() {
		$html = '<ul style="">';

		foreach( $this->getPositions() as $position ){
			$html .= $position->render();
		}
		$html .= '</ul>';
		
		return $html;
	}
    
}
?>