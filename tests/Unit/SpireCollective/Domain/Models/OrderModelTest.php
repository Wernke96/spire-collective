<?php


namespace Tests\Unit\SpireCollective\Domain\Models;


class OrderModelTest extends \Tests\Unit\TestCase
{
    public function testToArray(): void
    {
        $orderModel = $this->mockOrderModel([
            'id' => 10,
            'status' => 'Pending',
            'total' => 10,
            'state' => 'New York'
        ]);
        $this->assertSame([
            'id' => 10,
            'status' => 'Pending',
            'total' => 10,
        ], $orderModel->toArray());
    }

    public function testStateIsCA() :void
    {
        $orderModel = $this->mockOrderModel([
            'id' => 10,
            'status' => 'Pending',
            'total' => 10,
            'state' => 'California'
        ]);
        $this->assertEquals(20, $orderModel->getTotal());
    }
}
