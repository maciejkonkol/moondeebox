<?php
class Entity_Form_Description extends Zend_Form
{
  public function init()
  {
    $text = $this->createElement('textarea', 'text');
    $text->setLabel('Wpisz treść opisu');
	
    
    $this->addElements( array(
        $text,
        array(
            'submit', 'submit', array(
                'label' => 'Dodaj opis'
                )
            )
        ));
  }
}