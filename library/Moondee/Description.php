<?php

/**
 * Klasa opisu
 *
 * @package    Moondee_Description
 */

class Moondee_Description extends Moondee_Application_MoondeeDatabaseObject
{
	use Moondee_Mark_Ability;
	
	/**
     * Tekst
     * 
     * @var string
	 * @access protected
     */
    protected $text;
	
	/**
     * Id obiektu który stworzł opis
     * 
     * @var integer
	 * @access protected
     */
    protected $writer;
	
	/**
     * Id obiektu ktorego dotyczy opis
     * 
     * @var integer
	 * @access protected
     */
    protected $object_id;
	
	
	
	/**
     * Metoda ustawia model opisu
     *
     * @return void
	 * @access protected
     */ 
	protected function setModel() {
		$this->model = new Moondee_Description_Model_Description();
	}
    
	/**
     * Metoda zwraca id wlasciciela opisu
     *
     * @return integer
	 * @access public
     */ 
	public function getOwner() {
		return $this->writer;
	}
    
	/**
     * Metoda zwraca id wlasciciela opisu
     *
     * @return integer
	 * @access public
     */ 
	public function getWriter() {
		return $this->writer;
	}

	/**
     * Metoda zwraca tekst opisu
     *
     * @return string
	 * @access public
     */
	public function getText() {
		return $this->text;
	}

	/**
     * Metoda zwraca id obiektu ktoreo dotyczy opis
     *
     * @return integer
	 * @access public
     */
	public function getObjectId() {
		return $this->object_id;
	}

	/**
     * Metoda ustawia tekst opisu
     *
	 * @param string $text Tekst opisu
     * @return void
	 * @access public
     */
	public function setText( $text ) {
		$this->text = $text;
	}

	/**
     * Metoda ustawia id wlasciciela opisu
     *
	 * @param integer $owner Id wlasciciela opisu
     * @return void
	 * @access public
     */
	public function setWriter( $owner ) {
		$this->writer = $writer;
	}

	/**
     * Metoda ustawia id obiektu ktorego dotyczy opis
     *
	 * @param integer $object_id id obiektu ktorego dotyczy opis
     * @return void
	 * @access public
     */
	public function setObjectId( $object_id ) {
		$this->object_id = $object_id;
	}

	/**
     * Metoda zwraca ocene obiektu
     *
     * @return Moondee_Mark_Average
	 * @access public
     */
	public function getMark() {
		return Moondee_Mark_Helper::getObjectAverageMark( $this->id );
	}

}
?>