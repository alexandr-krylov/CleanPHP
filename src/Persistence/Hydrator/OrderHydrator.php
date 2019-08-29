<?php
namespace CleanPhp\Invoicer\Persistence\Hydrator;

use CleanPhp\Invoicer\Domain\Repository\CustomerRepositoryInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderHydrator
 *
 * @author alexandr
 */
class OrderHydrator implements HydratorInterface
{
    protected $wrappedHydrator;
    protected $customerRepository;
    
    public function __construct(
            HydratorInterface $wrappedHydrator,
            CustomerRepositoryInterface $customerRepository
        )
    {
        $this->wrappedHydrator = $wrappedHydrator;
        $this->customerRepository = $customerRepository;
    }
    
    public function extract($object)
    {
        
    }
    
    public function hydrate(array $data, $order)
    {
        $this->wrappedHydrator->hydrate($data, $order);
        
        if (isset($data['customer_id'])) {
            $order->setCustomer(
                    $this->customerRepository->getById($data['customer_id'])
                    );
        }
        
        return $order;
    }
}