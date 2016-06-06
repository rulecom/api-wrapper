<?php namespace Rule\ApiWrapper\Api\V2\Transaction;

use Rule\ApiWrapper\Client\Client;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Transaction
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send(array $transaction)
    {
        $this->assertValidTransaction($transaction);

        $request = new Request('transactionals');
        $request->setParams($transaction);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    private function assertValidTransaction(array $transaction)
    {
        if(!isset($transaction['transaction_type'])) {
            throw new InvalidArgumentException("Transaction type is empty");
        }

        $this->assertValidContent($transaction['content']);
        $this->assertValidSender($transaction['from']);
        $this->assertValidRecipient($transaction['to']);
    }

    private function assertValidContent(array $content)
    {
        if(!isset($content) || empty($content)) {
            throw new InvalidArgumentException("Content is empty");
        }
    }

    private function assertValidSender(array $from)
    {
        if(!isset($from) || empty($from)) {
            throw new InvalidArgumentException("Sender is empty");
        }
    }

    private function assertValidRecipient(array $to)
    {
        if(!isset($to) || empty($to)) {
            throw new InvalidArgumentException("Recipient is empty");
        }
    }

    private function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getData()['message']);
        }
    }
}