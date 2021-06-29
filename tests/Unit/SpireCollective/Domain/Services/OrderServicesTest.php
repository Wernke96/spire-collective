<?php


namespace Tests\Unit\SpireCollective\Domain\Services;


use App\SpireCollective\Domain\Repository\ErpSystem;
use App\SpireCollective\Domain\Repository\OrderRepository;
use App\SpireCollective\Domain\Services\OrderServices;

class OrderServicesTest extends \Tests\Unit\TestCase
{
    private $orderRepository;
    private $erpSystem;
    private $orderServices;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderRepository = $this->createMock(OrderRepository::class);
        $this->erpSystem = $this->createMock(ErpSystem::class);
        $this->orderServices = new OrderServices(
            $this->erpSystem,
            $this->orderRepository
        );
    }

    public function testSendOrder() :void
    {
        $orderModel = $this->mockOrderModel([
            'id' => 10,
            'status' => 'Pending',
            'total' => 10,
            'state' => 'New York'
        ]);
        $this->orderRepository
            ->expects($this->once())
            ->method("getOrder")
            ->with(10)
            ->willReturn($orderModel);

        $this->erpSystem
            ->expects($this->once())
            ->method("sendOrder")
            ->with($orderModel);

        $this->orderServices->sendOrder(10);

    }

}
