<?php


namespace Tests\Unit;



use App\SpireCollective\Domain\Models\OrderModel;
use Faker\Generator;

trait MockModels
{
    /**
     * @var Generator
     */
    private $faker;

    public function mockOrderModel(array $data = []) :OrderModel
    {
        return new OrderModel(
            $this->getValue($data,'id',$this->faker->randomNumber()),
            $this->getValue($data, 'status',"New"),
            $this->getValue($data, 'total', (int)$this->faker->randomNumber()),
            $this->getValue($data, 'state', "Indiana")
        );
    }
    private function getValue(array $data, string $key, $default)
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return $default;
    }
}
