<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CleanPhp\Invoicer\Persistence\Doctrine\Repository;

use CleanPhp\Invoicer\Domain\Repository\InvoiceRepositoryInterface;

/**
 * Description of InvoiceRepository
 *
 * @author alexandr
 */
class InvoiceRepository extends AbstractDoctrineRepository
implements InvoiceRepositoryInterface
{
    protected $entityClass = 'CleanPhp\Invoicer\Domain\Entity\Invoice';
}
