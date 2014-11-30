<?php

/**
 * Klasa zpomocniczymi metodami dla numerow telefonow obiektów
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Phone_Helper{

    /**
     * Zwraca model telefonów
     *
     * @return Moondee_Entity_Model_Phone
     */ 
	static public function getModel(){
		return new Moondee_Entity_Model_Phone();
	}

    /**
     * Zapis numerów telefonów obiektu do bazy danych
	 * 
	 * Metoda usuwa poprzednie numery telefonów i nadpisuje je nowymi podanymi w parametrze
     *
	 * @param String[] $phones
	 * @param integer $object_id
     * @return void
     */ 
	static public function setObjectPhones( $phones, $object_id ){
		$model = self::getModel();
		
		$model->delete( 'object_id = '.$object_id );
		
		foreach( $phones as $phone ){
			$model->insert( array( 'phone' => $phone, 'object_id' => $object_id ) );
		}
	}

    /**
     * Pobranie numerów telefonów obiektu z bazy danych
     *
	 * @param integer $object_id
     * @return String[]
     */ 
	static public function getObjectPhones( $object_id ){
		$data = self::getModel()->fetchAll( 'object_id = '.$object_id );
		
		$phones = array();
		
		foreach( $data as $row ){
			$phones[] = $row->phone;
		}
		
		return $phones;
	}
}

?>
