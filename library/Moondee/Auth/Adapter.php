<?php

/**
 * Klasa adaptera autoryzacji
 *
 * @package    Moondee_Auth
 */

class Moondee_Auth_Adapter implements Zend_Auth_Adapter_Interface
{
	/**
     * identyfikator użytkownika
     * 
     * @var string
     */
	protected $identity;
	
	/**
     * hasło użytkownika
     * 
     * @var string
     */
	protected $password;
	
	/**
     * Konstruktor
     *
     * @return void
     */ 
	public function __construct( $identity, $password ) {
        $this->identity = $identity;
		$this->password = md5( $password );
    }
	
	/**
     * Metoda loguje użytkownika
     *
     * @return Zend_Auth_Result
     */ 
	public function authenticate() {
		$user = Moondee_Entity_Email_Helper::getEmailOwner( $this->identity );
		//echo '<pre>'; print_r( $user ); echo '</pre>';
		if( $user ){
			if ( $this->password == $user->getRealObject()->getPassword() ) {
				//echo '<pre>'; print_r( $user ); echo '</pre>';
				return new Zend_Auth_Result( Zend_Auth_Result::SUCCESS, $user );
			}else{
				return new Zend_Auth_Result( Zend_Auth_Result::FAILURE, null );
			}
		}
        
        return new Zend_Auth_Result( Zend_Auth_Result::FAILURE, null );
    }

	

}
?>