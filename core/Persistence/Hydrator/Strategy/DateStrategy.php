<?php

namespace CleanPhp\Invoicer\Persistence\Hydrator\Strategy;

use DateTime;
use Zend\Hydrator\Strategy\DefaultStrategy;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateStrategy
 *
 * @author alexandr
 */
class DateStrategy extends DefaultStrategy
{
    public function hydrate($value, ?array $data = NULL)
    {
        if (is_string($value)) {
            $value = new DateTime($value);
        }
        return $value;
    }
    
    public function extract($value, ?object $object = null)
    {
        if ($value instanceof DateTime) {
            $value = $value->format('Y-m-d');
        }
        return $value;
    }
}
