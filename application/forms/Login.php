<?php
class Form_Login extends Zend_Form
{
  public function init()
  {
    $email = $this->createElement('text', 'email');
    $email->setLabel('E-mail:')
            ->setRequired(TRUE)
            ->setAttrib('size', 30)
            ->addFilters(array(
                new Zend_Filter_StringToLower(),
                new Zend_Filter_StringTrim(),
                new Zend_Filter_StripNewlines(),
                new Zend_Filter_StripTags()
            ))
            ->addValidators(array(
                new Zend_Validate_EmailAddress(),
                new Zend_Validate_NotEmpty()
            ));
    $password = $this->createElement('password', 'password');
    $password ->setLabel('Hasło:')
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
    $this->addElements(array(
        $email,
        $password ,
        array(
            'submit', 'submit', array(
                'label' => 'zaloguj'
                )
            )
        ));
  }
}