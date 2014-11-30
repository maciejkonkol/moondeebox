<?php

/**
 * Abstrakcyjna klasa dla obiektów które są użytkownikami lub atrakcjami
 *
 * @package    Moondee_Entity
 */

abstract class Moondee_Entity extends Moondee_Application_MoondeeDatabaseObject
{
	
    /**
     * Emaile obiektu
     * 
     * @var string[]
     */
    protected $emails = array();
        
    /**
     * Tablica obiektów przechowywująca numery telefonów
     * 
     * @var string[]
     */
    protected $phones = null;
        
    /**
     * Zmienna przechowująca wartość która umorzliwia sprawdzenie czy zostały wprowadzone jakieś zmiany na numerach telefonu obiektu
     * 
     * @var bool
     */
    protected $phones_change = false;
    
    /**
     * Opis obiektu
     * 
     * @var Moondee_Entity_About|Moondee_Entity_About[]
     */
    protected $about = null;
    
    /**
     * grupy obiektu
     * 
     * @var Moondee_Entity_Group[]
     */
    protected $groups = array();
    
    /**
     * Usuniete grupy obiektu
     * 
     * @var Moondee_Entity_Group[]
     */
    protected $deleted_groups = array();
    
    /**
     * Albumy obiektu
     * 
     * @var Moondee_Image_Album[]
	 * @access protected
     */
    protected $albums = array();
    
    /**
     * Usuniete albumy obiektu
     * 
     * @var Moondee_Image_Album[]
	 * @access protected
     */
    protected $deleted_albums = array();
    
    
	
	

	/**
     * Metoda zwraca id wlasciciela obiektu
     *
     * @return integer
     */ 
	public function getOwner() {
		return $this->owner;
	}
	
	/**
     * Metoda ustawia id wlasciciela 
     *
	 * @param integer $owner_id id właściciela obiektu
     * @return void
	 * @access public
     */ 
	public function setOwner( $owner_id ) {
		$this->owner = $owner_id;
	}
	
	/**
     * Metoda zwraca imię użytkownika
     *
     * @return String
     */ 
	public function getName() {
		return $this->name;
	}

	/**
     * Metoda ustawia imię użytkownika
     *
	 * @param  String $name
     * @return mixed
     */ 
	public function setName( $name ) {
		$this->name = $name;
		return $this;
	}
	
	/**
     * Metoda zwraca emaile obiektu
     *
     * @return Moondee_Application_Email[]
     */ 
	public function getEmails() {
		return $this->emails;
	}

	/**
     * Metoda ustawia emaile obiektu
     *
	 * @param  Moondee_Application_Email[] $emails
     * @return mixed
     */ 
	public function setEmails( $emails = null ) {
		$this->emails = $emails;
		return $this;
	}

	/**
     * Metoda zwraca numery telefonów obiektu
     *
     * @return Moondee_Application_Phone[]
     */ 
	public function getPhones() {
		if( $this->phones === null ){
			$this->setPhones();
		}
		return $this->phones;
	}

	/**
     * Metoda ustawia telefony obiektu
     *
	 * @param  Moondee_Application_Phone[] $phones
     * @return mixed
     */ 
	protected function setPhones( $phones = null ) {
		if( $phones ){
			$this->phones = $phones;
			$this->phones_change = true;
		}else{
			$this->phones = Moondee_Entity_Phone_Helper::getObjectPhones( $this->id );
		}
		return $this;
	}

	/**
     * Metoda dodaje numer telefonu obiektowi
     *
	 * @param  String $phone
     * @return mixed
     */ 
	public function addPhone( $phone ) {
		$this->phones[] = $phone;
		$this->phones_change = true;
		return $this;
	}

	/**
     * Metoda usuwa numer telefonu obiektu
     *
	 * @param  String $phone
     * @return void
     */ 
	public function deletePhone( $phone_id ) {
		unset( $this->phones[ $phone_id ] );
		$this->phones_change = true;
	}

	/**
     * Metoda zapisuje numery telefonów obiektu do bazy danych
     *
     * @return void
     */ 
	protected function savePhones() {
		if( $this->phones_change ) {
			Moondee_Entity_Phone_Helper::setObjectPhones( $this->getPhones(), $this->id );
		}
	}
	
	/**
     * Metoda zwraca opisy obiektu
     *
     * @return Moondee_Entity_About|Moondee_Entity_About[]
     */ 
	abstract public function getAbout();
	
	/**
     * Metoda ustawia opisy obiektu
     *
	 * @param  Moondee_Entity_About|Moondee_Entity_About[] $about
     * @return void
     */ 
	abstract public function setAbout( $about );
	
	/**
     * Metoda zwraca menu obiektu
     *
     * @return Moondee_Entity_Menu
	 * @access public
     */ 
	public function getMenu() {
		$menu = new Moondee_Entity_Menu( $this );
		return $menu;
	}
	
	/**
     * Metoda zwraca menu obrazkow obiektu
     *
     * @return Moondee_Application_Menu_Submenu 
	 * @access public
     */ 
	public function getImageMenu() {
		$menu = new Moondee_Application_Menu_Submenu( $this->getImageMenuPositions() );
		return $menu;
	}
	
	/**
     * Metoda zwraca pozycje menu obrazkow
     *
     * @return Moondee_Application_Menu_Submenu_Position[]
	 * @access public
     */ 
	abstract public function getImageMenuPositions();
	
	public function save(){
		$this->savePhones();
		
		parent::save();
	}

	/**
     * Metoda zwraca menu zadan obiektu
     *
     * @return integer
     */ 
	public function getTaskMenu() {
		$menu = new Moondee_Entity_TaskMenu( $this );
		return $menu;
	}

	/**
     * Metoda dodaje grupę
     *
	 * @param  String $name
     * @return Moondee_Entity_Group
     */ 
	public function addGroup( $name ) {
		if( !$this->groups ){
			$this->setGroups();
		}
		
		$group = new Moondee_Entity_Group();
		$group->setOwner( $this->id );
		$group->setName( $name );
		
		return $this->groups[ md5( mt_rand() ) ] = $group;
	}

	/**
     * Metoda zwraca grupy użytkownika
     *
     * @return Moondee_Entity_Group[]
     */ 
	public function getGroups() {
		if( !$this->groups ){
			$this->setGroups();
		}
		
		return $this->groups;
	}

	/**
     * Metoda zwraca grupe obiektu o id podanym w parametrze
     *
     * @return Moondee_Entity_Group
     */ 
	public function getGroup( $group_id ) {
		if( !$this->groups ){
			$this->setGroups();
		}
		
		if( isset( $this->groups[ $group_id ] ) ){
			return $this->groups[ $group_id ];
		}
		return null;
	}

	/**
     * Metoda ustawia grupy obiektu
     *
     * @return void
     */ 
	protected function setGroups() {
		$this->groups = Moondee_Entity_Group_Helper::getObjectGroups( $this->id );
	}

	/**
     * Metoda dodaje domyślne grupy
     *
     * @return void
     */ 
	abstract public function addDefaultGroups();

	/**
     * Metoda zapisuje grupy
     *
     * @return void
     */ 
	public function saveGroups() {
		if( $this->groups ){
			foreach( $this->groups as $key => $group ){
				$new = 0;
				// Sprawdzenie czy grupa jest nowo utworzona i czy jeszcze nie istnieje w bazie danych
				if( !$group->getId() ){
					$new = 1;
				}
				
				$group->save();
				
				//Jesli grupa jest nowo dodana zmieniany jest tymczasowy klucz w tablicy opisow na id opisu
				if( $new ){
					$this->groups[ $group->getId() ] = $group;
					unset( $this->groups[ $key ] );
				}
			}
		}
		
		$delete_groups_id = array();
				
		if( $this->deleted_groups ){
			foreach( $this->deleted_groups as $group ){
				$delete_groups_id[] = $group->id;
			}
			
			Moondee_Entity_Group_Helper::deleteGroups( $delete_groups_id );
			
			$this->deleted_group = array();
		}
	}

	/**
     * Metoda usuwa grupe miejsca
     *
	 * @param integer $id Id grupy do uzuniecia
     * @return void
	 * @access public
     */ 
	public function deleteGroup( $group_id ) {
		//Upewnianie sie ze grupy sa juz ustawione w obiekcie
		$this->getGroups();
		
		if( isset( $this->groups[ $group_id ] ) ){
			$this->deleted_groups[ $group_id ] = $this->groups[ $group_id ];
			unset( $this->groups[ $group_id ] );
		}
	}

	/**
     * Metoda ustawia albumy
     *
     * @return void
	 * @access protected
     */ 
	protected function setAlbums() {
		$this->albums = Moondee_Image_Album_Helper::getObjectAlbums( $this->id );
	}

	/**
     * Metoda zwraca albumy
     *
     * @return Moondee_Image_Album[]
	 * @access public
     */ 
	public function getAlbums() {
		if( !$this->albums ){
			$this->setAlbums();
		}
		
		return $this->albums;
	}

	/**
     * Metoda zwraca album
     *
	 * @param integer $album_id Id albumu ktory ma zostac zwrócony
     * @return Moondee_Image_Album
	 * @access public
     */ 
	public function getAlbum( $album_id ) {
		if( !$this->albums ){
			$this->setAlbums();
		}
		
		if( $this->albums[ $album_id ] ){
			return $this->albums[ $album_id ];
		}else{
			return null;
		}
	}

	/**
     * Metoda usuwa album
     *
	 * @param integer $album_id Id albumu ktory ma zostac usuniety
     * @return void
	 * @access public
     */ 
	public function deleteAlbum( $album_id ) {
		if( !$this->albums ){
			$this->setAlbums();
		}
				
		foreach( $this->albums as $key => $album ){
			if( $album->getId() == $album_id ){
				$this->deleted_albums[] = clone $album;
				unset( $this->albums[ $key ] );
				break;
			}
		}
	}

	/**
     * Metoda zapisuje albumy
     *
     * @return void
	 * @access public
     */ 
	public function saveAlbums() {
		if( $this->albums ){
			foreach( $this->albums as $key => $album ){
				$new = 0;
				// Sprawdzenie czy album jest nowo utworzony i czy jeszcze nie istnieje w bazie danych
				if( !$album->getId() ){
					$new = 1;
				}
				
				$album->save();
				
				//Jesli album jest nowo dodany zmianiany jest tymczasowy klucz w tablicy albomow na id albumu
				if( $new ){
					$this->albums[ $album->getId() ] = clone $album;
					unset( $this->albums[ $key ] );
				}
			}
		}
		
		//Usuwanie z bazy albumow ktore zostaly dodane do listy usunietych
		$delete_albums_id = array();
				
		if( $this->deleted_albums ){
			foreach( $this->deleted_albums as $album ){
				//echo '<pre>'; print_r($delete_albums_id); echo '</pre>';
				$delete_albums_id[] = $album->getId();
			}
			
			Moondee_Image_Album_Helper::deleteAlbums( $delete_albums_id );
			
			$this->deleted_albums= array();
		}
	}

	/**
     * Metoda dodaje album
     *
	 * @param string $album_name Nazwa albumu
     * @return bool |
	 * @access public
     */ 
	public function addAlbum( $album_name ) {
		$album = new Moondee_Image_Album();
		$album->setTitle( $album_name );
		$album->setOwnerId( $this->id );
		
		if( !$this->albums ){
			$this->setAlbums();
		}
		
		//Dodawanie nowego albumu do tablicy albumow z tymczasowym kluczem
		$this->albums[ md5( mt_rand() ) ] = new Moondee_Application_Proxy( $album );
	}

	/**
     * Metoda usuwa obrazek obiektu
     *
	 * @param integer $image_id id obrazka do usuniecia
     * @return bool
	 * @access public
     */ 
	public function deleteImage( $image_id ) {
		$image = new Moondee_Image( (int) $image_id );
		
		if( $image->id && $this->id == $image->getOwner() ){
			Moondee_Image_Helper::deleteImages( array( $image ) );
			
			return true;
		}else{
			return false;
		}
	}

	/**
     * Metoda zwraca obrazki obiektu
     *
	 * @param integer $limit ilosc obrazkow ktora ma zostac zwrocona
	 * @param integer $start pozycja od ktorej maja zostac pobrane obrazki
     * @return bool
	 * @access public
     */ 
	public function getImages( $limit, $start ) {
		$image = new Moondee_Image( (int) $image_id );
		
		if( $image->id && $this->id == $image->getOwner() ){
			Moondee_Image_Helper::deleteImages( array( $image ) );
			
			return true;
		}else{
			return false;
		}
	}

	/**
     * Metoda zwraca miejsca wobec ktorych bierzacy obiekt posiada jakies aktywnosci
     *
     * @return Moondee_Entity_Attraction_Place[]
	 * @access public
     */ 
	public function getActivePlaces() {
		return Moondee_Activity_Helper::getPlaces( $this->id );
	}


	
	
}
?>