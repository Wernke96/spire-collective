<?php


namespace Tests\Unit\SpireCollective\Infrastructure\Repository;


use App\SpireCollective\Exceptions\QueryException;
use App\SpireCollective\Infrastructure\BigCommerce\Models\BigCommerceModel;
use App\SpireCollective\Infrastructure\BigCommerce\Respository\BigCommerceOrderRepository;
use App\SpireCollective\Infrastructure\Odoo\Models\OdooModel;
use App\SpireCollective\Infrastructure\Odoo\Repository\OdooRepository;
use Psr\Log\LoggerInterface;
use Tests\Unit\TestCase;

class OdooRepositoryTest extends TestCase
{
    private $odooModel;

    private $logger;

    private $odooRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->odooModel = $this->createMock(OdooModel::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->odooRepository = new OdooRepository(
            $this->odooModel,
            $this->logger
        );
    }

    public function testSendOrder()
    {
        $orderModel = $this->mockOrderModel([
            'id' => 10,
            'status' => 'Pending',
            'total' => 10,
            'state' => 'New York'
        ]);
        $this->odooModel
            ->expects($this->once())
            ->method("sendOrder")
            ->with($orderModel->toArray());
        $this->odooRepository->sendOrder($orderModel);

        $this->assertTrue(true);
    }
    public function testSendOrderException() :void
    {
        $orderModel = $this->mockOrderModel([
            'id' => 10,
            'status' => 'Pending',
            'total' => 10,
            'state' => 'New York'
        ]);
        $this->odooModel
            ->expects($this->once())
            ->method("sendOrder")
            ->with($orderModel->toArray())
            ->willThrowException(new \Exception());
        $this->expectException(QueryException::class);
        $this->odooRepository->sendOrder($orderModel);
    }
}
