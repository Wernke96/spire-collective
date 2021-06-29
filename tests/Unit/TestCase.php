<?php


namespace Tests\Unit;


use Faker\Factory;

class TestCase extends \PHPUnit\Framework\TestCase
{
    Use MockModels;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }
}
