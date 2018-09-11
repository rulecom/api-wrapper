<?php namespace tests\Rule\ApiWrapper\Api;

use PHPUnit\Framework\TestCase;
use Rule\ApiWrapper\Guzzle\Client;

class ApiTestCase extends TestCase
{
    protected function getClient()
    {
        $client = new Client('f7057418-36ebbc3-e5f984a-75db148-5181d4ea294', 'v2', 'http://rule-dev/api/');

        return $client;
    }
}