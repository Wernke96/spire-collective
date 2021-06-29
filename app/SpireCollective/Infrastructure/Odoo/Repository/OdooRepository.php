<?php


namespace App\SpireCollective\Infrastructure\Odoo\Repository;


use App\SpireCollective\Domain\Models\OrderModel;
use App\SpireCollective\Exceptions\QueryException;
use App\SpireCollective\Infrastructure\Odoo\Models\OdooModel;
use Psr\Log\LoggerInterface;

class OdooRepository implements \App\SpireCollective\Domain\Repository\ErpSystem
{
    private OdooModel $odooModels;
    private LoggerInterface $logger;


    /**
     * OdooRepository constructor.
     * @param OdooModel $odooModels
     * @param LoggerInterface $logger
     */
    public function __construct(OdooModel $odooModels, \Psr\Log\LoggerInterface $logger)
    {
        $this->odooModels = $odooModels;

        $this->logger = $logger;
    }


    public function sendOrder(OrderModel $orderModel): void
    {
        try {
            $this->odooModels->sendOrder($orderModel->toArray());
        } catch (\Exception $exception){
            $this->logger->error("error happened on Odoo", [
                "message" => $exception->getMessage(),
                "trace" => $exception->getTrace()
            ]);
            throw new QueryException("Odoo Failed to Send");
        }
    }
}
