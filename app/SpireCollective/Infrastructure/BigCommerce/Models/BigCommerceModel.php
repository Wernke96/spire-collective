<?php


namespace App\SpireCollective\Infrastructure\BigCommerce\Models;
use GuzzleHttp\Client;

class BigCommerceModel
{
    private Client $client;

    /**
     * BigCommerceModel constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getOrder(int $id)
    {
        $response = $this->client->get( "orders/{$id}");
        return json_decode($response->getBody(),true);
    }


}
