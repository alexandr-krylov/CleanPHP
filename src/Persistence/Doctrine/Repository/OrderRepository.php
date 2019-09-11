<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CleanPhp\Invoicer\Persistence\Doctrine\Repository;

use CleanPhp\Invoicer\Domain\Repository\OrderRepositoryInterface;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Description of OrderRepository
 *
 * @author alexandr
 */
class OrderRepository extends AbstractDoctrineRepository
implements OrderRepositoryInterface
{
    protected $entityClass = 'CleanPhp\Invoicer\Domain\Entity\Order';
    
    public function getUninvoicedOrders()
    {
        $builder = $this->entityManager->createQueryBuilder()
                ->select('o')
                ->from($this->entityClass, 'o')
                ->leftJoin(
                        'CleanPhp\Invoicer\Domain\Entity\Invoice',
                        'i',
                        Join::WITH,
                        'i.order = o'
                        )
                ->where('i.id IS NULL');
        return $builder->getQuery()->getResult();
    }
}
