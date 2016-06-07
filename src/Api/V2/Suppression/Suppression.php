<?php namespace Rule\ApiWrapper\Api\V2\Suppression;

use Rule\ApiWrapper\Client\Client;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Suppression
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Suppression constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Returns suppression list
     *
     * @link https://rule.se/apidoc/#suppressions-get-suppressions-get
     *
     * @param int $limit
     * @return array
     * @throws \Exception
     */
    public function get($limit = 100)
    {
        $this->assertValidLimit($limit);

        $request = new Request('suppressions');
        $request->setQuery(['limit' => $limit]);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Creates new Suppression
     *
     * @link https://rule.se/apidoc/#suppressions-suppressions-post
     *
     * @param array $suppression
     * @return array
     * @throws \Exception
     */
    public function create(array $suppression)
    {
        $this->assertValidSuppression($suppression);

        $request = new Request('suppressions');
        $request->setParams($suppression);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Check if Suppression data is valid
     * 
     * @param array $suppression
     */
    private function assertValidSuppression(array $suppression)
    {
        if (!isset($suppression['subscribers'])) {
            throw new InvalidArgumentException("Subscribers can't be empty");
        }

        if (isset($suppression['suppress_on'])) {
            $this->assertValidCampaign($suppression['suppress_on']['campaign']);
            $this->assertValidTransaction($suppression['suppress_on']['transaction']);
        }
    }

    /**
     * Check if campaign is not empty
     * 
     * @param $campaign
     */
    private function assertValidCampaign($campaign)
    {
        if (!isset($campaign)) {
            throw new InvalidArgumentException('Campaign should be provided');
        }
    }

    /**
     * Check is transaction is not empty
     * 
     * @param $transaction
     */
    private function assertValidTransaction($transaction)
    {
        if(!isset($transaction)) {
            throw new InvalidArgumentException('Transaction should be provided');
        }
    }

    /**
     * Check if limit is valid
     * 
     * @param $limit
     */
    private function assertValidLimit($limit)
    {
        if(!is_int($limit)){
            throw new InvalidArgumentException('Limit is invalid');
        }
    }

    private function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getData()['message']);
        }
    }
}