<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CleanPhp\Invoicer\Persistence\Doctrine\Repository;

use CleanPhp\Invoicer\Domain\Repository\CustomerRepositoryInterface;
/**
 * Description of CustomerRepository
 *
 * @author alexandr
 */
class CustomerRepository extends AbstractDoctrineRepository 
implements CustomerRepositoryInterface
{
    protected $entityClass = 'CleanPhp\Invoicer\Domain\Entity\Customer';
}
