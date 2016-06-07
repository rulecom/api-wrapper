<?php namespace Rule\ApiWrapper\Api\V2\Transaction;

use Rule\ApiWrapper\Api\Api;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Transaction extends Api
{
    /**
     * Send transaction
     *
     * @link https://rule.se/apidoc/#transactions-send-transaction-post
     *
     * @param array $transaction
     * @return array
     * @throws \Exception
     */
    public function send(array $transaction)
    {
        $this->assertValidTransaction($transaction);

        $request = new Request('transactionals');
        $request->setParams($transaction);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Check if transaction data is valid
     *
     * @param array $transaction
     */
    private function assertValidTransaction(array $transaction)
    {
        if(!isset($transaction['transaction_type'])) {
            throw new InvalidArgumentException("Transaction type is empty");
        }

        $this->assertValidContent($transaction['content']);
        $this->assertValidSender($transaction['from']);
        $this->assertValidRecipient($transaction['to']);
    }

    /**
     * Check if transaction has valid content
     *
     * @param array $content
     */
    private function assertValidContent(array $content)
    {
        if(!isset($content) || empty($content)) {
            throw new InvalidArgumentException("Content is empty");
        }
    }

    /**
     * Check if transaction has valid sender data
     *
     * @param array $from
     */
    private function assertValidSender(array $from)
    {
        if(!isset($from) || empty($from)) {
            throw new InvalidArgumentException("Sender is empty");
        }
    }

    /**
     * Check if transaction has valid recipient data
     *
     * @param array $to
     */
    private function assertValidRecipient(array $to)
    {
        if(!isset($to) || empty($to)) {
            throw new InvalidArgumentException("Recipient is empty");
        }
    }
}