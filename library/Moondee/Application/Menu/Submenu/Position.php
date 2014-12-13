<?php

/**
 * Klasa pozycji Menu
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Menu_Submenu_Position
{
	
	/**
	 * Tablica parametrow adresu url
	 *
	 * @var string[]
	 * @access protected
	 */	
	protected $url;
	
	/**
	 * Nazwa pozycji
	 *
	 * @var string
	 * @access protected
	 */	
	protected $label;
	
	

	
	
	/**
     * Konstruktor
     *
	 * @param String $lable Nazwa pozycji
	 * @param String[] $url tablica za asocjacyjna z parametrami adresu.  module => moduł, controller => kontroler, action => akcja
     * @return void
	 * @access public
     */
	public function __construct( $label, $url ) {
		$this->label = $label;
		$this->url = $url;
	}
	
	
	/**
     * Metoda zwraca nazwe modulu
     *
     * @return string
	 * @access public
     */
	public function getModule() {
		return $this->url['module'];
	}

	/**
     * Metoda zwraca nazwe kontrolera
     *
     * @return string
	 * @access public
     */
	public function getController() {
		return $this->url['controller'];
	}

	/**
     * Metoda zwraca nazwe akcji
     *
     * @return string
	 * @access public
     */
	public function getAction() {
		return $this->url['action'];
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
    * Metoda zwraca kod html wyrenderowanej pozycji submenu
    *
    * @return string
    * @access public
    */
    public function render() {
        $url = new Zend_View_Helper_Url();

        $href = $url->url( 
            $this->url, 
            $this->getModule() ."-". $this->getController() ."-". $this->getAction(), 
            true 
        );


        $html = '<li style="display: inline-block; border: solid #cdced0; border-width: 1px 0 1px 1px;  ">';
        $html .= '<a class="" href="'.$href.'" style="display: inline-block; color: #555555; text-decoration: none; padding: 1em;" >';
        $html .= $this->getLabel();
        $html .= '</a>';
        $html .= '</li>';

        return $html;
    }


}
?>