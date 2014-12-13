<?php

/**
 * Klasa obrazku
 *
 * @package    Moondee_Image
 */

class Moondee_Image extends Moondee_Application_MoondeeDatabaseObject
{
    /**
     * Tytuł obrazka
     * 
     * @var string
	 * @access protected
     */
    protected $title;
    
    /**
     * Opis obrazka
     * 
     * @var string
	 * @access protected
     */
    protected $describe;
    
    /**
     * Data wykonania obrazka
     * 
     * @var string
	 * @access protected
     */
    protected $date_execution;
    
    /**
     * Data dodania obrazka
     * 
     * @var string
	 * @access protected
     */
    protected $date_added;
	
	/**
     * Id właściciela
     * 
     * @var integer
	 * @access protected
     */
    protected $owner;
	
	/**
     * Serwer na jakim znajduje sie obrazek
     * 
     * @var string
	 * @access protected
     */
    protected $server;
	
	/**
     * Ścieżka do pliku obrazka
     * 
     * @var string
	 * @access protected
     */
    protected $path;
	
	/**
     * Nazwa pliku obrazka
     * 
     * @var string
	 * @access protected
     */
    protected $file;
        
    /**
     * Rozszeżenie pliku obrazka
     * 
     * @var string
	 * @access protected
     */
    protected $extension;
        
    /**
     * Id albumu do jakiego nalezy obrazek
     * 
     * @var integer
	 * @access protected
     */
    protected $album = null;
	

    /**
    * Metoda ustawia model
    *
    * @return void
    * @access protected
    */ 
    protected function setModel() {
        $this->model = new Moondee_Image_Model_Image();
    }

    /**
    * Metoda ustawia sciezke i nazwe pliku
    *
    * @return void
    * @access public
    */ 
    public function setPathAndFile() {
        if( $this->id ){
            $tab = str_split( sprintf( "%1$020d", $this->id ), 2 );
            $file = $tab[ count( $tab ) - 1 ];
            unset( $tab[ count( $tab ) - 1 ] );

            $this->path = implode( "/", $tab );
            $this->file = $file;
        }
    }
	
    /**
    * Metoda zwraca tytu�
    *
    * @return string
    * @access public
    */ 
    public function getTitle() {
            return $this->title;
    }

    /**
    * Metoda zwraca opis
    *
    * @return string
    * @access public
    */ 
	public function getDescribe() {
		return $this->describe;
	}

	/**
     * Metoda zwraca date dodania wykonania obrazka
     *
     * @return string
	 * @access public
     */ 
	public function getDate_execution() {
		return $this->date_execution;
	}

	/**
     * Metoda zwraca date dodania
     *
     * @return string
	 * @access public
     */ 
	public function getDate_added() {
		return $this->date_added;
	}

	/**
     * Metoda ustawia id wlasciciela
     *
	 * @param integer $object_id id obiektu ktory jest wlascicielem obrazka
     * @return void
	 * @access public
     */ 
	public function setOwner( $object_id = null ) {
		if( !$object_id ){
			if( $this->id ){
                            $this->owner = $this->getDatabaseObjectRow()->findParentRow( 'Moondee_Image_Model_Album' )['owner'];
			}else{
				return null;
			}
		}else{
			$this->owner = $object_id;
		}
	}

	/**
     * Metoda zwraca zwraca id wlasciciela
     *
     * @return integer
	 * @access public
     */ 
	public function getOwner() {
		if( !$this->owner ){
			$this->setOwner();
		}
		
		return $this->owner;
	}

	/**
     * Metoda ustawia serwer
     *
	 * @param string $server
     * @return void
	 * @access public
     */ 
	public function setServer( $server ) {
		$this->server = $server;
	}

	/**
     * Metoda zwraca serwer
     *
     * @return string
	 * @access public
     */ 
	public function getServer() {
		return $this->server;
	}

	/**
     * Metoda zwraca sciezke do pliku
     *
     * @return string
	 * @access public
     */ 
    public function getPath() {
        return $this->path;
    }

	/**
     * Metoda zwraca nazwe pliku
     *
     * @return string
	 * @access public
     */ 
	public function getFile() {
		return $this->file;
	}

	/**
     * Metoda zwraca rozszezenie pliku
     *
     * @return string
	 * @access public
     */ 
	public function getExtension() {
		return $this->extension;
	}

	/**
     * Metoda ustawia rozszezenie pliku
     *
	 * @param string $extension Rozszerzenie pliku
     * @return void
	 * @access public
     */ 
	public function setExtension( $extension ) {
		$this->extension = $extension;
	}

	/**
     * Metoda zwraca sciezke wraz z nazwa pliku obrazka
     *
     * @return string
	 * @access public
     */ 
	public function getSrc() {
		return $this->getPath().'/'.$this->getFile().'.'.$this->getExtension();
	}

	/**
     * Metoda ustawia id albumu do jakiego nalezy obrazek
     *
	 * @param integer $album_id id albumu do ktorego nalezy obrazek
     * @return string
	 * @access public
     */ 
	public function setAlbum( $album_id ) {
		$this->album = $album_id;
	}

	/**
     * Metoda zwraca id albumu do jakiego nalezy obrazek
     *
     * @return string
	 * @access public
     */ 
	public function getAlbum() {
		return $this->album;
	}


}
?>