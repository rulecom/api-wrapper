<?php namespace tests\Rule\ApiWrapper\Api\V2\Campaign;

use Rule\ApiWrapper\Api\V2\Campaign\Campaign;
use tests\Rule\ApiWrapper\Api\ApiTestCase;

class CampaignTest extends ApiTestCase
{
    private $exampleCampaign = '{
  "subject": "My subject",
  "from": {
    "email": "example@rule.se",
    "name": "Rule"
  },
  "message_type": "email",
  "language": "sv",
  "recipients": {
    "tags": [
      {
        "identifier": "tests"
      }
    ]
  },
  "content": {
    "plain": "UGFzc3dvcmQgcmVzZXQ=",
    "html": "PHA+UGFzc3dvcmQgcmVzZXQ8L3A+"
  }
}';

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

    public function testGetStatictics()
    {
        $response = $this->getApi()->statistics(1);

        $this->assertArrayHasKey('sent', $response);
    }

    public function testEmailCampaign()
    {

        //$response = $this->getApi()->send(json_decode($campaign, true));
    }

    public function testScheduleCampaign()
    {
        $campaign = json_decode($this->exampleCampaign, true);
        $campaign['send_at'] = date('Y-m-d', strtotime(date('Y-m-d H:i:s') . '+1 days'));

        $response = $this->getApi()->schedule($campaign);

        $this->assertEquals($response['success'], true);
    }
}