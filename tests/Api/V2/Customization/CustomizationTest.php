<?php namespace tests\Rule\ApiWrapper\Api\V2\Customization;

use Rule\ApiWrapper\Api\V2\Customization\Customization;
use tests\Rule\ApiWrapper\Api\ApiTestCase;

class CustomizationTest extends ApiTestCase
{

    protected function getApi()
    {
        $api = new Customization($this->getClient());

        return $api;
    }

    public function testGetList()
    {
        $response = $this->getApi()->getList(5);

        $this->assertLessThanOrEqual(5, count($response['groups']));
    }

    public function testGetGroup()
    {
        $response = $this->getApi()->get(1);

        $this->assertArrayHasKey("id", $response);
    }

    public function testCreateGroup()
    {
        $response = $this->getApi()->create([[
                 'key' => "Test.Field",
                 'type' => "text"
                 ],
                 [
                  'key' => "Test.Multi",
                  'type' => 'multiple'
                 ]
        ]);

        $this->assertEquals($response['message'], 'success');
    }
}