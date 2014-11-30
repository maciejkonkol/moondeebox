<?php

/**
 * Klasa pozycji menu zadan obiektu
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Menu_TaskPosition_Like
{
	
	
	/**
     * Id obiektu do którego nalezy menu
     *
     * @var integer
	 * @access protected
     */
	protected $object_id;
	
	
	/**
     * Metoda zwraca kod html wyrenderowanej pozycji menu
     *
	 * @param integer $object_id
     * @return void
	 * @access public
     */
	public function __construct( $object_id ){
		$this->object_id = $object_id;
	}
	
	/**
     * Metoda zwraca kod html wyrenderowanej pozycji menu
     *
     * @return string
	 * @access public
     */
	public function render(){
		$url = new Zend_View_Helper_Url();
		$href = $url->url( array( 'entity' => $this->object_id ), 'object-taskmenu-like', true );
		
		$html = '<li style="float: left; color: #333333;
font-size: 110%;
text-decoration: none;
background-color: rgba( 255, 255, 255, 0.5 );
display: block;
float: left;
margin-right: 1rem;
height: 2.2rem;
line-height: 2.2rem;
padding-left: 2.3rem;
padding-right: 1rem;
background-repeat: no-repeat;
background-size: 1.8rem;
background-position: 0.3rem 0.3rem;
position: relative;
top: 50%;
margin-top: -1.1em;
" >';
		$html .= '<a href="'.$href.'">Like</a>';
		$html .= '</li>';
		
		return $html;
	}
	

}
?>