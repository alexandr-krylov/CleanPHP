<?php
namespace CleanPhp\Invoicer\Persistence\Hydrator;

use CleanPhp\Invoicer\Domain\Entity\Customer;
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
        $data = $this->wrappedHydrator->extract($object);
        
        if (array_key_exists('customer', $data) && !empty($data['customer'])) {
            $data['customer_id'] = $data['customer']->getId();
            unset($data['customer']);
        }
        return $data;
    }
    
    public function hydrate(array $data, $order)
    {
        $customer = null;
        
        if (isset($data['customer'])) {
            $customer = $this->wrappedHydrator->hydrate(
                    $data['customer'], new Customer()
                    );
                    unset($data['customer']);
        }
        
        if (isset($data['customer_id'])) {
            $customer = $this->customerRepository->getById(
                    $data['customer_id']
                    );
        }
        
        $this->wrappedHydrator->hydrate($data, $order);
        
        if ($customer) {
            $order->setCustomer($customer);
        }
        
        return $order;
    }
}
