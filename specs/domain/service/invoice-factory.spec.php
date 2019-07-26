<?php
use CleanPhp\Invoicer\Domain\Entity\Invoice;
use CleanPhp\Invoicer\Domain\Entity\Order;
use CleanPhp\Invoicer\Domain\Factory\InvoiceFactory;

describe('InvoiceFactory', function () {
    describe('->createFromOrder()', function () {
        it('should return an order object', function () {
            $order = new Order();
            $factory = new InvoiceFactory();
            $invoice = $factory->createFromOrder($order);
            expect($invoice)->to->be->instanceof(
                'CleanPhp\Invoicer\Domain\Entity\Invoice'
            );
        });

        it('should set the total of the invoice', function () {
            $order = new Order();
            $order->setTotal(500);

            $factory = new InvoiceFactory();
            $invoice = $factory->createFromOrder($order);

            expect($invoice->getTotal())->to->equal(500);
        });

        it('should associate the Order to the Invoice', function () {
            $order = new Order();

            $factory = new InvoiceFactory();
            $invoice = $factory->createFromOrder($order);

            expect($invoice->getOrder())->to->equal($order);
        });

        it('should set the date of the Invoice', function () {
            $order = new Order();

            $factory = new InvoiceFactory();
            $invoice = $factory->createFromOrder($order);

            expect(($invoice->getInvoiceDate())->format(\DateTime::ATOM))
                ->to->loosely->equal((new \DateTime())->format(\DateTime::ATOM));
        });
    });
});

$repo = 'CleanPhp\Invoicer\Domain\Repository\OrderRepositoryInterface';

describe('InvoicingService', function () {
    describe('->generateInvoices()', function () {
        beforeEach(function () {
            $this->repository = $this->getProphet()->prophesize($repo);
        });
        it('should query the repository for uninvoiced Orders', function(){
            $this->repository->getUninvoicedOrders()->shouldBeCalled();
            $service = new InvoicingService($this->repository->reveal());
            $service->generateInvoices();
        });
        it('should return an Invoice for each uninvoiced Order');
    });
});