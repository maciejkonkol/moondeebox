<?php

/**
 * Abstrakcyjna klasa dla wszystkich obiektów które mają odpowiedniki w bazie danych z zewnętrznym ID
 *
 * @package    Moondee_Application
 */

abstract class Moondee_Application_MoondeeDatabaseObject extends Moondee_Application_DatabaseObject
{
	/**
     * Metoda tworzy nowe zewnętrzne id i je zwraca  
     *
     * @return integer
     */ 
    protected function getNewId(){
        $object_model = new Moondee_Application_Model_Object();
        
        $object_model->insert( array( 'class' => get_class( $this ) ) );
        
        return (int) $object_model->getAdapter()->lastInsertId();
    }
    
    /**
     * Zapisuje obiekt do bazy danych
     *
     * @return integer
     */ 
    public function save(){
        $object_row = $this->getDatabaseObjectRow(); 
        
        if( !$this->id ){
            $this->id = $this->getNewId();
        }
         
        $object_data = $this->getObjectData( $object_row );
        
        $object_row->setFromArray( $object_data );        
        $object_row->save();
		
		return (int) $object_row->id;
    }
	
	/**
     * Metoda zwraca id właściciela bierzącego obiektu
     *
     * @return integer
     */ 
	abstract public function getOwner();
}
?>