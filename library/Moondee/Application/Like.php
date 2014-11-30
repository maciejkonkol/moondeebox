<?php

/**
 * Klasa Like'ów
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Like extends Moondee_Application_DatabaseObject
{
	/**
	 * Data polubienia
	 *
	 * @var string
	 * @access protected
	 */	
	protected $date;
	
	/**
	 * Id użytkownika do ktorego nalezy like
	 *
	 * @var integer
	 * @access protected
	 */	
	protected $user_id;
	
	/**
	 * Id obiektu ktory jest zlajkowany
	 *
	 * @var integer
	 * @access protected
	 */	
	protected $object_id;
		
	/**
	 * Id obiektu ktory jest zlajkowany
	 *
	 * @var integer
	 * @access protected
	 */	
	protected $date_object;






	/**
     * Meteoda wywolywana przy prubie wywolania metody obiektu docelowego
     *
     * @param string $method
     * @param mixed[] $arguments
     * @return void
     */
	public function setModel(){
		$this->model = new Moondee_Application_Model_Like();
    }
	
	/**
     * Meteoda ustawia date lajka
     *
     * @param string $date
     * @return string
     */
	public function setDate( $date = null ){
		if( !$date ){
			$date = date("Y-m-d H:i:s");
		}
		
		$this->date = $date;
    }
	
	/**
     * Meteoda zwraca date lajka
     *
     * @param bool $string
     * @return string
	 * @access public
     */
	public function getDate( $string = false ){
		if( !$this->date ){
			$this->setDate();
		}
		
		if( $string ){
			return $this->date;
		}
		
		$this->date = $date;
    }
	
	/**
     * Meteoda ustawia date lajka
     *
     * @param bool $string
     * @return string
	 * @access protected
     */
	protected function getDateObject(){
		if( !$this->date_object ){
			$this->setDateObject();
		}
		
    }
	
	/**
     * Meteoda ustawia id obiektu
     *
     * @param integer $object_id
     * @return void
	 * @access public
     */
	public function setObjectId( $object_id ){
		$this->object_id = $object_id;		
    }
	
	/**
     * Meteoda ustawia id użytkownika
     *
     * @param integer $user_id
     * @return void
	 * @access public
     */
	public function setUserId( $user_id ){
		$this->user_id = $user_id;		
    }
	
	
	
}
?>