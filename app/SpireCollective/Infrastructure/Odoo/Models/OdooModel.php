<?php


namespace App\SpireCollective\Infrastructure\Odoo\Models;


use GuzzleHttp\Client;

class OdooModel
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendOrder(array $order)
    {
        $response = $this->client->post("orders", [
            "json" => $order
        ]);
        return json_decode($response->getBody(),true);
    }
}
