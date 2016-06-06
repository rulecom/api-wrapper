<?php namespace Rule\ApiWrapper\Api\V2\Subscriber;

use Rule\ApiWrapper\Client\Client;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Subscriber
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(array $subscriber)
    {
        $defaults = ['language' => 'sv', 'update_on_duplicate' => true, 'tags' => []];

        $subscriber = array_merge($defaults, $subscriber);

        $this->assertValidSubscriberParams($subscriber);

        $params = [
            'update_on_duplicate' => $subscriber['update_on_duplicate'],
            'tags' => $subscriber['tags'],
            'subscribers' => $this->getSubscriberParams($subscriber)
        ];

        $request = new Request('subscribers');
        $request->setParams($params);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function createMultiple(array $subscribers)
    {
        $defaults = ['language' => 'sv', 'update_on_duplicate' => true, 'tags' => []];

        $subscriber = array_merge($defaults, $subscriber);

        foreach ($subscribers['subscribers'] as $subscriber) {
            $this->assertValidSubscriberParams($subscribers);
        }

        $params = [
            'update_on_duplicate' => $subscribers['update_on_duplicate'],
            'tags' => $subscribers['tags']
        ];

        $params['subscribers'] = array_map(function($subscriber){
                return $this->getSubscriberParams($subscriber)
            }, $subscribers['subscribers']);

        $request = new Request('subscribers');
        $request->setParams($params);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function getSubscribersList($limit = 100)
    {
        $request = new Request('subscribers');
        $request->setQuery(['limit' => $limit]);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function getSubscriber($id, $identifyBy = 'email')
    {
        $request = new Request('subscribers');
        $request->setQuery(['identified_by' => $identifyBy]);
        $request->setIdParam($id);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function getSubscriberFields($id, $identifyBy = "email")
    {
        $request = new Request('subscribers');
        $request->setQuery(['identified_by' => $identifyBy]);
        $request->setIdParam($id);
        $request->setSubresource('fields');

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    // TODO: look rule implementation
    public function updateSubscriber($id, $subscriber)
    {
        $request = new Request('subscribers');
        $request->setIdParam($id);

        $response = $this->client->put($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function addSubscriberTag($id, $identifyBy = 'email')
    {
        
    }

    public function getSubscriberTags($id, $identifyBy = "email")
    {
        $request = new Request('subscribers');
        $request->setQuery(['identified_by' => $identifyBy]);
        $request->setIdParam($id);
        $request->addSubresource(['name' => 'tags']);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    private function getSubscriberParams(array $subscriber)
    {
        $params = [];

        if(isset($subscriber['email'])) {
            $params['email'] = $subscriber['email'];
        }

        if(isset($subscriber['phone_number'])) {
            $params['phone_number'] = $subscriber['phone_number'];
        }

        if(isset($subscriber['fields'])) {
            $params['fields'] = $subscriber['fields'];
        }

        if(isset($subscriber['language'])) {
            $params['language'] = $subscriber['language'];
        }

        return $params;
    }

    private function assertValidSubscriberParams(array $subscriber)
    {
        if (!isset($subscriber['email']) && !isset($subscriber['phone_number'])) {
            throw new InvalidArgumentException('Either email or phone_number should be set for the subscriber');
        }

        if (isset($subscriber['fields'])) {
            foreach ($subscriber['fields'] as $field) {
                $this->assertValidField($field);
            }
        }
    }

    private function assertValidField($field)
    {
        if (!isset($field['key']) || count(explode('.', $field['key'])) != 2) {
            throw new InvalidArgumentException("Invalid field key: " . $field['key']);
        }

        if (!isset($field['value'])) {
            throw new InvalidArgumentException("Field '" . $field['key'] . "' have no value");
        }

        $fieldTypes = ['text', 'date', 'datetime', 'multiple', 'json'];
        if (isset($field['type'])) {
            if (!in_array($field['type'], $fieldTypes)) {
                throw new InvalidArgumentException("Invalid field type: " . $field['type']
                    . " for field: " . $field['key']);
            }
        }
    }

    private function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getData()['message']);
        }
    }
}