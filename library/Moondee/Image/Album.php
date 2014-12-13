<?php

/**
 * Klasa Albumu
 *
 * @package    Moondee_Image
 */

class Moondee_Image_Album extends Moondee_Application_MoondeeDatabaseObject
{
    /**
     * Tytuł albumu
     * 
     * @var string
	 * @access protected
     */
    protected $title;
    
    /**
     * Opis albumu
     * 
     * @var string
	 * @access protected
     */
    protected $describe;
	
	/**
     * Id właściciela
     * 
     * @var integer
	 * @access protected
     */
    protected $owner;
	
	/**
     * Obrazki znajdujace sie w albumie
     * 
     * @var Moondee_Image[]
	 * @access protected
     */
    protected $images = array();
    
    /**
     * Usuniete obrazki albumu
     * 
     * @var Moondee_Image[]
	 * @access protected
     */
    protected $deleted_images = array();
	

	/**
     * Metoda ustawia model
     *
     * @return void
	 * @access protected
     */ 
	protected function setModel() {
		$this->model = new Moondee_Image_Model_Album();
	}
	
	/**
     * Metoda zwraca tytul albumu
     *
     * @return string
	 * @access public
     */ 
	public function getTitle() {
		return $this->title;
	}
	
	/**
     * Metoda ustawia tytul albumu
     *
	 * @param string $album_title Tytul albumu
     * @return void
	 * @access public
     */ 
	public function setTitle( $album_title ) {
		$this->title = $album_title;
	}

	/**
     * Metoda zwraca opis albumu
     *
     * @return string
	 * @access public
     */ 
	public function getDescribe() {
		return $this->describe;
	}

	/**
     * Metoda zwraca id właściciela albumu
     *
     * @return integer
	 * @access public
     */ 
	public function getOwner() {
		return $this->owner;
	}

	/**
     * Metoda ustawia id właściciela albumu
     *
	 * @param integer $owner_id Id obiektu ktory jest wlascicielem albumu
     * @return void
	 * @access public
     */ 
	public function setOwnerId( $owner_id ) {
		$this->owner = $owner_id;
	}

	/**
     * Metoda ustawia obrazki albumu
     *
     * @return void
	 * @access protected
     */ 
	protected function setImages() {
		$this->images = Moondee_Image_Helper::getAlbumImages( $this->id );		
	}

	/**
     * Metoda zwraca obrazki albumu
     *
     * @return Moondee_Image[]
	 * @access public
     */ 
	public function getImages() {
		if( !$this->images ){
			$this->setImages();
		}
		
		return $this->images;
	}

	/**
     * Metoda zwraca obrazki albumu
     *
	 * @param integer $image_id Id obrazka ktory ma byc zwrocony
     * @return Moondee_Image
	 * @access public
     */ 
	public function getImage( $image_id ) {
		if( !$this->images ){
			$this->setImages();
		}
		
		if( $this->images[ $image_id ] ){
			return $this->images[ $image_id ];
		}else{
			return null;
		}
	}

	/**
     * Metoda usuwa obrazek
     *
	 * @param integer $image_id Id obrazka ktory ma zostac usuniety
     * @return void
	 * @access public
     */ 
	public function deleteImage( $image_id ) {
		if( !$this->images ){
			$this->setImages();
		}
		
		foreach( $this->images as $key => $image ){
			if( $image->id == $image_id ){
				$this->deleted_images = $image;
				unset( $this->images[ $key ] );
				break;
			}
		}
	}
	
    /**
    * Metoda dodaje obrazek
    *
    * @param Zend_Form_Element_File $file 
    * @return Moondee_Image
    * @access public
    */ 
    public function addImage( $file ) {
		Zend_Db_Table::getDefaultAdapter()->beginTransaction();
		
		//Tworzenie obiektu obrazka
		$image = new Moondee_Image();
		$image->save();
		$image->setPathAndFile();
		$image->setAlbum( $this->id );
		$image->setOwner( $this->owner );
		$image->setExtension( $file->getFileExtension() );
		
		//Sprawdzenie czy istnieje folder do obrazka jesli nie to tworzenie go
		$path = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('moondee')['image']['path'].'/'.$image->getPath();
		
		if( !is_dir( $path ) ){
			if( !mkdir( $path, '0777', true ) ){
				Zend_Db_Table::getDefaultAdapter()->rollBack();
				return false;
			}
		}
		
		//Zmiana nazwy pliku
		$file->addFilter( 'Rename', array( 
			'target' => $path.'/'.$image->getFile().'.'.$image->getExtension(),
			'overwrite' => true
		) );
		
		//Przenoszenie pliku do docelowego miejsca
		if( $file->receive() ){
			$image->save();
			Zend_Db_Table::getDefaultAdapter()->commit();			
		}else{
			Zend_Db_Table::getDefaultAdapter()->rollBack();
			
			return false;
		}
		
		$proxy_image = new Moondee_Application_Proxy( $image );
		
		if( $this->images ){
			$this->images[ $image->id ] = $proxy_image;
		}
		
		return $proxy_image;
		
	}

    /**
    * Metoda zapisuje obrazki
    *
    * @return void
    * @access public
    */ 
    public function saveImages() {
        if( $this->images ){
            foreach( $this->images as $image ){
                $image->save();
            }
        }

        if( $this->deleted_images ){
            Moondee_Image_Helper::deleteImages( $this->deleted_images );

            $this->deleted_images = array();
        }
    }


}
?>