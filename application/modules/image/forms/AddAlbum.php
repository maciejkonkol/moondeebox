<?php
class Image_Form_AddAlbum extends Zend_Form
{
	public function init() {
		$album = $this->createElement('text', 'album');
		$album->setLabel('Nazwa albumu')
            ->setRequired(TRUE)
            ->setAttrib('size', 30)
            ->addFilters(array(
                new Zend_Filter_StringToLower(),
                new Zend_Filter_StringTrim(),
                new Zend_Filter_StripNewlines(),
                new Zend_Filter_StripTags()
            ))
            ->addValidators(array(
                new Zend_Validate_NotEmpty()
            ));

		$this->addElements( array(
			$album,
			array( 
				'submit', 
				'submit', 
				array( 'label' => 'Dodaj' ) 
			)
		));
	}
}