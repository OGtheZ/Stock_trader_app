<?php

namespace App\Providers;

use App\Repositories\Stock\APIStocksRepository;
use App\Repositories\Stock\StocksRepository;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StocksRepository::class, function () {
            $config = Configuration::getDefaultConfiguration()->setApiKey('token', env('FINNHUB_API_KEY'));
            $client = new DefaultApi(
                new Client(),
                $config
            );
            return new APIStocksRepository($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
