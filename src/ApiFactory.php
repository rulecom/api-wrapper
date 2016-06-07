<?php namespace Rule\ApiWrapper;

use Rule\ApiWrapper\Guzzle\Client;
use Rule\ApiWrapper\Api\Exception\InvalidResourceException;
use Rule\ApiWrapper\Api\V2\Subscriber\Subscriber;
use Rule\ApiWrapper\Api\V2\Campaign\Campaign;
use Rule\ApiWrapper\Api\V2\Customization\Customization;
use Rule\ApiWrapper\Api\V2\Suppression\Suppression;
use Rule\ApiWrapper\Api\V2\Tag\Tag;
use Rule\ApiWrapper\Api\V2\Template\Template;
use Rule\ApiWrapper\Api\V2\Transaction\Transaction;

class ApiFactory
{
    /**
     * Creates api resource
     *
     * @param string $key Rule api key
     * @param string $resource Resource name [subscriber, campaign, customization, suppression, tag, template, transaction]
     * @return Api
     */
    public static function make($key, $resource, $version = 'v2')
    {
        $client = new Client($key, $version);

        $namespace = 'Rule\\ApiWrapper\\Api\\' . strtoupper($version) . '\\' . ucfirst($resource) . '\\';
        $classname = $namespace . ucfirst($resource);

        if (!class_exists($classname)) {
            throw new InvalidResourceException("Invalid resource name providen or api version not supported");
        }

        return new $classname($client);
    }
}