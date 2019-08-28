<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValedationErrors
 *
 * @author alexandr
 */
class ValidationErrors extends AbstractHelper
{
    public function __invoke($element)
    {
        if ($errors = $this->getErrors($element)) {
            return '<div class="alert alert-danger">' .
            implode('. ', $errors) .
            '</div>';
        }
        return '';
    }
    
    protected function getErrors($element)
    {
        if (!isset($this->getView()->errors)) {
            return false;
        }
        
        $errors = $this->getView()->errors;
        
        if (isset($errors[$element])) {
            return $errors[element];
        }
        
        return false;
    }
}
