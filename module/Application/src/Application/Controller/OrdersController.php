<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

/**
 * Description of OrderController
 *
 * @author alexandr
 */

use CleanPhp\Invoicer\Domain\Repository\OrderRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;

class OrdersController extends AbstractActionController
{
    protected $orderRepository;
    
    public function __construct(OrderRepositoryInterface $orders)
    {
        $this->orderRepository = $orders;
    }
    
    public function indexAction()
    {
        return [
            'orders' => $this->orderRepository->getAll()
        ];
    }
    
    public function viewAction()
    {
        $id = $this->params()->fromRoute('id');
        $order = $this->orderRepository->getById($id);
        if (!$order) {
            $this->getResponse()->setStatusCode(404);
            return null;
        }
        
        return ['order' => $order];
    }
}
