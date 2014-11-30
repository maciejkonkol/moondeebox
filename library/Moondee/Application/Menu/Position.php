<?php

/**
 * Klasa pozycji Menu
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Menu_Position extends Moondee_Application_DatabaseObject
{
	/**
	 * Modul
	 *
	 * @var string
	 * @access protected
	 */	
	protected $module;
	
	/**
	 * Kontroler
	 *
	 * @var string
	 * @access protected
	 */	
	protected $controller;
	
	/**
	 * Akcja
	 *
	 * @var string
	 * @access protected
	 */	
	protected $action;
	
	/**
	 * Nazwa pozycji
	 *
	 * @var string
	 * @access protected
	 */	
	protected $label;
	
	/**
	 * Ikona
	 *
	 * @var string
	 * @access protected
	 */	
	protected $icon;
	
	/**
	 * Nazwa routera
	 *
	 * @var string
	 * @access protected
	 */	
	protected $rout;
	

	/**
     * Metoda ustawia model menu
     *
     * @return void
	 * @access public
     */
	protected function setModel() {
		$this->model = new Moondee_Application_Model_Menu();
	}
	
	
	/**
     * Metoda zwraca nazwe modulu
     *
     * @return string
	 * @access public
     */
	public function getModule() {
		return $this->module;
	}

	/**
     * Metoda zwraca nazwe kontrolera
     *
     * @return string
	 * @access public
     */
	public function getController() {
		return $this->controller;
	}

	/**
     * Metoda zwraca nazwe akcji
     *
     * @return string
	 * @access public
     */
	public function getAction() {
		return $this->action;
	}

	/**
     * Metoda zwraca nazwe pozycji menu
     *
     * @return string
	 * @access public
     */
	public function getLabel() {
		return $this->label;
	}

	/**
     * Metoda zwraca ikone
     *
     * @return string
	 * @access public
     */
	public function getIcon() {
		return $this->icon;
	}

	/**
     * Metoda zwraca nazwe reoutera
     *
     * @return string
	 * @access public
     */
	public function getRout() {
		return $this->rout;
	}
	
	/**
     * Metoda zwraca kod html wyrenderowanej pozycji menu
     *
     * @return string
	 * @access public
     */
	public function render() {
		$url = new Zend_View_Helper_Url();
		$href = $url->url( 
			array( 
				'module' => $this->getModule(),
				'controller' => $this->getController(),
				'action' => $this->getAction(),
			), 
			$this->getRout(), 
			true 
		);
		
		$html = '<li style="">';
		$html .= '<a class="" href="'.$href.'" >';
		$html .= $this->getLabel();
		$html .= '</a>';
		$html .= '</li>';
		
		return $html;
	}


}
?>