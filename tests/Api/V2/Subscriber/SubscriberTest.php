<?php namespace tests\Rule\ApiWrapper\Api\V2\Subscriber;

use Rule\ApiWrapper\Api\V2\Subscriber\Subscriber;
use tests\Rule\ApiWrapper\Api\ApiTestCase;

class SubscriberTest extends ApiTestCase
{

    protected function getApi()
    {
        $api = new Subscriber($this->getClient());

        return $api;
    }

    public function testCreateSubscriber()
    {
        $api = $this->getApi();

        $response = $api->create(['email' => 'testerson@email.com', 'tags' => ['tests'],
            'fields' => [['key' => 'Test.Field', 'value' => "Some test value"]]
        ]);

        $this->assertEquals($response['message'], 'Success');
    }

    public function testCreateMultipleSubscribers()
    {
        $api = $this->getApi();

        $response = $api->createMultiple([
            'subscribers' => [
                ['email' => 'testerson1@email.com'],
                ['phone_number' => '1234567890'],
                ['phone_number' => '0123456789']
            ],
            'tags' => ['tests']
        ]);

        $this->assertTrue($response['success']);
    }

    public function testGetListOfSubsribers()
    {
        $api = $this->getApi();

        $response = $api->getList(5);

        $this->assertEquals(count($response['subscribers']), 5);
    }

    public function testGetSubscriber()
    {
        $api = $this->getApi();
        $email = 'testerson@email.com';
        $response = $api->get($email, 'email');

        $this->assertEquals($response['subscriber']['email'], $email);
    }

    public function testGetSubscriberFields()
    {
        $api = $this->getApi();
        $response = $api->getFields('testerson@email.com', 'email');

        $this->assertArrayHasKey('groups', $response);
    }

    //public function testUpdateSubscriber()

    public function testAddSubscriberTags()
    {
        $api = $this->getApi();
        $response = $api->addTags('testerson@email.com', ['test new']);

        $this->assertEquals($response['message'], 'Success');
    }

    public function testGetTags()
    {
        $api = $this->getApi();
        $response = $api->getTags('testerson@email.com');

        $this->assertArrayHasKey('tags', $response);
    }

    public function testDeleteTags()
    {
        $api = $this->getApi();
        $response = $api->deleteTag('testerson@email.com', 'test new');

        $this->assertEquals($response['message'], 'Success');
    }
}