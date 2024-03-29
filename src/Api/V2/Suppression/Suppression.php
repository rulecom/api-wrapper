<?php namespace Rule\ApiWrapper\Api\V2\Suppression;

use Rule\ApiWrapper\Api\Api;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Suppression extends Api
{
    /**
     * Returns suppression list
     *
     * @link https://rule.se/apidoc/#suppressions-get-suppressions-get
     *
     * @param int $limit
     * @return array
     * @throws \Exception
     */
    public function getList($limit = 100)
    {
        $this->assertValidLimit($limit);

        $request = new Request('suppressions');
        $request->setQuery(['limit' => $limit]);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Creates new Suppression
     *
     * @link https://rule.se/apidoc/#suppressions-suppressions-post
     *
     * @param array $suppressions
     * @param array $suppressOn
     * @return array
     * @throws \Exception
     */
    public function create(array $suppressions, array $suppressOn = null)
    {
        $this->assertValidSuppression($suppressOn);

        $request = new Request('suppressions');
        $request->setParams(['subscribers' => $suppressions, 'suppress_on' => $suppressOn]);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Check if Suppression data is valid
     *
     * @param array $suppressOn
     */
    private function assertValidSuppression(array $suppressOn)
    {
        if(isset($suppressOn['campaign']))
            $this->assertValidCampaign($suppressOn['campaign']);
        if(isset($suppressOn['transaction']))
            $this->assertValidTransaction($suppressOn['transaction']);
    }

    /**
     * Check if campaign is not empty
     *
     * @param $campaign
     */
    private function assertValidCampaign($campaign)
    {
        if (!is_array($campaign)) {
            throw new InvalidArgumentException('Campaign suppression should be an array');
        }
    }

    /**
     * Check is transaction is not empty
     *
     * @param $transaction
     */
    private function assertValidTransaction($transaction)
    {
        if(!is_array($transaction)) {
            throw new InvalidArgumentException('Transaction suppression should be an array');
        }
    }

    /**
     * Check if limit is valid
     *
     * @param $limit
     */
    private function assertValidLimit($limit)
    {
        if(!is_int($limit)){
            throw new InvalidArgumentException('Limit is invalid');
        }
    }

    /**
     * Delete new suppression
     *
     * @link https://apidoc.rule.se/#suppressions-delete-suppression-delete
     *
     * @param string $identifier
     * @param string $identifiedBy - "email"/"phone_number"/"id"
     * @param string $dispatcherType - "campaign"/"transaction"
     * @param string $messageType - "email"/"text_message"
     * @return array
     * @throws \Exception
     */
    public function delete($identifier, $identifiedBy = 'email', $dispatcherType = null, $messageType = null)
    {
        $this->assertValidIdentifiedBy($identifiedBy);
        $this->assertValidIdentifier($identifier, $identifiedBy);
        $this->assertValidDispatcherType($dispatcherType);
        $this->assertValidMessageType($messageType);

        $request = new Request(
            'suppressions/' . $identifier . '?' . http_build_query(
                array_merge(
                    [
                        'identified_by' => $identifiedBy
                    ],
                    $dispatcherType !== null ? [
                        'dispatcher_type' => $dispatcherType
                    ] : [],
                    $messageType !== null ? [
                        'message_type' => $dispatcherType
                    ] : []
                )
            )
        );

        $response = $this->client->delete($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * @param $identifierBy
     * @return void
     */
    private function assertValidIdentifiedBy($identifierBy)
    {
        if (!in_array($identifierBy, ['email', 'phone_number', 'id'])) {
            throw new InvalidArgumentException('"identifierBy" has incorrect value. Possible values: "email", "phone_number", "id"');
        }
    }

    private function assertValidIdentifier($identifier, $identifiedBy)
    {
        if (empty($identifier)) {
            throw new InvalidArgumentException('"identifier" should have a value');
        }

        if ($identifiedBy === "email") {
            if (!filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException('"identifier" should have correct email address');
            }
            return;
        }
        if ($identifiedBy === "id") {
            if (!is_numeric($identifier)) {
                throw new InvalidArgumentException('"identifier" should have correct ID number');
            }
        }
    }

    private function assertValidDispatcherType($dispatcherType)
    {
        if ($dispatcherType === null) {
            return;
        }
        if (!in_array($dispatcherType, ["campaign", "transaction"])) {
            throw new InvalidArgumentException('"dispatcherType" has incorrect value. Possible values: "campaign", "transaction"');
        }
    }

    private function assertValidMessageType($messageType)
    {
        if ($messageType === null) {
            return;
        }
        if (!in_array($messageType, ["email", "text_message"])) {
            throw new InvalidArgumentException('"messageType" has incorrect value. Possible values: "email", "text_message"');
        }
    }
}
