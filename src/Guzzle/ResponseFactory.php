<?php namespace Rule\ApiWrapper\Guzzle;

use Rule\ApiWrapper\Client\Response as RuleResponse;
use GuzzleHttp\Psr7\Response;

class ResponseFactory
{
    public static function make(Response $response)
    {

        $code = $response->getStatusCode();
        $body = json_decode((string) $response->getBody(), true);

        if ($response->getStatusCode() == 200) {
            if (!is_array($body) && is_string($body)) {
                $body = ['message' => $body];
            }
        } else {
            if (!isset($body['message'])) {
                $body = ['message' => $response->getReasonPhrase(), 'details' => $body];
            }
        }

        return new RuleResponse($code, $body);
    }
}
