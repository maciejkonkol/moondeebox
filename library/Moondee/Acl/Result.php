<?php

/**
 * Klasa zasobów uprawniń
 *
 * @package    Moondee_Acl
 */

class Moondee_Acl_Result
{
	/**
     * status operacji
     * 
     * @var integer
	 * @access public
     */
    public $status = 0;
	
	public function __construct( $status = 0 ) {
		$this->status = $status;
	}

	/**
     * Metoda zwraca instancje obiektu z statusem 0
     *
     * @return Moondee_Acl_Result
	 * @access public
     */ 
	static public function failed() {
		return new self( 0 );
	}

	/**
     * Metoda zwraca instancje obiektu z statusem 1
     *
     * @return Moondee_Acl_Result
	 * @access public
     */ 
	static public function success() {
		return new self( 1 );
	}
	
	public function __toString() {
		return '';
	}
	
	public function __call($name, $arguments) {
		return null;
	}
	
}
?>