<?php
namespace CleanPhp\Invoicer\Domain\Repository;
interface OrderRepositoryInterface extends RepositoryInterface
{
    /**
     * Get all orders without any invoices.
     * 
     * @return array
     */
    public function getUninvoicedOrders() : array;
}