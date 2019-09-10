<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use CleanPhp\Invoicer\Domain\Repository\InvoiceRepositoryInterface;
use CleanPhp\Invoicer\Domain\Repository\OrderRepositoryInterface;
use CleanPhp\Invoicer\Domain\Service\InvoicingService;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Description of InvoicesController
 *
 * @author alexandr
 */
class InvoicesController extends AbstractActionController
{
    protected $invoiceRepository;
    protected $orderRepository;
    protected $invoicing;

    public function __construct(
            InvoiceRepositoryInterface $invoices,
            OrderRepositoryInterface $orders,
            InvoicingService $invoicing
            )
    {
        $this->invoiceRepository = $invoices;
        $this->orderRepository = $orders;
        $this->invoicing = $invoicing;
    }
    
    public function indexAction()
    {
        $invoices = $this->invoiceRepository->getAll();
        
        return [
            'invoices' => $invoices
        ];
    }
    
    public function generateAction()
    {
        return ['orders' => $this->orderRepository->getUninvoicedOrders()];
    }
    
    public function generateProcessAction()
    {
        $invoices = $this->invoicing->generateInvoices();
        $this->invoiceRepository->begin();
        foreach ($invoices as $invoice) {
            $this->invoiceRepository->persist($invoice);
        }
        $this->invoiceRepository->commit();
        return ['invoices' => $invoices];
    }
    
    public function viewAction()
    {
        $id = $this->params()->fromRoute('id');
        $invoice = $this->invoiceRepository->getById($id);
        if (!$invoice) {
            $this->getResponse()->setStatusCode(404);
            return null;
        }
        
        return ['invoice' => $invoice, 'order' => $invoice->getOrder()];
    }
}
