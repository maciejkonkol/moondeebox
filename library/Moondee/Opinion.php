<?php

/**
 * Klasa opisu
 *
 * @package    Moondee_Opinion
 */

class Moondee_Opinion extends Moondee_Application_MoondeeDatabaseObject
{
	/**
     * Tekst
     * 
     * @var string
	 * @access protected
     */
    protected $text;
	
	/**
     * Id wlasciciela
     * 
     * @var integer
	 * @access protected
     */
    protected $owner;
	
	/**
     * Id obiektu ktorego dotyczy opis
     * 
     * @var integer
	 * @access protected
     */
    protected $object_id;
	
	
	
	/**
     * Metoda ustawia model opini
     *
     * @return void
	 * @access protected
     */ 
	protected function setModel() {
		$this->model = new Moondee_Opinion_Model_Opinion();
	}
    
	/**
     * Metoda zwraca id wlasciciela opini
     *
     * @return integer
	 * @access public
     */ 
	public function getOwner() {
		return $this->owner;
	}

	/**
     * Metoda zwraca tekst opini
     *
     * @return string
	 * @access public
     */
	public function getText() {
		return $this->text;
	}

	/**
     * Metoda zwraca id obiektu ktoreo dotyczy opinia
     *
     * @return integer
	 * @access public
     */
	public function getObjectId() {
		return $this->object_id;
	}

	/**
     * Metoda ustawia tekst opini
     *
	 * @param string $text Tekst opisu
     * @return void
	 * @access public
     */
	public function setText( $text ) {
		$this->text = $text;
	}

	/**
     * Metoda ustawia id wlasciciela opini
     *
	 * @param integer $owner Id wlasciciela opini
     * @return void
	 * @access public
     */
	public function setOwner( $owner ) {
		$this->owner = $owner;
	}

	/**
     * Metoda ustawia id obiektu ktorego dotyczy opinia
     *
	 * @param integer $object_id id obiektu ktorego dotyczy opinia
     * @return void
	 * @access public
     */
	public function setObjectId( $object_id ) {
		$this->object_id = $object_id;
	}

}
?>