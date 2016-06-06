<?php namespace Rule\ApiWrapper\Api\V2\Campaign;

use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Campaign
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function list($limit = 100)
    {
        $request = new Request('campaigns');
        $request->setQuery(['limit' => $limit]);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function get($id)
    {
        $request = new Request('campaigns');
        $request->setIdParam($id);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function statistics($id)
    {
        $request = new Request('campaigns');
        $request->setIdParam($id);
        $request->addSubresource(['name' => 'statistics']);
        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function send(array $campaign)
    {
        $this->assertValidCampaign($campaign);

        $request = new Request('campaigns');
        $request->addSubresource(['name' => 'send']);
        $request->setParams($campaign);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function schedule(array $campaign)
    {
        $this->assertValidCampaign($campaign);
        $this->assertScheduledCampaign($campaign);

        $request = new Request('campaigns');
        $request->addSubresource(['name' => 'schedule']);
        $request->setParams($campaign);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    private function assertValidCampaign(array $campaign)
    {
        if (!isset($campaign['subject'])) {
            throw new InvalidArgumentException('subject field should be set');
        }

        if (!isset($campaign['from'])) {
            throw new InvalidArgumentException('from field should be set');
        }

        if (!isset($campaign['message_type'])
            || !in_array($campaign['message_type'], ['email', 'text_message'])) {
            throw new InvalidArgumentException('Appropriate message_type should be set');
        }

        if (!isset($campaign['recepients'])) {
            throw new InvalidArgumentException('Recipients should be set');
        }

        if (!isset($campaign['content'])) {
            throw new InvalidArgumentException('Content should be set');
        }
    }

    private function assertScheduledCampaign(array $campaign)
    {
        if (!isset($campaign['send_at'])) {
            throw new InvalidArgumentException('Campaign should be scheduled');
        }
    }

    private function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getData()['message']);
        }
    }
}