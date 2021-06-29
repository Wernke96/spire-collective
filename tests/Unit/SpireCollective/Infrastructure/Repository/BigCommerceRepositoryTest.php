<?php


namespace Tests\Unit\SpireCollective\Infrastructure\Repository;


use App\SpireCollective\Exceptions\QueryException;
use App\SpireCollective\Infrastructure\BigCommerce\Models\BigCommerceModel;
use App\SpireCollective\Infrastructure\BigCommerce\Respository\BigCommerceOrderRepository;
use Psr\Log\LoggerInterface;
use Tests\Unit\TestCase;

class BigCommerceRepositoryTest extends TestCase
{
    private $bigCommerceModel;

    private $logger;

    private $bigCommerceRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->bigCommerceModel = $this->createMock(BigCommerceModel::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->bigCommerceRepository = new BigCommerceOrderRepository(
            $this->bigCommerceModel,
            $this->logger
        );
    }
    public function testGetOrder() :void
    {
        $this->bigCommerceModel
            ->expects($this->once())
            ->method("getOrder")
            ->with($this->equalTo(10))
            ->willReturn([
                'id' => 10,
                'status' => 'Pending',
                'total' => 10,
                'state' => 'New York'
                ]);
        $orderModel = $this->mockOrderModel([
            'id' => 10,
            'status' => 'Pending',
            'total' => 10,
            'state' => 'New York'
        ]);
        $this->assertSame(
            $orderModel->toArray(),
            $this->bigCommerceRepository->getOrder(10)->toArray()
        );
    }

    public function testGetOrderException() :void
    {
        $this->bigCommerceModel
            ->expects($this->once())
            ->method("getOrder")
            ->with($this->equalTo(10))
            ->willThrowException(new \Exception());
        $this->expectException(QueryException::class);
        $this->bigCommerceRepository->getOrder(10);

    }
}
