<?php


namespace App\SpireCollective\Domain\Repository;


use App\SpireCollective\Domain\Models\OrderModel;

interface ErpSystem
{
    public function sendOrder(OrderModel $orderModel) :void;
}
