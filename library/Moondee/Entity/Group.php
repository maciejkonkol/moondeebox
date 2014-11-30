<?php

/**
 * Klasa grupy
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Group extends Moondee_Application_DatabaseObject
{
	/**
     * Nazwa grupy
     * 
     * @var string
	 * @access protected
     */
    protected $name = '';
	
	/**
     * Id właściciela grupy
     * 
     * @var integer
	 * @access protected
     */
    protected $owner;
	
	/**
     * Uzytkownicy ktorzy naleza do grupy
     * 
     * @var Moondee_Entity_User[]
	 * @access protected
     */
    protected $users = array();
	
	/**
     * Wszystkie obiekty które naleza do grupy
     * 
     * @var mixed
	 * @access protected
     */
    protected $obiects = array();
    
	
	/**
     * Metoda zwraca id właściciela obiektu
     *
     * @return integer
	 * @access protected
     */ 
	protected function setModel() {
		$this->model = new Moondee_Entity_Model_Group();
	}
    
	
	/**
     * Metoda ustawia naze grupy
     *
	 * @param string $name
     * @return integer
	 * @access public
     */ 
	public function setName( $name ) {
		$this->name = $name;
	}
	
	/**
     * Metoda zwraca naze grupy
     *
     * @return string
	 * @access public
     */ 
	public function getName() {
		return $this->name;
	}
	
	/**
     * Metoda ustawia właściciela grupy
     *
	 * @param string $name
     * @return integer
     */ 
	public function setOwner( $owner_id ) {
		$this->owner = $owner_id;
	}
	
	/**
     * Metoda zwraca właściciela grupy
     *
     * @return string
	 * @access protected
     */ 
	public function getOwner() {
		return $this->owner;
	}
	
	/**
     * Metoda zwraca uzytkownikow nalezacych do grupy
     *
     * @return Moondee_Entity_User[]
	 * @access public
     */ 
	public function getUsers() {
		if( !$this->users ){
			$this->setUsers();
		}
		
		return $this->users;
	}
	
	/**
     * Metoda zwraca obiekty nalezace do grupy
     *
     * @return mixed
	 * @access public
     */ 
	public function getObjects() {
		if( !$this->users ){
			$this->setUsers();
		}
		
		return $this->users;
	}
	
	/**
     * Metoda ustawia uzytkownikow nalezacych do grupy
     *
     * @return Moondee_Entity_User[]
	 * @access public
     */ 
	public function setUsers() {
		$data_row = $this->getDatabaseObjectRow();
		$data = $data_row->findManyToManyRowset( 'Moondee_Entity_Model_User', 'Moondee_Entity_Model_GroupObject' );
		
		$users = array();
		
		foreach( $data as $row ){
			$users[ $row['id'] ] = new Moondee_Application_Proxy( new Moondee_Entity_User( $row ) );
		}
		
		$this->users = $users;
	}
	
	/**
     * Ustawia objekty nalezace do grupy
     *
     * @return void
	 * @access public
     */  
	public function setObjects() {
		$model = $this->getModel();
		$data = $model->getGroupObjects( $this->id );
		
		$objects = array();
		
		foreach( $data as $row ){
			$objects[ $row['id'] ] = new $row['class']( $row );
		}
		
		$this->objects = $objects;
	}
	
	/**
     * Metoda dodaje obiekt do grupy
     *
	 * @param integer $object_id
     * @return bool
	 * @access public
     */  
	public function addObject( $object_id ) {
		if( $this->hasObject( $object_id ) ){
			return false;
		}
		
		$group_object_model = new Moondee_Entity_Model_GroupObject();
		$group_object_model->insert( array( 'group_id' => $this->id, 'object_id' => $object_id ) );
	
		$this->objects = array();
		
		return true;
	}
	
	/**
     * Metoda sprawdza czy grupa posiada obiekt o id podanym w parametrze
     *
	 * @param integer $object_id
     * @return bool
	 * @access public
     */  
	public function hasObject( $object_id ) {
		$group_object_model = new Moondee_Entity_Model_GroupObject();
		$row = $group_object_model->fetchRow( 'group_id = '.$this->id.' AND object_id = '.$object_id );
	
		if( $row ){
			return true;
		}
		
		return false;
	}

	

}
?>