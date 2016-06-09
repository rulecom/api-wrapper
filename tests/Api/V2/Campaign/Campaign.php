<?php namespace tests\Rule\ApiWrapper\Api\V2\Campaign;

use Rule\ApiWrapper\Api\V2\Campaign\Campaign;
use tests\Rule\ApiWrapper\Api\ApiTestCase;

class CampaignTest extends ApiTestCase
{

    protected function getApi()
    {
        $api = new Campaign($this->getClient());

        return $api;
    }

    public function testGetCampaigs()
    {
        $response = $this->getApi()->getList(5);

        $this->assertArrayHasKey('campaigns', $response);
    }

    public function testGetCampaign()
    {
        $response = $this->getApi()->get(1);

        $this->assertArrayHasKey('id', $response);
    }
}