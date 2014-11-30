<?php

/**
 * Klasa pomocnicza oceny
 *
 * @package    Moondee_Mark
 */

class Moondee_Mark_Helper
{
	

	/**
     * Metoda zwraca średnią ocene obiektu
     *
	 * @param integer $object_id Id obiektu ktorego ocena ma byc zwrócona
     * @return Moondee_Mark_Average | null
	 * @access public
     */ 
	static public function getObjectAverageMark( $object_id ) {
		$model = new Moondee_Mark_Model_MarkAverage();
		$data = $model->fetchRow( 'object = '.$object_id );
		
		if( $data ){
			//echo '<pre>'; print_r( $data ); echo '</pre>';
			return new Moondee_Mark_Average( $data );
		}else{
			return self::createEmptyAverageMark( $object_id );
		}
	}

	/**
     * Metoda tworzy w bazie danych nową średnia ocenie dla obiektu
     *
	 * @param integer $object_id Id obiektu ktorego ocena ma byc utworzona
     * @return Moondee_Mark_Average
	 * @access public
     */ 
	static private function createEmptyAverageMark( $object_id ) {
		$model = new Moondee_Mark_Model_MarkAverage();
		$model->insert( array( 'object' => $object_id, 'value' => 0, 'num' => 0  ) );
		
		$data = $model->fetchRow( 'object = '.$object_id );
		
		return new Moondee_Mark_Average( $data );
	}
	
	/**
     * Metoda dodaje ocene do obeitku
     *
	 * @param integer $object_id Id obiektu ocenianego
	 * @param integer $judge Id obiektu który ocenia
	 * @param integer $value Wysokość dodawanej oceny
     * @return boolean
	 * @access public
     */ 
	static public function addMarkToObject( $object_id, $judge, $value ) {
		if( !self::getMark( $object_id, $judge ) ){
			$mark = new Moondee_Mark();
			$mark->setObject( $object_id );
			$mark->setJudge( $judge );
			$mark->setValue( $value );
			$mark->save();

			$average_mark = self::getObjectAverageMark( $object_id );

			$average_mark->addMark( $value );
			$average_mark->save();
			
			return true;
		}else{
			return false;
		}
	}
	
	/**
     * Metoda zmienia ocene obiektu ktora zostala juz dodana przez uzytkownika
     *
	 * @param integer $object_id Id obiektu ocenianego
	 * @param integer $judge Id obiektu który ocenia
	 * @param integer $value Wysokość dodawanej oceny
     * @return boolean
	 * @access public
     */ 
	static public function changeMarkObject( $object_id, $judge, $value ) {
		self::deleteMarkFromObject( $object_id, $judge );
		return self::addMarkToObject( $object_id, $judge, $value );
	}
	
	/**
     * Metoda usuwa ocene obeitku
     *
	 * @param integer $object_id Id obiektu ocenianego
	 * @param integer $judge Id obiektu który ocenia
	 * @param integer $value Wysokość dodawanej oceny
     * @return void
	 * @access public
     */ 
	static public function deleteMarkFromObject( $object_id, $judge ) {
		$mark = self::getMark( $object_id, $judge );
		
		if( !$mark ){
			return;
		}
		
		$average_mark = self::getObjectAverageMark( $object_id );
		$average_mark->deleteMark( $mark->getValue() );
		$average_mark->save();
		
		$model = new Moondee_Mark_Model_Mark();
		$model->delete( 'id = '.$mark->id );
	}
	
	/**
     * Metoda zwraca ocene wydana przez obiekt na inny obiekt
     *
	 * @param integer $object_id Id obiektu ocenianego
	 * @param integer $judge Id obiektu który ocenia
     * @return Moondee_Mark | null
	 * @access public
     */ 
	static public function getMark( $object_id, $judge ) {
		$model = new Moondee_Mark_Model_Mark();
		
		$data = $model->fetchRow( 'object = '.$object_id.' AND judge = '.$judge );
		
		if( $data ){
			//echo '<pre>'; print_r( $data ); echo '</pre>';
			return new Moondee_Mark( $data );
		}else{
			return null;
		}
	}


	/**
     * Metoda sprawdza czy uzytkownik ocenil obiekt
     *
	 * @param integer $object_id obiekt ktory jest sprawdzany czy posiada ocene
	 * @param integer $user_id id uzytkownika
     * @return bool
	 * @access public
     */ 
	static public function isUserMark( $object_id, $user_id = null ) {
		if( self::getMark( $object_id, $user_id ) ){
			return true;
		}else{
			return false;
		}
	}

}
?>