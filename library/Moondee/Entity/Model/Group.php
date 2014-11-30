<?php

/**
 * Model tablicy przechowywującej grupy użytkowników
 *
 * @package    Moondee_Entity
 */


class Moondee_Entity_Model_Group extends Zend_Db_Table_Abstract
{
	protected $_name = 'group';
	protected $_primary = 'id';
	
	protected $_dependentTables = array(
        'Moondee_Entity_Model_GroupObject'
    );

	
	/**
     * Metoda zwraca do jakich grup użytkownika $user1 należy użytkownik $user2
     *
	 * @param integer $user1
	 * @param integer $user2
     * @return Zend_Db_Table_Row[]
     */
	public function getGroupMembership( $user1, $user2 ){
		$select = $this->getAdapter()->select()
			->from( array( 'g' => 'group' ) )
			->join( array( 'go' => 'group-object' ), 'g.id = go.group_id', array() )
			->where( 'g.owner = ?', $user1 ) 
			->where( 'go.object_id = ?', $user2 )
			->columns( array( 
				'id' => 'g.id', 
				'name' => 'g.name', 
				'owner' => 'g.owner' 
			));
			
		return $this->getAdapter()->fetchAll( $select );
	}
	
	public function getGroupObjects( $group_id ){
		$select = $this->getAdapter()->select()->union( array(
			$this->getAdapter()->select()
				->from( array( 'u' => 'user' ), array( 'id', 'name', 'password' ) )
				->join( array( 'go' => 'group-object' ), 'go.object_id = u.id', array() )		
				->join( array( 'mo' => 'moondee_object' ), 'mo.id = u.id', array('class') )
				->where( 'go.group_id = ?', $group_id ),
			$this->getAdapter()->select()
				->from( array( 'p' => 'place' ), array( 'id', 'name', '("") AS password' ) )
				->join( array( 'go' => 'group-object' ), 'go.object_id = p.id', array() )			
				->join( array( 'mo' => 'moondee_object' ), 'mo.id = p.id', array('class') )
				->where( 'go.group_id = ?', $group_id )
		))				
		->order('name');
		
		return $this->getAdapter()->fetchAll( $select );
	}
	
	
	
	/**
     * Motoda zwraca grupy ( grupy użytkownika o id podanym w parametrze ) do jakich nalezy obiekt o id podanym w parametrze
     *
	 * @param integer $object_id
	 * @param integer $user_id
     * @return mixed
	 * @access public
     */ 
	public function getUserGroupsHavingObject( $object_id, $user_id ){
		$select = $this->getAdapter()->select()
				->from( array( 'go' => 'group-object' ), array() )
				->join( array( 'g' => 'group' ), 'go.group_id = g.id' )
				->where( 'go.object_id = ?', $object_id )
				->where( 'g.owner = ?', $user_id );
		
		return $this->getAdapter()->fetchAll( $select );
	}
}


?>