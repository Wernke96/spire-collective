<?php


namespace App\SpireCollective\Domain\Services;


use App\SpireCollective\Domain\Repository\ErpSystem;
use App\SpireCollective\Domain\Repository\OrderRepository;

class OrderServices
{
    private ErpSystem $erpSystem;

    private OrderRepository $orderRepository;

    /**
     * OrderServices constructor.
     * @param ErpSystem $erpSystem
     * @param OrderRepository $orderRepository
     */
    public function __construct(ErpSystem $erpSystem, OrderRepository $orderRepository)
    {
        $this->erpSystem = $erpSystem;
        $this->orderRepository = $orderRepository;
    }

    public function sendOrder(int $id) :void
    {
        $order = $this->orderRepository->getOrder($id);
        $this->erpSystem->sendOrder($order);
    }

}
