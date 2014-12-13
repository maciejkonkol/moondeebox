<?php

/**
 * Klasa zasobów uprawniń
 *
 * @package    Moondee_Acl
 */

class Moondee_Acl_Resource
{
	
	
	/**
	 * Tablica przynależności użytkowników do grup, ubiegających się o dostęp do metody
	 *
	 * @var String[]
	 * @access private
	 */
	private $group_membership = array();
	
	/**
	 * Id obiektu ktorego reprezentuje dany zasób
	 *
	 * @var integer
	 * @access private
	 */
	private $object_id;
	
	/**
	 * Nazwa klasy obiektu ktorego reprezentuje dany zasób
	 *
	 * @var String
	 * @access private
	 */
	private $object_class;
	
	/**
	 * Uprawnienia danego bieżacego zasobu
	 *
	 * @var bool[]
	 * @access private
	 */
	private $permissions;
	
	/**
	 * Model uprawnien
	 *
	 * @var mixed
	 * @access private
	 */
	private $permissionModel;
			
			
			
	/**
     * Konstruktor zasobu
     *
	 * @param mixed $object
     * @return bool
     */
    public function __construct( $object ) {
		$this->object_id = (int) $object->id;
		$this->object_class = get_class( $object );
    }
	
	/**
     * Metoda zwraca uprawnienia do metod dla grup użytkowników
     *
	 * @param integer $group_id
     * @return bool
     */
    private function getPermissions( $group_id ) {
		$not_set_permissions = array();
		
		//Sprawdzenie którym grupom użytkowników zostały już ustawione uprawnienia
		foreach( $group_id as $id ){
			if( !isset( $this->permissions[$id] ) ){
				$not_set_permissions[] = $id;
			}
		}
		
		if( $not_set_permissions ){
			$this->setPermissions( $not_set_permissions );
		}
		
		$permissions = array();
		
		foreach( $group_id as $id ){
			if( $this->permissions[ $id ] ){
				foreach( $this->permissions[ $id ] as $key => $value ){
					$permissions[ $key ] = $value;
				}
			}
		}
		
		return $permissions;
    }
	
	/**
     * Metoda ustawia uprawnienia do metod dla grup użytkowników
     *
	 * @param integer $group_id
     * @return void
     */
    private function setPermissions( $group_id ) {
		$model = $this->getPermissionModel();
		$data = $model->fetchAll( $model->select()->where( 'object_id = '.$this->object_id.' AND group_id IN (?)', $group_id ) );
		
		//$this->permissions[$group_id] = array();
		
		foreach( $data as $row ){
			$this->permissions[$row->group_id][$row->method] = true;
		}
    }
	
	/**
     * Metoda sprawdza czy użytkownik ma dostępn do metody obiektu bierzącego zasobu
     *
	 * @param String $method
	 * @param integer $group_id
     * @return bool
     */
    public function isAllowed( $method, $group_id ) {
		if( isset( $this->getPermissions( $group_id )[$method] ) ){
			return true;
		}else{
			false;
		}
    }
	
	/**
     * Metoda zwraca model uprawnien
     *
     * @return mixed
     */
    public function getPermissionModel() {
		if( !$this->permissionModel ){
			$this->setPermissionModel();
		}
		
		return $this->permissionModel;
    }
	
	/**
     * Metoda ustawia model uprawnien
     *
     * @return void
     */
    public function setPermissionModel() {
		$model_class_name = 'Moondee_Acl_Model_'.substr( $this->object_class, strRpos( $this->object_class, '_' ) + 1 );
		
		$this->permissionModel = new $model_class_name();
    }
	
}
?>