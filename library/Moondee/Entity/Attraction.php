<?php

/**
 * Abstrakcyjna klasa dla obiektów które są atrakcjami
 *
 * @package    Moondee_Entity
 */

abstract class Moondee_Entity_Attraction extends Moondee_Entity
{
	use Moondee_Mark_Ability;
	
	/**
     * Opisy obiektu
     * 
     * @var Moondee_Description[]
	 * @access protected
     */
    protected $descriptions = array();
    
    /**
     * Usuniete opisy obiektu
     * 
     * @var Moondee_Description[]
	 * @access protected
     */
    protected $deleted_descriptions = array();
    
    /**
     * Ilość opisów
     * 
     * @var integer
	 * @access protected
     */
    protected $num_descriptions;
	
	
	/**
     * Metoda dodaje opis obiektu
     *
	 * @param integer $writer_id Id obiektu który dodaje opis
	 * @param string $text Tekst opisu
     * @return Moondee_Description
	 * @access public
     */ 
	public function addDescription( $writer_id, $text ) {
		if( !$this->descriptions ){
			$this->setDescriptions();
		}
		
		$description = new Moondee_Description();
		$description->setObjectId( $this->id );
		$description->setWriter( $writer_id );
		$description->setText( $text );
				
		//Dodawanie nowego opisu do tablicy opisu z tymczasowym kluczem
		$this->descriptions[ md5( mt_rand() ) ] = new Moondee_Application_Proxy( $description );
		
		return $description;
	}
	
	/**
     * Metoda usuwa opis
     *
	 * @param integer $description_id Id opisu ktory ma zostac usuniety
     * @return void
	 * @access public
     */ 
	public function deleteDescription( $description_id ) {
		//Upewnianie sie ze opsisy sa juz ustawione w obiekcie
		$this->getDescriptions();
		
		if( isset( $this->descriptions[ $description_id ] ) ){
			$this->deleted_descriptions[ $description_id ] = $this->descriptions[ $description_id ];
			unset( $this->descriptions[ $description_id ] );
		}
	}

	/**
     * Metoda  zwraca opisy obiektu
     *
     * @return Moondee_Describe[]
	 * @access public
     */ 
	public function getDescriptions() {
		if( !$this->descriptions ){
			$this->setDescriptions();
		}
		
		return $this->descriptions;
	}

	/**
     * Metoda ustawia opisy obiektu
     *
     * @return void
	 * @access public
     */ 
	public function setDescriptions() {
		$this->descriptions = Moondee_Description_Helper::getObjectDescriptions( $this->id );
	}
	
	/**
     * Metoda zapisuje opisy
     *
     * @return void
	 * @access public
     */ 
	public function saveDescriptions() {
		if( $this->descriptions ){
			foreach( $this->descriptions  as $key => $description ){
				$new = 0;
				// Sprawdzenie czy album jest nowo utworzony i czy jeszcze nie istnieje w bazie danych
				if( !$description->getId() ){
					$new = 1;
				}
				
				//echo $description->getRealObject()->getOwner();
				//echo '<pre>'; print_r( $description->save() ); echo '</pre>';
				$description->save();
				//Jesli opis jest nowo dodany zmianiany jest tymczasowy klucz w tablicy opisow na id opisu
				if( $new ){
					$this->descriptions[ $description->getId() ] = $description;
					unset( $this->description[ $key ] );
				}
			}
		}

		//Usuwanie z bazy opisow ktore zostaly dodane do listy usunietych
		$delete_descriptions_id = array();

		if( $this->deleted_descriptions ){
			foreach( $this->deleted_descriptions as $description ){
				$delete_descriptions_id[] = $description->getId();
			}
			
			Moondee_Description_Helper::deleteDescriptions( $delete_descriptions_id );
			
			$this->deleted_descriptions = array();
		}
		
	}
	
	/**
     * Metoda dodaje ocene obiektowi
     *
	 * @param integer $judge Id obiektu oceniającego
	 * @param integer $value Ocena
     * @return boolean
	 * @access public
     */ 
	public function addMark( $judge, $value ) {
		return Moondee_Mark_Helper::addMarkToObject( $this->id, $judge, $value );
	}
	
	/**
     * Metoda zmienia ocene obiektu
     *
	 * @param integer $judge Id obiektu oceniającego
	 * @param integer $value Ocena
     * @return void
	 * @access public
     */ 
	public function changeMark( $judge, $value ) {
		Moondee_Mark_Helper::changeMarkObject( $this->id, $judge, $value );
	}

	/**
     * Metoda usuwa ocene obiektu
     *
	 * @param integer $judge Id obiektu oceniającego
     * @return void
	 * @access public
     */ 
	public function deleteMark( $judge ) {
		Moondee_Mark_Helper::deleteMarkFromObject( $this->id, $judge );
	}

	/**
     * Metoda sprawdza czy obiekt został już oceniony
     *
     * @return Moondee_Mark | bool
	 * @access public
     */ 
	public function isMark( $judge ) {
		$mark = Moondee_Mark_Helper::getMark( $this->id, $judge );
		
		if( $mark ){
			return $mark;
		}else{
			false;
		}
	}

	/**
     * Metoda zwraca ocene nadana przez obiekt
     *
     * @return Moondee_Mark | null
	 * @access public
     */ 
	public function getMark( $judge ) {
		$mark = Moondee_Mark_Helper::getMark( $this->id, $judge );
		
		if( $mark ){
			return $mark;
		}else{
			null;
		}
	}

	/**
     * Metoda zwraca opis atrakcji który posiadanajwyższą ocene
     *
     * @return Moondee_Description | null
	 * @access public
     */ 
	public function getBestDescription() {
		
		return Moondee_Description_Helper::getObjectBestDescription( $this->id );
	}

	/**
     * Metoda zwraca ilość opisow jaką posiada dany obiekt
     *
     * @return integer
	 * @access public
     */ 
	public function getNumDescriptions() {
		if( !$this->num_descriptions ){
			$this->num_descriptions = Moondee_Description_Helper::getObjectNumDescription( $this->id );
		}
		
		return $this->num_descriptions;
	}
}
?>