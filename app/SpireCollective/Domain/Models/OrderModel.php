<?php


namespace App\SpireCollective\Domain\Models;


use App\SpireCollective\Domain\Utils\toArray;

class OrderModel implements toArray
{
//    {"id": 100, "status": "Pending", "total": 10, "state": "New York"}.
   private int $id;
   private string $status;
   private int $total;
   private string $state;

    /**
     * OrderModel constructor.
     * @param int $id
     * @param string $status
     * @param int $total
     * @param string $state
     */
    public function __construct(int $id, string $status, int $total, string $state)
    {
        $this->id = $id;
        $this->status = $status;
        $this->total = $total;
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        if ($this->getState() === "California"){
            return $this->total + 10;
        }
        return $this->total;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }


    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "status" => $this->getStatus(),
            "total" => $this->getTotal(),
        ];
    }
}
