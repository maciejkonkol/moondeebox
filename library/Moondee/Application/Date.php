<?php

/**
 * Klasa daty
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Date
{
	/**
	 * Data w postaci stringa
	 *
	 * @var string
	 * @access protected
	 */	
	protected $date_string;
	
	/**
	 * Rok
	 *
	 * @var integer
	 * @access protected
	 */	
	protected $year;
	
	/**
	 * Miesiac
	 *
	 * @var integer
	 * @access protected
	 */	
	protected $month;
	
	/**
	 * Dzień
	 *
	 * @var integer
	 * @access protected
	 */	
	protected $day;
	
	
	/**
     * Konstruktor daty
     *
     * @param string $date
     * @return void
	 * @access public
     */
	public function __construct( $date ) {
		$this->date_string = $date;
	}
	
	/**
     * Metoda dzieli date w postaci stringa na czesci
     *
     * @return void
	 * @access protected
     */
	protected function splitDate() {
		$explode = explode( "-", $this->date );
		
		$this->year = (integer) $explode[0];
		$this->month = (integer) $explode[1];
		$this->day = (integer) $explode[2];
	}
	
	/**
     * Metoda zwraca date w postaci stringa gdy nastepuje pruba uzycia obiektu jako stringas
     *
     * @return string
	 * @access public
     */
	public function __toString() {
		return $this->date_string;
	}
	
    
}
?>