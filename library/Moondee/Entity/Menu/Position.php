<?php

/**
 * Klasa pozycji menu obiektu
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Menu_Position
{
	/**
     * Nazwa metody 
     *
     * @var string
	 * @access protected
     */
	protected $method;
	
	/**
     * Id obiektu do jakiego nalezy menu w ktorym znajduje sie bierzaca pozycja
     *
     * @var integer
	 * @access protected
     */
	protected $object_id;
	
	/**
     * Tekst pozycji menu
     *
     * @var string
	 * @access protected
     */
	protected $anchor;
	
	
	/**
     * Konstruktor pozycji menu obiektu typu entity
     *
     * @return void
     */	
	public function __construct( $method, $object_id, $anchor  ) {
		$this->method = $method;
		$this->object_id = $object_id;
		$this->anchor = $anchor;
	}	
	
	/**
     * Metoda zwraca kod html wyrenderowanej pozycji menu
     *
     * @return string
	 * @access public
     */
	public function render() {		
		$url = new Zend_View_Helper_Url();
		$href = $url->url( array( 'entity' => $this->object_id ), 'object-menu-'.$this->method, true );
		$class = '';
		if( Zend_Controller_Front::getInstance()->getRouter()->getCurrentRouteName() == 'object-menu-'.$this->method ){
			$class .= ' active';
		}
		
		$html = '<li class="'.$class.'" style="color: white; text-decoration: none; margin-right: 0.2rem; margin-left: 0.2rem; padding-left: 0.3rem; padding-right: 0.3rem; display: inline-block; margin-top: -0.3rem; float: left; height: 100%;" >';
		$html .= '<a data-destination="entity_template" class="entity_menu_position" href="'.$href.'" style="color: white; text-decoration: none;" >'.$this->anchor.'</a>';
		
		$html .= '</li>';
		return $html;
	}
	

}
?>