<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use CleanPhp\Invoicer\Domain\Repository\InvoiceRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Description of InvoicesController
 *
 * @author alexandr
 */
class InvoicesController extends AbstractActionController
{
    protected $invoiceRepository;
    
    public function __construct(InvoiceRepositoryInterface $invoices)
    {
        $this->invoiceRepository = $invoices;
    }
    
    public function indexAction()
    {
        $invoices = $this->invoiceRepository->getAll();
        
        return [
            'invoices' => $invoices
        ];
    }
}
