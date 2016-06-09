<?php namespace Rule\ApiWrapper\Api\V2\Suppression;

use Rule\ApiWrapper\Api\Api;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Suppression extends Api
{
    /**
     * Returns suppression list
     *
     * @link https://rule.se/apidoc/#suppressions-get-suppressions-get
     *
     * @param int $limit
     * @return array
     * @throws \Exception
     */
    public function getList($limit = 100)
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
    public function create(array $suppressions)
    {
        foreach ($suppressions as $suppression) {
            $this->assertValidSuppression($suppression);
        }

        $request = new Request('suppressions');
        $request->setParams(['subscribers' => $suppressions]);

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
        if (isset($suppression['suppress_on'])) {
            if(isset($suppression['suppress_on']['campaign']))
                $this->assertValidCampaign($suppression['suppress_on']['campaign']);
            if(isset($suppression['suppress_on']['transaction']))
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
        if (!is_array($campaign)) {
            throw new InvalidArgumentException('Campaign suppression should be an array');
        }
    }

    /**
     * Check is transaction is not empty
     * 
     * @param $transaction
     */
    private function assertValidTransaction($transaction)
    {
        if(!is_array($transaction)) {
            throw new InvalidArgumentException('Transaction suppression should be an array');
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
}