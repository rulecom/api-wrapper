<?php namespace Rule\ApiWrapper\Guzzle;

use Rule\ApiWrapper\Client\Request as RuleRequest;
use GuzzleHttp\Psr7\Request;

class RequestFactory
{
    public static function make(RuleRequest $request, $baseUrl = "")
    {
        return new Request($request->getMethod(), $baseUrl . $request->getRelativeUrl());
    }
}