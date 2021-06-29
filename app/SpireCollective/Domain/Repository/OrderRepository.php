<?php


namespace App\SpireCollective\Domain\Repository;


use App\SpireCollective\Domain\Models\OrderModel;

interface OrderRepository
{
    public function getOrder(int $id) :OrderModel;

}
