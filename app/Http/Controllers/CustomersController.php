<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use CleanPhp\Invoicer\Domain\Repository\CustomerRepositoryInterface;
use CleanPhp\Invoicer\Service\InputFilter\CustomerInputFilter;
//use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Hydrator\HydratorInterface;
use CleanPhp\Invoicer\Domain\Entity\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Description of CustomerController
 *
 * @author alexandr
 */
class CustomersController extends Controller
{
    protected $customerRepository;
    protected $inputFilter;
    protected $hydrator;

    public function __construct(
            CustomerRepositoryInterface $customerRepository,
            CustomerInputFilter $inputFilter,
            HydratorInterface $hydrator
            )
    {
        $this->customerRepository = $customerRepository;
        $this->inputFilter = $inputFilter;
        $this->hydrator = $hydrator;
    }
    
    public function indexAction()
    {
        $customers = $this->customerRepository->getAll();
        return view('customers/index', ['customers' => $customers]);
    }
    
    public function newOrEditAction(Request $request, $id = '')
    {
        $viewModel = [];
        $customer = $id ? $this->customerRepository->getById($id) :
            new Customer();
        if ($request->getMethod() == 'POST') {
            $this->inputFilter->setData($request->request->all());
            if ($this->inputFilter->isValid()) {
                $this->hydrator->hydrate(
                        $this->inputFilter->getValues(),
                        $customer
                        );
                $this->customerRepository
                        ->begin()
                        ->persist($customer)
                        ->commit();
                Session::flash('success', 'Customer Saved');
                return new RedirectResponse(
                        '/customers/edit/' . $customer->getId()
                        );
            } else {
                $this->hydrator->hydrate($request->request->all(), $customer);
                $viewModel['error'] = $this->inputFilter->getMessages();
            }
        }
        $viewModel['customer'] = $customer;
        return view('customers/new-or-edit', $viewModel);
    }
}
