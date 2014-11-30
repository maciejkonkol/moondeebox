<?php
class Entity_Form_DeleteMark extends Zend_Form
{
	public function init(){
		$object_id = $this->createElement('text', 'object_id');
		$object_id->setLabel('Id obiektu ocenianego')
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
			$object_id,
			array(
				'submit', 'submit', array(
					'label' => 'Ocen'
					)
				)
			));
	}
}