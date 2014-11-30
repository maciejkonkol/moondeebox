<?php

/**
 * Klasa menu zadan obiektu
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_TaskMenu
{
	protected $positions_method = array(
		'addToGroup' => 'Add to group',
		'like' => 'Like'
	);
		
	/**
	 * Identyfikator użytkownika (user id)
	 *
	 * @var integer
	 * @access protected
	 */
	protected $identity;
	
	
	/**
     * Konstruktor menu obiektu typu entity
     *
	 * @param mixed $obiect
     * @return void
	 * @access public
     */
	public function __construct( $object ) {
		$this->object = $object;
	}	
	
	/**
     * Metoda ustawia tablice pozycji menu
     *
     * @return void
	 * @access protected
     */
	protected function setPositions() {
		$user = Zend_Auth::getInstance()->getIdentity();

		$this->positions[] = new Moondee_Entity_Menu_TaskPosition_AddToGroup( $this->object->id );

		if( !$user->likeExists( $this->object->id ) ){
			$this->positions[] = new Moondee_Entity_Menu_TaskPosition_Like( $this->object->id );
		}
		
	}
	
	/**
     * Metoda zwraca tablice pozycji menu
     *
     * @return Moondee_Entity_Menu_Position[]
	 * @access protected
     */
	protected function getPositions() {
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
		if( $this->getUserIdentity() != 0 && $this->getUserIdentity() != $this->object->getId() ){
			$positions = $this->getPositions();
			$html = '<ul style="float: left;
margin: 0;
padding: 0;
margin-left: 0.8rem;
position: relative;
line-height: normal;
height: 100%;">';

			foreach( $positions as $position ){
				$html .= $position->render();
			}
			$html .= '</ul>';
			return $html;
		}else{
			return '';
		}
	}
	
	/**
     * Metoda zwraca identyfikator użytkownika
     *
     * @return void
	 * @access protected
     */
	protected function getUserIdentity() {
		if( !$this->identity ){
			$auth = Zend_Auth::getInstance();

			if( $auth->hasIdentity() ){
				$this->identity = $auth->getIdentity()->getRealObject()->id;
			}else{
				$this->identity = 0;
			}
		}
		
		return $this->identity;
	}
}
?>