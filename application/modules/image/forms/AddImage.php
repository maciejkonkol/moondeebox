<?php
class Image_Form_AddImage extends Zend_Form
{
	public function init() {
		$this->setAttrib( 'enctype', 'multipart/form-data' );

		$file = $this->createElement('file', 'file');
		$file->setLabel('Upload an image:');

		$this->addElements( array(
			$file,
			array( 
				'submit', 
				'submit', 
				array( 'label' => 'Dodaj' ) 
			)
		));
	}
}