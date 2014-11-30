<?php

/**
 * Klasa odpowiedziala za dodawanie posrednika proxy do obiektów. Pośrednik słuzy do sprawdzania umprawnien do wywoływania metod
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Proxy
{
	/**
	 * Obiekt jakiemu posredniczy proxy
	 *
	 * @var object
	 * @access private
	 */	
	private $object;
	
	/**
	 * Obiekt Moondee_Acl
	 *
	 * @var object
	 * @access private
	 */	
	private $acl;
	
	/**
	 * Id użytkownika przez którego mają być wywoływane metody
	 *
	 * @var integer
	 * @access private
	 */	
	private $userId = null;
	
	
	/**
     * Konstruktor proxy
     *
     * @param mixed $object
     * @return void
     */
	public function __construct( $object ) {
		$this->object = $object;
	}
	
	/**
     * Meteoda wywolywana przy prubie wywolania metody obiektu docelowego
     *
     * @param string $method
     * @param mixed[] $arguments
     * @return void
     */
	public function __call( $method, $arguments ){
		$user = Zend_Auth::getInstance()->getIdentity();
		
		if( $user ){
			$identity = $user->getRealObject()->id;
		}else{
			$identity = 0;
		}
				
        if( $this->getAcl()->isAllowed( $this->object, $method, $identity ) ){
            return call_user_func_array( array( $this->object, $method ), $arguments );
        }else{
			return Moondee_Acl_Result::failed();
		}
		
		$this->userId = null;
    }
	
	
	/**
     * Meteoda ustawia obiekt acl
     *
     * @return void
     */
	public function setAcl(){
        $this->acl = Moondee_Acl::getInstance();
    }
	
	/**
     * Meteoda zwraca id obiektu docelowego
     *
     * @return void
     */
	public function getId(){
        return $this->object->id;
    }
	
	/**
     * Meteoda zwraca obiekt acl
     *
     * @return Moondee_Acl
     */
	public function getAcl(){
        if( !$this->acl ){
			$this->setAcl();
		}
		
		return $this->acl;
    }
	
	/**
     * Meteoda służy do wywoływania metody na obiekcie którego reprezentuje proxy przez innego użytkownika niż aktualnie zalogowany 
     *
	 * @param integer $user_id
     * @return Moondee_Application_Proxy
     */
	public function byUser( $user_id ){
		$this->userId = $user_id;
        return $this;
    }
	
	/**
     * Meteoda zwraca obiekt ktory reprezentuje proxy
     *
     * @return mixed
     */
	public function getRealObject(){
		return $this->object;
    }
	
	/**
     * Meteoda zwraca klase obiektu ktory reprezentuje proxy
     *
     * @return string
	 * @acces public
     */
	public function getObjectClass(){
		return get_class( $this->object );
    }
	
	/**
     * Meteoda sprawdza czy na uzytkownik ma uprawnienia do wykonania metody, o nazwie podanej w parametrze, na obiekt ktory reprezentuje proxy
     *
	 * @param string $method_name nazwa metody ktorej maja zostac sprawdzone uprawnienia
     * @return bool
	 * @acces public
     */
	public function isAllowed( $method_name, $user_id = null ){
		if( $user_id == null ){
			$user = Zend_Auth::getInstance()->getIdentity();
			
			if( $user ){
				$identity = $user->getRealObject()->id;
			}else{
				$identity = 0;
			}
		}else{
			$identity = $user_id;
		}
		
		if( $this->getAcl()->isAllowed( $this->object, $method_name, $identity ) ){
			return treu;
		}else{
			return false;
		}
    }
    
}
?>