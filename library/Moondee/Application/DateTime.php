<?php

/**
 * Klasa daty i czasu
 *
 * @package    Moondee_Application
 */

class Moondee_Application_DateTime
{
	/**
	 * Data i czas w postaci stringa
	 *
	 * @var string
	 * @access protected
	 */	
	protected $date_time_string;
	
	/**
	 * Obiekt daty
	 *
	 * @var Moondee_Application_Date
	 * @access protected
	 */	
	protected $date;
	
	/**
	 * Obiekt czasu
	 *
	 * @var Moondee_Application_Time
	 * @access protected
	 */	
	protected $time;
	
	
	
	/**
     * Konstruktor daty i czasu
     *
     * @param string $date_time
     * @return void
	 * @access public
     */
	public function __construct( $date_time ) {
		$this->date_time_string = $date_time;
	}
	
	/**
     * Metoda dzieli date i czas w postaci stringa na obiekty daty i czasu
     *
     * @return void
	 * @access protected
     */
	protected function splitDate() {
		$explode = explode( ":", $this->date_time_string );
		
		$this->date = new Moondee_Application_Date( $explode[0] );
		$this->time = new Moondee_Application_Time( $explode[1] );
	}
	
	
	/**
     * Metoda zwraca date i czas w postaci stringa gdy nastepuje pruba uzycia obiektu jako stringas
     *
     * @return string
	 * @access public
     */
	public function __toString() {
		return $this->date_time_string;
	}
	
    
}
?>