<?php

/**
 * Klasa pozycji menu zadan obiektu
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Menu_TaskPosition_AddToGroup_Position
{
	/**
     * Id obiektu do którego nalezy menu
     *
     * @var integer
	 * @access protected
     */
	protected $object_id;
	
	/**
     * Id grupy do jakiej odwołuje sie dana pozycja menu
     *
     * @var integer
	 * @access protected
     */
	protected $group_id;
	
	/**
     * Nazwa grupy do jakiej odwołuje sie dana pozycja menu
     *
     * @var string
	 * @access protected
     */
	protected $group_name;
	
	/**
     * Zemienna przechowywująca wartość od ktorej zalezy czy pozycja menu bedzie zaznaczona
     *
     * @var bool
	 * @access protected
     */
	protected $selected;
	
	
	/**
     * Konstruktor 
     *
	 * @param integer $object_id
	 * @param integer $group_id
	 * @param string $group_name
	 * @param bool $selected
     * @return void
	 * @access public
     */
	public function __construct( $object_id, $group_id, $group_name, $selected ){
		$this->object_id = $object_id;
		$this->group_id = $group_id;
		$this->group_name = $group_name;
		$this->selected = $selected;
	}
	
	/**
     * Metoda zwraca kod html wyrenderowanej pozycji menu
     *
     * @return string
	 * @access public
     */
	public function render(){
		$url = new Zend_View_Helper_Url();
		$href = $url->url( array( 'entity' => $this->object_id, 'group' => $this->group_id ), 'object-taskmenu-addToGroup', true );
		
		$html = '<li>';
		$html .= '<a href="'.$href.'" >';
		if( $this->selected ){
			$html .= ' <=> ';
		}
		$html .= $this->group_name;
		$html .='</a>';
		$html .= '</li>';
		
		return $html;
	}
	

}
?>