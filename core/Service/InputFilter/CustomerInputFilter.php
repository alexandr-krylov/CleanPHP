<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerInputFilter
 *
 * @author alexandr
 */

namespace CleanPhp\Invoicer\Service\InputFilter;

use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;

class CustomerInputFilter extends InputFilter
{
    public function __construct()
    {
        $name = (new Input('name'))->setRequired(true);
        $email = (new Input('email'))->setRequired(true);
        $email->getValidatorChain()->attach(new EmailAddress());
        $this->add($name);
        $this->add($email);
    }
}
