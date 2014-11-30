<?php

/**
 * Klasa pozycji menu zadan obiektu
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Menu_TaskPosition_AddToGroup
{
	
	/**
     * Grupy zalogowanego użytkownika
     *
     * @var Moondee_Entity_Menu_TaskPosition_AddToGroup_Position[]
	 * @access protected
     */
	protected $positions = array();
	
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
		
		$user = Zend_Auth::getInstance()->getIdentity();
		$groups = $user->getGroups();
		$selected_groups = $user->getGroupsHavingObject( $object_id );
		//echo '<pre>'; print_r( $selected_groups ); echo '</pre>';
		
		foreach( $groups as $group ){
			$selected = false;
			if( isset( $selected_groups[ $group->id ] ) ){
				$selected = true;
			}
			$this->positions[] = new Moondee_Entity_Menu_TaskPosition_AddToGroup_Position( $object_id, $group->id, $group->getName(), $selected );
		}
	}
	
	/**
     * Metoda zwraca kod html wyrenderowanej pozycji menu
     *
     * @return string
	 * @access public
     */
	public function render(){
		$html = '<li class="addToGroupButton" style="float: left; color: #333333;
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
" ><span>Dodaj do grupy</span><ul class="addToGroupList" style="" >';
		foreach( $this->positions as $position){
			$html .= $position->render();
		}
		$html .= '</ul></li>';
		
		return $html;
	}
	

}
?>