<?php
namespace Rule\APIWrapper\Logger;

use Rule\ApiWrapper\Client\Client as AbstractClient;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

class Client extends AbstractClient
{
    protected $logger;

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function get(Request $request)
    {
        return $this->logRequest('GET', $request);
    }

    public function post(Request $request)
    {
        return $this->logRequest('POST', $request);
    }

    public function put(Request $request)
    {
        return $this->logRequest('PUT', $request);
    }

    public function delete(Request $request)
    {
        return $this->logRequest('DELETE', $request);
    }

    protected function logRequest($method, Request $request)
    {
        $logData = $this->makeLogData($request);
        $logData['method'] = $method;

        $this->logger->info(json_encode($logData));

        return new Response(200, ['success' => true]);
    }

    protected function makeLogData(Request $request)
    {
        return [
            'relative_url' => $request->getRelativeUrl(),
            'query' => $request->getQuery(),
            'body' => $request->getParams(),
        ];
    }

}
