<?php namespace tests\Rule\ApiWrapper\Api\V2\Template;

use Rule\ApiWrapper\Api\V2\Template\Template;
use tests\Rule\ApiWrapper\Api\ApiTestCase;

class TemplateTest extends ApiTestCase
{

    protected function getApi()
    {
        $api = new Template($this->getClient());

        return $api;
    }

    public function testGetTemplates()
    {
        $response = $this->getApi()->getList();

        $this->assertArrayHasKey('templates', $response);
    }

    public function testGetTemplate()
    {
        $response = $this->getApi()->get(1);

        $this->assertArrayHasKey("id", $response);
        $this->assertArrayHasKey("name", $response);
    }
}