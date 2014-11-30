<?php

/**
 * Klasa użytkownika
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_User extends Moondee_Entity
{
	/**
     * Imię użytkownika
     * 
     * @var string
     */
    protected $name = '';
	
	/**
     * Nazwisko użytkownika
     * 
     * @var string
     */
    protected $surname = '';
    
    /**
     * Zachaszowane hasło użytkownika
     * 
     * @var string
     */
    protected $password = '';
    
    /**
     * Opis uzytkownika
     * 
     * @var Moondee_Description
     */
    protected $description = '';
	
	
	/**
     * Metoda zwraca id własciciela obiektu czyli id bierzacego obiektu
     *
     * @return integer
	 * @access public
     */ 
	public function getOwner(){
		return $this->id;
	}
	
	/**
     * Metoda ustawia i haszuje haslo
     *
	 * @param string $password
     * @return Moondee_Entity_User
     */ 
	public function setPassword( $password ){
		$this->password = md5( $password );
		return $this;
	}

	/**
     * Metoda zwraca zahaszowane haslo użytkownika
     *
     * @return String
     */ 
	public function getPassword() {
		return $this->password;
	}

	/**
     * Metoda zwraca opis użytkownika
     *
     * @return Moondee_Entity_About
     */ 
	public function getAbout() {
		return $this->about;
	}

	/**
     * Metoda ustawia opis użytkownika
     *
	 * @param  Moondee_Entity_About $about
     * @return Moondee_Entity_User
     */ 
	public function setAbout( $about ) {
		$this->about = $about;
		return $this;
	}

	/**
     * Metoda zwraca nazwisko użytkownika
     *
     * @return String
     */ 
	public function getSurname() {
		return $this->surname;
	}

	/**
     * Metoda ustawia nazwisko użytkownika
     *
	 * @param  String $surname
     * @return Moondee_Entity_User
     */ 
	public function setSurname( $surname ) {
		$this->surname = $surname;
		return $this;
	}

	/**
     * Metoda ustawia model obiektu user
     *
     * @return void
     */ 
	public function setModel() {
		$this->model = new Moondee_Entity_Model_User();
	}

	/**
     * Metoda dodaje domyślne grupy
     *
     * @return void
     */ 
	public function addDefaultGroups() {
		$this->groups = array_merge( $this->groups , $groups = Moondee_Entity_Group_Helper::getUserDefaultGroups( $this->id ) );
	}

	/**
     * Metoda zapisuje użytkownika
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
     * Metoda zwraca menu obiektu użytkownika
     *
     * @return Moondee_Entity_Menu
     */ 
	public function getMenu() {
		$menu = new Moondee_Entity_Menu( $this );
		return $menu;
	}

	/**
     * Metoda usuwa dane z obiektu ktore nie maja byc przechowywane w sesji
     *
     * @return void
	 * @access public
     */ 
	public function clearToSession() {
		unset( $this->groups );
		unset( $this->deleted_groups );
		unset( $this->albums );
		unset( $this->deleted_albums );
	}

	/**
     * Dodaje obiekt do grupy
     *
	 * @param integer $object_id
	 * @param integer $group_id
     * @return bool
	 * @access public
     */ 
	public function addToGroup( $object_id, $group_id) {
		$group = $this->getGroup( $group_id );
		
		if( $group ){
			if( $group->addObject( $object_id ) ){
				return true;
			}
			return false;
		}
		
		return false;
	}

	/**
     * Motoda zwraca grupy do jakich nalezy obiekt o id podanym w parametrze
     *
	 * @param integer $object_id
     * @return Moondee_Entity_Group[]
	 * @access public
     */ 
	public function getGroupsHavingObject( $object_id ) {
		$groups = Moondee_Entity_Group_Helper::getUserGroupsHavingObject( $object_id, $this->id );
		
		return $groups;
	}

	/**
     * Motoda sprawdza czy uzytkownik lubi obiekt o id podanym w parametrze
     *
	 * @param integer $object_id
     * @return bool | Moondee_Application_Like
	 * @access public
     */ 
	public function likeExists( $object_id ) {
		return Moondee_Application_Like_Helper::likeExists( $object_id, $this->id );
	}

	/**
     * Polubienie obiektu
     *
	 * @param integer $object_id
     * @return bool
	 * @access public
     */ 
	public function like( $object_id ) {
		if( !Moondee_Application_Like_Helper::likeExists( $object_id, $this->id ) ){
			$like = new Moondee_Application_Like();
			$like->setDate();
			$like->setUserId( $this->id );
			$like->setObjectId( $object_id );

			$like->save();
			
			return true;
		}else{
			return false;
		}
	}

	/**
     * Metoda sprawdza czy uzytkownik byl w miejscu o id podanym w parametrze
     *
	 * @param integer $place_id
     * @return bool
	 * @access public
     */ 
	public function ifWasThere( $place_id ) {
		return Moondee_Entity_Attraction_Place_Helper::ifWasThere( $this->id , $place_id );
	}

	/**
     * Metoda zwraca miejsca miejsa w jakich byl uzytkownik jakie tworzy i w jakich ma zamiar byc
     *
     * @return Moondee_Entity_Attraction_Place[]
	 * @access public
     */ 
	public function getAllPlaces() {
		
	}
	
	/**
     * Metoda zwraca emaile użytkownika
     *
     * @return Moondee_Application_Email[]
     */ 
	public function getEmails() {
		if( !$this->emails ){
			$this->setEmails();
		}
		
		return $this->emails;
	}

	/**
     * Metoda ustawia emaile użytkownika
     *
	 * @param  Moondee_Application_Email[] $emails
     * @return mixed
     */ 
	public function setEmails( $emails = null ) {
		if( $emails ){
			$this->emails = $emails;
		}else{
			if( $this->id ){
				$this->emails = Moondee_Entity_Email_Helper::getEntityEmails( $this->id );
			}else{
				$this->emails = array();
			}
		}
	}

	/**
     * Metoda ustawia opis uzytkownika
     *
     * @return void
     */ 
	public function setDescription() {
		$data = Moondee_Description_Helper::getObjectDescriptions( $this->id );
		$description = current( $data );
		
		if( $description ){
			$this->description = $description;
		}
	}

	/**
     * Metoda zwraca opis uzytkownika
     *
     * @return void
     */ 
	public function getDescription() {
		if( !$this->description ){
			$this->setDescription();
		}
		
		return $this->description;
	}

	/**
     * Metoda zwraca miejsce zamieszkania uzytkownika
     *
     * @return void
     */ 
	public function getHome() {
		
		return 'Jastarnia';
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