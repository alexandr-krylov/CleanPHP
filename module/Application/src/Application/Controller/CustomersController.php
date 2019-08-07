<?php
namespace Application\Controller;

use CleanPhp\Invoicer\Domain\Repository\CustomerRepositoryInterface;
use CleanPhp\Invoicer\Domain\Entity\Customer;
use CleanPhp\Invoicer\Service\InputFilter\CustomerInputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\HydratorInterface;

class CustomersController extends AbstractActionController
{
    protected $customerRepository;
    protected $inputFilter;
    protected $hydrator;

    public function __construct(
            CustomerRepositoryInterface $customers,
            CustomerInputFilter $inputFilter,
            HydratorInterface $hydrator
        )
    {
        $this->customerRepository = $customers;
        $this->inputFilter = $inputFilter;
        $this->hydrator = $hydrator;
    }

    public function indexAction()
    {
        return [
            'customers' => $this->customerRepository->getAll()
        ];
    }

    public function newAction()
    {
        if ($this->getRequest()->isPost()) {
            $this->inputFilter->setData($this->params()->fromPost());
            if ($this->inputFilter->isValid()) {
                $customer = $this->hydrator->hydrate(
                        $this->inputFilter->getValues(), new Customer()
                        );
                $this->customerRepository->begin()->persist($customer)->commit();
            } else {
                
            }
        }
    }
}