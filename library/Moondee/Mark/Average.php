<?php

/**
 * Klasa średniej oceny
 *
 * @package    Moondee_Mark
 */

class Moondee_Mark_Average extends Moondee_Application_DatabaseObject
{
	/**
     * Wysokośc oceny
     * 
     * @var integer
	 * @access protected
     */
    protected $value;
	
	/**
     * ilość głosów
     * 
     * @var integer
	 * @access protected
     */
    protected $num;
	
	/**
     * Id obiektu ocenianego
     * 
     * @var integer
	 * @access protected
     */
    protected $object;
	
	
	
	/**
     * Metoda ustawia model oceny
     *
     * @return void
	 * @access protected
     */ 
	protected function setModel() {
		$this->model = new Moondee_Mark_Model_MarkAverage();
	}
    
	/**
     * Metoda zwraca wysokośc oceny
     *
     * @return integer
	 * @access public
     */ 
	public function getValue() {
		return $this->value;
	}

	/**
     * Metoda zwraca id obiektu ocenianego
     *
     * @return integer
	 * @access public
     */ 
	public function getObject() {
		return $this->object;
	}

	/**
     * Metoda zwraca ilość głosów
     *
     * @return integer
	 * @access public
     */ 
	public function getNum() {
		return $this->num;
	}
	
	/**
     * Metoda ustawia wysokośc oceny
     *
	 * @param integer $value
     * @return void
	 * @access public
     */ 
	public function setValue( $value ) {
		$this->value = $value;
	}

	/**
     * Metoda ustawia id obiektu ocenianego
     *
	 * @param integer $object_id
     * @return void
	 * @access public
     */ 
	public function setObject( $object_id ) {
		$this->object = $object_id;
	}

	/**
     * Metoda ustawia ilość głosów
     *
	 * @param integer $object_id
     * @return void
	 * @access public
     */ 
	public function setNum( $num ) {
		$this->num = $num;
	}

	/**
     * Metoda dodaje ocene do średniej
     *
	 * @param integer $mark
     * @return void
	 * @access public
     */ 
	public function addMark( $mark ) {
		$new_average = ( ( $this->getValue() * $this->getNum() ) + $mark ) / ( $this->getNum() + 1 );
		$this->setValue( $new_average );
		
		$this->setNum( $this->getNum() + 1 );
	}

	/**
     * Metoda usuwa ocene ze średniej
     *
	 * @param integer $mark
     * @return void
	 * @access public
     */ 
	public function deleteMark( $mark ) {
		$new_average = ( ( $this->getValue() * $this->getNum() ) - $mark ) / ( $this->getNum() - 1 );
		$this->setValue( $new_average );
		
		$this->setNum( $this->getNum() - 1 );
	}

}
?>