<?php
class Entity_Form_AddPlace extends Zend_Form
{
  public function init()
  {
    $name = $this->createElement('text', 'name');
    $name->setLabel('Nazwa miejsca')
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
	
    $public = $this->createElement('checkbox', 'public');
	$public->setLabel('Miesce ma być do edycji publicznej');
    
    $this->addElements( array(
        $name,
		$public,
        array(
            'submit', 'submit', array(
                'label' => 'Dodaj'
                )
            )
        ));
  }
}