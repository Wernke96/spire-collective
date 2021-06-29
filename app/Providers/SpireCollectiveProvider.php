<?php

namespace App\Providers;

use App\SpireCollective\Domain\Repository\ErpSystem;
use App\SpireCollective\Domain\Repository\OrderRepository;
use App\SpireCollective\Domain\Services\OrderServices;
use App\SpireCollective\Infrastructure\BigCommerce\Models\BigCommerceModel;
use App\SpireCollective\Infrastructure\BigCommerce\Respository\BigCommerceOrderRepository;
use App\SpireCollective\Infrastructure\Odoo\Models\OdooModel;
use App\SpireCollective\Infrastructure\Odoo\Repository\OdooRepository;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class SpireCollectiveProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(BigCommerceModel::class, function (){
            $client = new Client(['base_uri' => env("BIGCOMMERCEURL")]);
            return new BigCommerceModel($client);
        });
        $this->app->singleton(OrderRepository::class, function () {
            return new BigCommerceOrderRepository(resolve(BigCommerceModel::class),resolve(LoggerInterface::class));
        });
        $this->app->singleton(OdooModel::class, function (){
            $client = new Client(['base_uri' => env("ODOOURL")]);
            return new OdooModel($client);
        });

        $this->app->singleton(ErpSystem::class, function () {
            return new OdooRepository(resolve(OdooModel::class),resolve(LoggerInterface::class));
        });

        $this->app->singleton(OrderServices::class, function () {
            return new OrderServices(resolve(ErpSystem::class),resolve(OrderRepository::class));
        });
    }
}
