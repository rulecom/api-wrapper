<?php namespace Rule\ApiWrapper\Guzzle;

use Rule\ApiWrapper\Client\Response as RuleResponse;
use GuzzleHttp\Psr7\Response;

class ResponseFactory
{
    public static function make(Response $response)
    {

        $code = $response->getStatusCode();
        $body = [];

        if ($response->getStatusCode() == 200) {
            $body = json_decode($response->getBody(), true);

            if (!is_array($body) && is_string($body)) {
                $body = ['message' => $body];
            }
        } else {
            $body = ['message' => $response->getReasonPhrase()];
        }

        return new RuleResponse($code, $body);
    }
}