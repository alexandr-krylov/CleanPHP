<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use CleanPhp\Invoicer\Domain\Repository\InvoiceRepositoryInterface;
use CleanPhp\Invoicer\Domain\Repository\OrderRepositoryInterface;
use CleanPhp\Invoicer\Domain\Service\InvoicingService;
use Illuminate\Http\Response;

/**
 * Description of InvoicesController
 *
 * @author alexandr
 */
class InvoicesController extends Controller
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
        return view('invoices/index', ['invoices' => $invoices]);
    }
    
    public function newAction()
    {
        return view(
                'invoices/new',
                ['orders' => $this->orderRepository->getUninvoicedOrders()]
                );
    }
    
    public function generateAction()
    {
        $invoices = $this->invoicing->generateInvoices();
        $this->invoiceRepository->begin();
        foreach ($invoices as $invoice) {
            $this->invoiceRepository->persist($invoice);
        }
        $this->invoiceRepository->commit();
        return view('invoices/generate', ['invoices' => $invoices]);
    }
    
    public function viewAction($id)
    {
        $invoice = $this->invoiceRepository->getById($id);
        if (!$invoice) {
            return new Response('', 404);
        }
        return view(
                'invoices/view',
                ['invoice' => $invoice, 'order' => $invoice->getOrder()]
                );
    }
}
