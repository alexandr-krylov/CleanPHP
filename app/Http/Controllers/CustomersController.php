<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use CleanPhp\Invoicer\Domain\Repository\CustomerRepositoryInterface;

/**
 * Description of CustomerController
 *
 * @author alexandr
 */
class CustomersController extends Controller
{
    private $customerRepository;
    
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    
    public function indexAction()
    {
        $customers = $this->customerRepository->getAll();
        return view('customers/index', ['customers' => $customers]);
    }
}
