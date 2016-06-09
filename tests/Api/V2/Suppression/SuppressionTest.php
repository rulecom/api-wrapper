<?php namespace tests\Rule\ApiWrapper\Api\V2\Suppression;

use Rule\ApiWrapper\Api\V2\Suppression\Suppression;
use tests\Rule\ApiWrapper\Api\ApiTestCase;

class SuppressionTest extends ApiTestCase
{

    protected function getApi()
    {
        $api = new Suppression($this->getClient());

        return $api;
    }

    public function testGetSuppressions()
    {
        $response = $this->getApi()->getList(5);

        $this->assertArrayHasKey('suppressions', $response);
    }

    public function testCreateSuppression()
    {
        $response = $this->getApi()->create([
            ['phone_number' => '+4612345678', 'suppress_on' => ["transaction" => ['email']]]
        ]);

        $this->assertEquals($response['message'], 'Success');
    }
}