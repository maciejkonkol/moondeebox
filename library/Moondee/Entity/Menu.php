<?php

/**
 * Klasa menu obiektu
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Menu
{
	/**
	 * Pozycje menu
	 *
	 * @var Moondee_Entity_Menu_Position[]
	 * @access protected
	 */
	protected $positions = array();
	
	/**
	 * Obiekt do ktorego nalezy menu
	 *
	 * @var mixed
	 * @access protected
	 */
	protected $object;
	
	/**
	 * Identyfikator użytkownika (user id)
	 *
	 * @var integer
	 * @access protected
	 */
	protected $identity;
	
	/**
	 * Tablica metod uzytkownika do jakich wymagany jest dostep aby dodać pozycje menu
	 *
	 * @var string[]
	 * @access protected
	 */
	protected $user_positions_method = array(
		'getDesktop' => 'Pulpit',
		'getAlbums' => 'Images',
		'getEvents' => 'Events',
		'getPlaces' => 'Places',
		'getAbout' => 'About'
	);
	
	/**
	 * Tablica metod miejscado jakich wymagany jest dostep aby dodać pozycje menu
	 *
	 * @var string[]
	 * @access protected
	 */
	protected $place_positions_method = array(
		'getAlbums' => 'Images',
		'getEvents' => 'Events',
		'getAbouts' => 'About'
	);
	
	
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
     * Metoda zwraca tablice metod pozycji menu w zaleznosci do jakieo obiektu nalezy menu
     *
     * @return string[]
	 * @access protected
     */
	protected function getPositionsMethod() {
		switch ( get_class( $this->object ) ) {
			case 'Moondee_Entity_User':
				return $this->user_positions_method;
				break;
			case 'Moondee_Entity_Attraction_Place':
				return $this->place_positions_method;
				break;

			
		}
		
		return array();
	}
	
	/**
     * Metoda ustawia tablice pozycji menu
     *
     * @return void
	 * @access protected
     */
	protected function setPositions() {
		$identity = $this->getUserIdentity();
		$acl = Moondee_Acl::getInstance();
		
		foreach( $this->getPositionsMethod() as $method => $anchor ){
			if( $acl->isAllowed( $this->object, $method, $identity ) ){
				$this->positions[] = new Moondee_Entity_Menu_Position( $method, $this->object->id, $anchor );
			}
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
	
	/**
     * Metoda zwraca kod html wyrenderowanego menu
     *
     * @return string
	 * @access public
     */
	public function render() {
		$positions = $this->getPositions();
		$html = '<ul style="float: right; margin: 0; padding: 0; margin-left: 0px; text-align: right; margin-right: 2%; font-size: 170%; height: 100%;">';

		foreach( $positions as $position ){
			$html .= $position->render().'<span style="margin-top: -0.3rem; float: left;" >|</span>';
		}
		$html .= '</ul>';
		return $html;
		
	}
}
?>