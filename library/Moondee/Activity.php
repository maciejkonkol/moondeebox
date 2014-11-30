<?php

/**
 * Klasa aktywności
 *
 * @package    Moondee_Image
 */

class Moondee_Activity extends Moondee_Application_DatabaseObject
{
    /**
     * Nazwa aktywności
     * 
     * @var string
	 * @access protected
     */
    protected $name;
    
   
	

	/**
     * Metoda ustawia model
     *
     * @return void
	 * @access protected
     */ 
	protected function setModel() {
		$this->model = new Moondee_Activity_Model_Activity();
	}


}
?>