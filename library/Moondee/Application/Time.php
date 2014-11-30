<?php

/**
 * Klasa czasu
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Time
{
	/**
	 * Czas w postaci stringa
	 *
	 * @var string
	 * @access protected
	 */	
	protected $time_string;
	
	/**
	 * Godzina
	 *
	 * @var integer
	 * @access protected
	 */	
	protected $hour;
	
	/**
	 * Minuta
	 *
	 * @var integer
	 * @access protected
	 */	
	protected $minute;
	
	/**
	 * Sekunda
	 *
	 * @var integer
	 * @access protected
	 */	
	protected $second;
	
	
	/**
     * Konstruktor czasu
     *
     * @param string $time
     * @return void
	 * @access public
     */
	public function __construct( $time ) {
		$this->time_string = $time;
	}
	
	/**
     * Metoda dzieli date w postaci stringa na czesci
     *
     * @return void
	 * @access protected
     */
	protected function splitTime() {
		$explode = explode( ":", $this->date );
		
		$this->hour = (integer) $explode[0];
		$this->minute = (integer) $explode[1];
		$this->second = (integer) $explode[2];
	}
	
	/**
     * Metoda zwraca czas w postaci stringa gdy nastepuje pruba uzycia obiektu jako stringas
     *
     * @return string
	 * @access public
     */
	public function __toString() {
		return $this->date_string;
	}
	
    
}
?>