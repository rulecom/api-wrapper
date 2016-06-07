<?php namespace tests\Rule\ApiWrapper\Api\V2\Transaction;

use Rule\ApiWrapper\Api\V2\Transaction\Transaction;
use tests\Rule\ApiWrapper\Api\ApiTestCase;

class TransactionTest extends ApiTestCase
{

    protected function getApi()
    {
        $api = new Transaction($this->getClient());

        return $api;
    }

    public function testSendEmailTransaction()
    {
        $api = $this->getApi();
        $response = $api->send([
            'transaction_type' => 'email',
            'transaction_name' => 'Test Transaction',
            'subject' => 'test',
            'from' => ['name' => 'RULE Tester', 'email' => 'tester@rule.se'],
            'to' => ['name' => 'Recipient Jackson', 'email' => 'testerson@email.com'],
            'content' => ['html' => '<b>Test my mail</b>', 'plain' => 'test my mail']
        ]);

        $this->assertArrayHasKey('transaction_id', $response);
    }

    public function testSendTextMessage()
    {
        $api = $this->getApi();
        $response = $api->send([
            'transaction_type' => 'text_message',
            'from' => ['name' => 'RULE Tester'],
            'to' => ['phone_number' => '12345678'],
            'content' => "test message"
        ]);

        $this->assertArrayHasKey('transaction_id', $response);
    }
}