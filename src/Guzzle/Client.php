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

    public function get($request)
    {
        $request->setMethod('GET');
        $response = $this->guzzleClient()->send(
            RequestFactory::make($request),
            ['query' => $request->getQuery()]
        );

        return ResponseFactory::make($response);
    }

    private function getRequestOptions(Request $request)
    {
        return [
                'query' => $request->getQuery(),
                'json' => $request->getParams()
        ];
    }
}