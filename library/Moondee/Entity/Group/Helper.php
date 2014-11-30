<?php

/**
 * Klasa pomocnicza użytkowników
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Group_Helper
{
	
	
	/**
     * Metoda zwraca do jakich grup użytkownika $user1 należy użytkownik $user2
     *
	 * @param integer $user1
	 * @param integer $user2
     * @return Moondee_Entity_User
     */ 
	static public function getGroupMembershipId( $user1, $user2 ){
		$model = new Moondee_Entity_Model_Group();
		$data = $model->getGroupMembership( $user1, $user2 );
		
		$id = array();
		
		foreach( $data as $row ){
			$id[ $row['id'] ] = $row['id'];
		}
		
		return $id;
	}
	
	/**
     * Metoda zwraca do grupy użytkownika
     *
	 * @param integer $user_id
     * @return Moondee_Entity_Group
     */ 
	static public function getUserGroups( $user_id ){
		$model = new Moondee_Entity_Model_Group();
		$data = $model->fetchAll( 'owner = '.(string)$user_id );
		
		$groups = array();
		
		if( $data ){
			foreach( $data as $row ){
				$groups[ $row['id'] ] = new Moondee_Entity_Group( $row );
			}
		}
		
		return $groups;
	}
	
	/**
     * Metoda zwraca do grupy nazlezace do obiektu (uzytkownik i atrakcje)
     *
	 * @param integer $user_id
     * @return Moondee_Entity_Group
     */ 
	static public function getObjectGroups( $object_id ){
		$model = new Moondee_Entity_Model_Group();
		$data = $model->fetchAll( 'owner = '.(string)$object_id );
		
		$groups = array();
		
		if( $data ){
			foreach( $data as $row ){
				$groups[ $row['id'] ] = new Moondee_Entity_Group( $row );
			}
		}
		
		return $groups;
	}
	
	/**
     * Metoda usuwa grupy
     *
	 * @param integer[] $id
     * @return void
     */ 
	static public function deleteGroups( $id ){
		$model = new Moondee_Entity_Model_Group();
		
		$model->delete('id IN ('.implode( ', ', $id ).') ');
	}
	
	/**
     * Metoda zwraca tablice domyślnych grup dla użytkownika
     *
	 * @param integer $owner
     * @return Moondee_Entity_Group[]
     */ 
	static public function getUserDefaultGroups( $owner = null ){
		$group1 = new Moondee_Entity_Group();
		$group1->setName('Znajomi');
		$group2 = new Moondee_Entity_Group();
		$group2->setName('Rodzina');
		$group3 = new Moondee_Entity_Group();
		$group3->setName('Dalsi znajomi');
		
		$groups =  array(
			$group1,
			$group2,
			$group3
		);
		//echo '<pre>'; print_r( $groups ); echo '</pre>';
		if( $owner ){
			foreach( $groups as $group ){
				$group->setOwner( $owner );
			}
		}
		
		return $groups;
	}
	
	/**
     * Metoda zwraca tablice domyślnych grup dla miejsca
     *
	 * @param integer $owner
     * @return Moondee_Entity_Group[]
     */ 
	static public function getPlaceDefaultGroups( $owner = null ){
		$group1 = new Moondee_Entity_Group();
		$group1->setName('Administratorzy');
		
		$groups =  array(
			$group1
		);
		
		if( $owner ){
			foreach( $groups as $group ){
				$group->setOwner( $owner );
			}
		}
		
		return $groups;
	}


	/**
     * Motoda zwraca grupy ( grupy użytkownika o id podanym w parametrze ) do jakich nalezy obiekt o id podanym w parametrze
     *
	 * @param integer $object_id
	 * @param integer $user_id
     * @return Moondee_Entity_Group[]
	 * @access public
     */ 
	static public function getUserGroupsHavingObject( $object_id, $user_id ) {
		$model = new Moondee_Entity_Model_Group();
		$data = $model->getUserGroupsHavingObject( $object_id, $user_id );
		
		$groups = array();
		
		if( $data ){
			foreach( $data as $row ){
				$groups[ $row['id'] ] = new Moondee_Entity_Group( $row );
			}
		}
		
		return $groups;
	}
	

}
?>