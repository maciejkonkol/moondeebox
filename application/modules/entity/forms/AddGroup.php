<?php
class Entity_Form_AddGroup extends Zend_Form
{
  public function init()
  {
    $name = $this->createElement('text', 'name');
    $name->setLabel('Nazwa grupy')
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
        $name,
        array(
            'submit', 'submit', array(
                'label' => 'Dodaj'
                )
            )
        ));
  }
}