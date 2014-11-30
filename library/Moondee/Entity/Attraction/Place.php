<?php

/**
 * Klasa miejsca
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Attraction_Place extends Moondee_Entity_Attraction
{
	/**
     * grupy miejsca
     * 
     * @var Moondee_Entity_Group[]
	 * @access public
     */
    protected $groups = array();
	
	
	/**
     * Metoda zwraca obpis obiektu
     *
     * @return integer
	 * @access public
     */ 
	public function getAbout() {
		return $this->about;
	}
	
	/**
     * Metoda zwraca id właściciela obiektu
     *
     * @return integer
	 * @access public
     */ 
	public function setAbout( $about ) {
		$this->about = $about;
	}
	
	/**
     * Metoda ustawia model obiektu miejsca
     *
     * @return void
	 * @access protected
     */ 
	protected function setModel() {
		$this->model = new Moondee_Entity_Model_Place();
	}

	/**
     * Metoda dodaje domyślne grupy
     *
     * @return void
     */ 
	public function addDefaultGroups() {
		$this->groups = array_merge( $this->groups , $groups = Moondee_Entity_Group_Helper::getPlaceDefaultGroups( $this->id ) );
	}

	/**
     * Metoda zapisuje miejsce
     *
     * @return void
     */ 
	public function save() {
		$save_groups = false;
		
		if( !$this->id ){
			$save_groups = true;
		}
		
		parent::save();
		
		if( $save_groups ){
			$this->addDefaultGroups();
			$this->saveGroups();
		}
	}
	
	

	/**
     * Metoda zwraca pozycje menu obrazkow
     *
     * @return Moondee_Application_Menu_Submenu_Position[]
     */ 
	public function getImageMenuPositions() {
		return array(
			new Moondee_Application_Menu_Submenu_Position('Albumy', array( "module" => "image", "controller" => "image", "action" => "albums", "entity" => $this->id ) ),
			new Moondee_Application_Menu_Submenu_Position('Wszystkie Foty', array( "module" => "image", "controller" => "image", "action" => "albums", "entity" => $this->id ))
		);
	}
}
?>