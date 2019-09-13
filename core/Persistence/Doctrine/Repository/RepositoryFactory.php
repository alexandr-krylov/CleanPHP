<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CleanPhp\Invoicer\Persistence\Doctrine\Repository;

use RuntimeException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of RepositoryFactory
 *
 * @author alexandr
 */
class RepositoryFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sl)
    {
        $class = func_get_arg(2);
        $class = 'CleanPhp\Invoicer\Persistence\Doctrine\Repository\\' . $class;
        if (class_exists($class, true)) {
            return new $class($sl->get('Doctrine\ORM\EntityManager'));
        }
        throw new RuntimeException('Unknown Repository requested: ' . $class);
    }
}
