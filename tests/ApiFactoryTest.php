<?php namespace tests\Rule\ApiWrapper;

use phpunit\framework\TestCase;
use Rule\ApiWrapper\ApiFactory;

use Rule\ApiWrapper\Api\Api;
use Rule\ApiWrapper\Api\Exception\InvalidResourceException;

class ApiFactoryTest extends TestCase
{
    public function testCanCreateResource()
    {
        $resource = ApiFactory::make('testkey', 'tag');

        $this->assertTrue($resource instanceof Api);
    }

    public function testThrowExceptionOnWrongResource()
    {
        $this->expectException(InvalidResourceException::class);
        ApiFactory::make('testkey', 'unvalid');
    }
}