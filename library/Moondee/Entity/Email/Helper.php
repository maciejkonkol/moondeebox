<?php

/**
 * Klasa zpomocniczymi metodami dla numerow telefonow obiektów
 *
 * @package    Moondee_Entity
 */

class Moondee_Entity_Email_Helper{

    /**
     * Zwraca właściciela maila
     * 
	 * @param string $email;
     * @return Moondee_Entity_User
     */ 
	static public function getEmailOwner( $email ){
		
		$model = new Moondee_Entity_Model_Email();
		$email_data = $model->fetchRow( 'email = "'.(string)$email.'"' );
		if( $email_data ){
			$user_data = $email_data->findDependentRowset( 'Moondee_Entity_Model_User' )->current();
		}else{
			return null;
		}
		//echo '<pre>'; print_r( $this->identity ); echo '</pre>';
		if( $user_data ){
			return new Moondee_Application_Proxy( new Moondee_Entity_User( $user_data ) );
		//echo '<pre>'; print_r( new Moondee_Application_Proxy( new Moondee_Entity_User( $user_data ) ) ); echo '</pre>';
		}else{
			return null;
		}
	}

    /**
     * Zwraca emaile obiektu
     * 
	 * @param integer $email;
     * @return string[]
     */ 
	static public function getEntityEmails( $entity_id ){		
		$model = new Moondee_Entity_Model_Email();
		$email_data = $model->fetchAll( 'object_id = '.$entity_id );
		$emails = array();
		
		foreach( $email_data as $email ){
			$emails[] = $email['email'];
		}
		
		return $emails;
	}

   
}

?>
