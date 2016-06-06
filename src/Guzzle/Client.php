<?php namespace Rule\ApiWrapper\Guzzle;

use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;
use Rule\ApiWrapper\Client\Client as AbstractClient;

use GuzzleHttp\Client as GuzzleClient;
// transformers for rule wrapper req/res
use Rule\ApiWrapper\Guzzle\ResponseFactory;
use Rule\ApiWrapper\Guzzle\RequestFactory;

class Client extends AbstractClient
{
    /**
     * @var GuzzleClient
     * guzzlehttp client
     */
    private $guzzleClient;

    /**
     * Creates new Guzzle client instance
     *
     * Client constructor.
     * @param string $apiKey
     * @param string $version
     * @param string $baseUrl
     */
    public function __construct(
        string $apiKey,
        string $version = 'v2',
        string $baseUrl = "http://rule.io/api/")
    {
        parent::construct($apiKey, $version, $baseUrl);

        $this->guzzleClient = new GuzzleClient([
            'base_uri' => $this->getBaseUrl() . $this->getVersion(),
            'query' => ['apikey' => $this->getApiKey()]
        ]);
    }

    /**
     * Makes get request
     * @param Request $request
     * @return Response
     */
    public function get(Request $request)
    {
        return $this->sendRequest('GET', $request);
    }

    /**
     * Makes post request
     *
     * @param Request $request
     * @return Response
     */
    public function post(Request $request)
    {
        return $this->sendRequest('POST', $request);
    }

    /**
     * Makes put request
     *
     * @param Request $request
     * @return Response
     */
    public function put(Request $request)
    {
        return $this->sendRequest('PUT', $request);
    }

    /**
     * Makes delete request
     *
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
        return $this->sendRequest('DELETE', $request);
    }

    /**
     * Sends request
     *
     * @param $method
     * @param Request $request
     * @return Response
     */
    private function sendRequest($method, Request $request)
    {
        $request->setMethod($method);
        $response = $this->guzzleClient()->send(
            RequestFactory::make($request),
            $this->getRequestOptions($request)
        );

        return ResponseFactory::make($response);
    }

    /**
     * Returns request options
     * 
     * @param Request $request
     * @return array
     */
    private function getRequestOptions(Request $request)
    {
        $options = [];

        if ($request->getQuery())
            $options['query'] = $request->getQuery();

        if ($request->getParams())
            $options['json'] = $request->getParams();

        return $options;
    }
}