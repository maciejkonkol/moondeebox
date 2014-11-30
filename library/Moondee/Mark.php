<?php

/**
 * Klasa oceny
 *
 * @package    Moondee_Mark
 */

class Moondee_Mark extends Moondee_Application_DatabaseObject
{
	/**
     * Wysokośc oceny
     * 
     * @var integer
	 * @access protected
     */
    protected $value;
	
	/**
     * Id obiektu oceniającego
     * 
     * @var integer
	 * @access protected
     */
    protected $judge;
	
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
		$this->model = new Moondee_Mark_Model_Mark();
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
     * Metoda zwraca id obiektu oceniającego
     *
     * @return integer
	 * @access public
     */ 
	public function getJudge() {
		return $this->judge;
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
     * Metoda ustawia id obiektu oceniającego
     *
	 * @param integer $judge
     * @return void
	 * @access public
     */ 
	public function setJudge( $judge ) {
		$this->judge = $judge;
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




}
?>