<?php namespace tests\Rule\ApiWrapper\Api\V2\Tag;

use Rule\ApiWrapper\Api\V2\Tag\Tag;
use tests\Rule\ApiWrapper\Api\ApiTestCase;

class TagTest extends ApiTestCase
{

    protected function getApi()
    {
        $api = new Tag($this->getClient());

        return $api;
    }

    public function testGetTagsList()
    {
        $response = $this->getApi()->getList(5);

        $this->assertLessThanOrEqual(5, count($response['tags']));
    }

    public function testClearTag()
    {
        $response = $this->getApi()->clear('tests');

        $this->assertEquals($response['message'], 'Success');
    }

    public function testDeleteTag()
    {
        $response = $this->getApi()->delete('tests');

        $this->assertEquals($response['message'], 'Success');
    }
}