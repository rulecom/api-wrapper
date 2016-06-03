<?php namespace Rule\ApiWrapper\Guzzle;

use Rule\ApiWrapper\Client\Request as RuleRequest;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class RequestFactory
{
    public static make(Client $client, RuleRequest $request)
    {
        return new Request($request->getMethod(), $request->getRelativeUrl());
    }
}