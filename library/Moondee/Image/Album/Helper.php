<?php

/**
 * Klasa pomocnicza Albumu
 *
 * @package    Moondee_Image
 */

class Moondee_Image_Album_Helper
{
    
	/**
     * Metoda zwraca albumy obiektu
     *
	 * @param integer $object_id Id obiektu do ktorego naleza albumu
     * @return Moondee_Image_Album[]
	 * @access public
     */ 
	static public function getObjectAlbums( $object_id ) {
		$model = new Moondee_Image_Model_Album();
		
		$data = $model->fetchAll( 'owner = '.$object_id );
		
		$albums = array();
		
		if( $data ){
			foreach( $data as $row ){
				$albums[ $row['id'] ] = new Moondee_Application_Proxy( new Moondee_Image_Album( $row ) );
			}
		}
		
		return $albums;
	}
	
	/**
     * Metoda usuwa albumy z bazy danych
     *
	 * @param integer[] $albums_id tablica id albumow do usuniecia
     * @return void
	 * @access public
     */ 
	static public function deleteAlbums( $albums_id ){
		if( $albums_id ){
			$model = new Moondee_Image_Model_Album();
			$model->delete('id IN ('.implode( ', ', $albums_id ).') ');
			
			$model_moondee_object = new Moondee_Application_Model_Object();
			$model_moondee_object->delete('id IN ('.implode( ', ', $albums_id ).') ');
		}
	}
	
	/**
     * Metoda sprawdza czy obiekt o danym id posiada album o id lub nazwie podanej w parametrze. Jesli istnie zwraca ten album
     *
     * @param integer $entity_id Id sprawdzanego obiektu
     * @param integer | string $album Id lub nazwa albumu
     * @return Moondee_Image_Album
     * @access public
     */
	static public function albumExist( $entity_id, $album ){
		$model = new Moondee_Image_Model_Album();
		
		if( is_int( $album ) ){
			$row = $model->fetchRow( 'id = '.$album.' AND owner = '.$entity_id );
		}else{
			$row = $model->fetchRow( 'title = "'.$album.'" AND owner = '.$entity_id );
		}
		
		if( $row ){
			return new Moondee_Application_Proxy( new Moondee_Image_Album( $row ) );
		}else{
			return null;
		}
	}

}
?>