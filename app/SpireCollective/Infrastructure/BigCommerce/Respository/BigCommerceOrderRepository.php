<?php


namespace App\SpireCollective\Infrastructure\BigCommerce\Respository;


use App\SpireCollective\Domain\Models\OrderModel;
use App\SpireCollective\Domain\Repository\OrderRepository;
use App\SpireCollective\Exceptions\QueryException;
use App\SpireCollective\Infrastructure\BigCommerce\Models\BigCommerceModel;
use Psr\Log\LoggerInterface;

class BigCommerceOrderRepository implements OrderRepository
{
    private BigCommerceModel $bigCommerceModel;

    private LoggerInterface $logger;


    /**
     * BigCommerceOrderRepository constructor.
     * @param BigCommerceModel $bigCommerceModel
     * @param LoggerInterface $logger
     */
    public function __construct(BigCommerceModel $bigCommerceModel, \Psr\Log\LoggerInterface $logger)
    {
        $this->bigCommerceModel = $bigCommerceModel;
        $this->logger = $logger;
    }


    public function getOrder(int $id): OrderModel
    {
        try {
            $order = $this->bigCommerceModel->getOrder($id);
            return $this->constructOrderModel($order);
        } catch (\Exception $exception){
            $this->logger->error("error happened on BigCommerce", [
                "message" => $exception->getMessage(),
                "trace" => $exception->getTrace()
            ]);
            throw new QueryException("Api Failed To Query");
        }

    }

    private function constructOrderModel(array $order)
    {
        return new OrderModel(
            $order["id"],
            $order["status"],
            $order["total"],
            $order["state"]
        );
    }
}
