<?php

/**
 * Klasa
 *
 * @package    Moondee_Application
 */

class Moondee_Application_Factory
{
	/**
     * Metoda zwraca obiekt z zewnetrznym id podanym w parametrze 
     *
	 * @param integer $id
     * @return mixed
     */ 
    static public function getMoondeeObject( $id ){
        $object_model = new Moondee_Application_Model_Object();
        
        $row = $object_model->find( $id )->current();
        
        if( $row ){
			$class_name = $row->class;
			$object = new $class_name( (int) $row->id );
			return self::getProxyAcl( $object );
		}else{
			return null;
		}
    }
	
	/**
     * Metoda zwraca proxyAcl obiektu podanego w parametrze
     *
	 * @param integer $id
     * @return mixed
     */ 
    static protected function getProxyAcl( $object ){
        return new Moondee_Application_Proxy( $object );
    }
	
	
    
}
?>