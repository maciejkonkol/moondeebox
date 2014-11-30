<?php

/**
 * Klasa pomocnicza Image
 *
 * @package    Moondee_Image
 */

class Moondee_Image_Helper
{
    
	/**
     * Metoda zwraca obrazki albumu jezeli zostal podany parametr owner przypisywany jest kazdemu obrakowi wlasciciel
     *
	 * @param integer $album_id Id albumu jakiego maja byc zwrocone obrazki
	 * @param integer $owner Id wlasciciela albumu czili rowniez obrazka
     * @return Moondee_Image[]
	 * @access public
     */ 
	static public function getAlbumImages( $album_id, $owner = null ) {
		$model = new Moondee_Image_Model_Image();
		
		$data = $model->fetchAll( 'album = '.$album_id );
		
		$images = array();
		
		if( $data ){
			foreach( $data as $row ){
				$image = new Moondee_Application_Proxy( new Moondee_Image( $row ) );
				
				if( $owner ){
					$image->setOwner( $owner );
				}
				
				$images[ $row['id'] ] = new Moondee_Application_Proxy( $image );
			}
		}
		
		return $images;
	}
	
	/**
     * Metoda usuwa obrazki z bazy danych i z serwera
     *
	 * @param Moondee_Image[] $images tablica obrazków do usuniecia
     * @return void
	 * @access public
     */ 
	static public function deleteImages( $images ){
		$images_path = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('moondee')['image']['path'].'/';
		$images_id = array();
		
		if( $images ){
			foreach( $images as $image ){
				$images_id[] = $image->id;
				unlink( $images_path.$image->getPath().'/'.$image->getFile().'.'.$image->getExtension() );
			}
			
			$model = new Moondee_Image_Model_Image();
			$model->delete('id IN ('.implode( ', ', $images_id ).') ');
			
			$model_moondee_object = new Moondee_Application_Model_Object();
			$model_moondee_object->delete('id IN ('.implode( ', ', $images_id ).') ');
		}
	}

}
?>