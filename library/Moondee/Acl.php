<?php

/**
 * Klasa odpowiedziala za sprawdzanie uprawnien do wykonywania metod na obiektach
 *
 * @package    Moondee_Acl
 */

class Moondee_Acl
{
    /**
    * Obiekt instancji
    *
    * @var Moondee_Acl
    * @access private
    * @static
    */	
    static private $_instance;

    /**
    * Tablica zasobów
    *
    * @var Moondee_Acl_Resource[]
    * @access private
    */
    private $resources = array();

    /**
    * Tablica przynależności użytkowników do grup, ubiegających się o dostęp do metody
    *
    * @var String[]
    * @access private
    */
    private $group_membership = array();
	
	
	
    /**
    * Metoda zwraca instance obiektu
    *
    * @static
    * @return Moondee_Acl
    */
    static public function getInstance() {
        if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
    /**
    * Metoda dodaje zasoby
    *
    * @param mixed $object
    * @return Moondee_Acl
    */
    private function addResource( $object ) {
        $this->resources[ $object->id ] = new Moondee_Acl_Resource( $object );
        return $this->resources[ $object->id ];
    }
	
    /**
    * Metoda zwraca sasób obiektu
    *
    * @param mixed $object
    * @return Moondee_Acl_Resource
    */
    private function getResource( $object ) {
        if( !isset( $this->resources[ $object->id ] ) ){
            return $this->addResource( $object );
        }

        return $this->resources[ $object->id ];
    }
	
    /**
    * Sprawdza prawo użytkownika do metody obiektu
    *
    * @param mixed $object
    * @param String $method
    * @param integer $user_id
    * @return bool
    */
    public function isAllowed( $object, $method, $user_id ) {
        if( !$object->getOwner() ){
            return true;
        }
        
        if( $object->getOwner() == $user_id ){
            return true;
        }
        
        $group_id = $this->getGroupMembership( $object, $user_id );
        $group_id[0] = 0;

        return $this->getResource( $object )->isAllowed( $method, $group_id );
    }
	
    /**
    * Metoda ustawia grupy (do których należy użytkownik ubiegający się od dostęp do metody) użytkowników właściciela obiektu 
    *
    * @param mixed $object
    * @param integer $user_id
    * @return void
    */
    private function setGroupMembership( $object, $user_id ) {
        $this->group_membership[ $object->getOwner() ][ $user_id ] = Moondee_Entity_Group_Helper::getGroupMembershipId( $object->getOwner(), $user_id );
    }
	
    /**
    * Metoda pobiera grupy (do których należy użytkownik ubiegający się od dostęp do metody) użytkowników właściciela obiektu 
    *
    * @param mixed $object
    * @param integer $user_id
    * @return integer[]
    */
    private function getGroupMembership( $object, $user_id ) {
        if( !isset( $this->group_membership[ $object->getOwner() ][ $user_id ] ) ){
            $this->setGroupMembership( $object, $user_id );
        }

        return $this->group_membership[ $object->getOwner() ][ $user_id ];
    }
    
}
?>