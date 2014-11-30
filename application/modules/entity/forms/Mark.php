<?php
class Entity_Form_Mark extends Zend_Form
{
  public function init()
  {
    $mark = $this->createElement('text', 'mark');
    $mark->setLabel('Ocena')
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
        $mark,
		$object_id,
        array(
            'submit', 'submit', array(
                'label' => 'Ocen'
                )
            )
        ));
  }
}