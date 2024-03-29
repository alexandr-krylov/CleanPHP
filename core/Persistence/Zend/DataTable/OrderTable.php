<?php
namespace CleanPhp\Invoicer\Persistence\Zend\DataTable;

use CleanPhp\Invoicer\Domain\Repository\OrderRepositoryInterface;

class OrderTable extends AbstractDataTable
implements OrderRepositoryInterface
{
    public function getUninvoicedOrders()
    {
        return $this->gateway->select(
                'id NOT IN(SELECT order_id FROM invoices)'
                );
    }
}