<?php

namespace Rule\ApiWrapper;

use Illuminate\Support\ServiceProvider;
use Rule\ApiWrapper\Client\Client as AbstractClient;
use Rule\ApiWrapper\Guzzle\Client as DefaultClient;

use Rule\ApiWrapper\Api\V2\Subscriber\Subscriber;
use Rule\ApiWrapper\Api\V2\Campaign\Campaign;
use Rule\ApiWrapper\Api\V2\Transaction\Transaction;
use Rule\ApiWrapper\Api\V2\Tag\Tag;
use Rule\ApiWrapper\Api\V2\Suppression\Suppression;
use Rule\ApiWrapper\Api\V2\Template\Template;
use Rule\ApiWrapper\Api\V2\Customization\Customization;

class LaravelServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->configure('rule-api');
        $url = substr(config('rule-api.base_url'), -1) == '/'
            ? config('rule-api.base_url')
            : config('rule-api.base_url') . '/';
        $clientImplementation = config('rule-api.api_client', DefaultClient::class);

        $this->app->bind(AbstractClient::class, function ($app) use ($clientImplementation, $url) {
            return new $clientImplementation(
                config('rule-api.api_key'),
                config('rule-api.api_version', 'v2'),
                $url);
        });

        $this->app->bind(Subscriber::class, function ($app) {
            return new Subscriber($this->app->make(AbstractClient::class));
        });

        $this->app->bind(Campaign::class, function ($app) {
            return new Campaign($this->app->make(AbstractClient::class));
        });

        $this->app->bind(Transaction::class, function ($app) {
            return new Transaction($this->app->make(AbstractClient::class));
        });

        $this->app->bind(Tag::class, function ($app) {
            return new Tag($this->app->make(AbstractClient::class));
        });

        $this->app->bind(Suppression::class, function ($app) {
            return new Suppression($this->app->make(AbstractClient::class));
        });

        $this->app->bind(Template::class, function ($app) {
            return new Template($this->app->make(AbstractClient::class));
        });

        $this->app->bind(Customization::class, function ($app) {
            return new Customization($this->app->make(AbstractClient::class));
        });
    }

}
