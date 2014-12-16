<?php

/**
 * Klasa pomocnicza zasobów uprawnień
 *
 * @package    Moondee_Acl
 */

class Moondee_Acl_Helper
{

	
    /**
     * Tablica modeli uprawnien o indeksach ktore sa nazwami klas ktorym przypisane sa modele
     * 
     * @var string[]
	 * @access private
     */
	static private $permission_models = array(
		'Moondee_Image' => 'Moondee_Acl_Model_Image'
	);
	
	
	
	/**
     * Metoda zwraca model uprawnien odpowiadającej mu klasie
     *
	 * @param string $class Nazwa klasy ktorej model uprawnien ma zostac zwrocony
	 * @return mixed
	 * @access private
     */ 
	static private function getPremissionModel( $class ){
		$model_class = self::$permission_models[ $class ];
		
		return new $model_class();
	}
	
	/**
     * Metoda torzy prawa dostepu do obrazka
     *
	 * @param mixed $entity Obiekt którego prawa maja zostac utworzone
	 * @param integer[] $groups Tablica id grup którym maja zostac udostepnione prawa
	 * @return void
	 * @access public
     */ 
	static public function createEntityPrivilages( $entity, $groups ){
		$entity_id = $entity->getId();
		$class = get_class( $entity );
		$class_helper = $class.'_Helper';
		 
		$methods = $class_helper::getPrivilegesMethodsNames();		
		$model = self::getPremissionModel( $class );
		
		foreach( $groups as $group ){
			foreach( $methods as $method ){			
				$model->insert(	array(
					'object_id' => $entity_id,
					'group_id' => $group,
					'method' => $method
				) );
			}
		}
				
		//return $images;
	}
}
?>