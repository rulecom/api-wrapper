<?php namespace Rule\ApiWrapper\Guzzle;

use Rule\ApiWrapper\Client\Response as RuleResponse;
use GuzzleHttp\Psr7\Response;

class ResponseFactory
{
    public static function make(Response $response)
    {
        return new RuleResponse($response->getStatusCode(), json_decode($response->getBody()));
    }
}