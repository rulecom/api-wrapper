<?php namespace Rule\ApiWrapper\Api\V2\Subscriber;

use Rule\ApiWrapper\Api\Api;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Subscriber extends Api
{
    /**
     * Creates new subscriber
     *
     * @link https://rule.se/apidoc/#subscribers-create-new-subscriber-post
     *
     * @param array $subscriber
     * @return array
     * @throws \Exception
     */
    public function create(array $subscriber)
    {
        $defaults = ['language' => 'sv', 'update_on_duplicate' => true, 'tags' => [], 'automation' => false];

        $subscriber = array_merge($defaults, $subscriber);

        $this->assertValidSubscriberParams($subscriber);

        $params = [
            'automation' => $subscriber['automation'],
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

    /**
     * Create new subscribers
     *
     * @link https://rule.se/apidoc/#subscribers-create-new-subscriber-post
     *
     * @param array $subscribers
     * @return array
     * @throws \Exception
     */
    public function createMultiple(array $subscribers)
    {
        $defaults = ['language' => 'sv', 'update_on_duplicate' => true, 'tags' => [], 'automation' => false];

        $subscribers = array_merge($defaults, $subscribers);

        foreach ($subscribers['subscribers'] as $subscriber) {
            $this->assertValidSubscriberParams($subscriber);
        }

        $params = [
            'automation' =>  $subscribers['automation'],
            'update_on_duplicate' => $subscribers['update_on_duplicate'],
            'tags' => $subscribers['tags']
        ];

        $params['subscribers'] = array_map(function($subscriber){
                return $this->getSubscriberParams($subscriber);
            }, $subscribers['subscribers']);

        $request = new Request('subscribers');
        $request->setParams($params);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Returns subscribers list
     *
     * @link https://rule.se/apidoc/#subscribers-get-subscribers-get
     *
     * @param int $limit
     * @return array
     * @throws \Exception
     */
    public function getList($limit = 100)
    {
        $request = new Request('subscribers');
        $request->setQuery(['limit' => $limit]);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Returns single subscriber
     *
     * @link https://rule.se/apidoc/#subscribers-get-subscriber-get
     *
     * @param $id
     * @param string $identifyBy
     * @return array
     * @throws \Exception
     */
    public function get($id, $identifyBy = 'email')
    {
        $request = new Request('subscribers');
        $request->setQuery(['identified_by' => $identifyBy]);
        $request->setIdParam($id);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Returns subscriber fields
     *
     * @link https://rule.se/apidoc/#subscribers-get-subscriber-fields-get
     *
     * @param $id
     * @param string $identifyBy
     * @return array
     * @throws \Exception
     */
    public function getFields($id, $identifyBy = "email")
    {
        $request = new Request('subscriber');
        $request->setQuery(['identified_by' => $identifyBy]);
        $request->setIdParam($id);
        $request->addSubresource(['name' => 'fields']);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Updates subscriber
     *
     * @link https://rule.se/apidoc/#subscribers-update-subscriber-put
     *
     * @param $id
     * @param $subscriber
     * @return array
     * @throws Exception
     * @throws \Exception
     */
    public function update($id, $subscriber)
    {
        if (!$id) {
            throw new \Exception('Subscriber id should be providen');
        }

        $this->assertValidSubscriberParams($subscriber);

        $request = new Request('subscribers');
        $request->setIdParam($id);
        $request->setParams($this->getSubscriberParams($subscriber));

        $response = $this->client->put($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Adds tags to subscriber
     *
     * @link https://rule.se/apidoc/#subscribers-tags-post
     *
     * @param $id
     * @param array $tags
     * @param string $identifyBy
     * @return array
     * @throws \Exception
     */
    public function addTags($id, array $tags, $identifyBy = 'email')
    {
        $request = new Request('subscribers');
        $request->setQuery(['identified_by' => $identifyBy]);
        $request->setIdParam($id);
        $request->addSubresource(['name' => 'tags']);
        $request->setParams(['tags' => $tags]);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();

    }

    /**
     * Returns subscriber tags
     *
     * @link https://rule.se/apidoc/#subscribers-tags-get
     *
     * @param $id
     * @param string $identifyBy
     * @return array
     * @throws \Exception
     */
    public function getTags($id, $identifyBy = "email")
    {
        $request = new Request('subscribers');
        $request->setQuery(['identified_by' => $identifyBy]);
        $request->setIdParam($id);
        $request->addSubresource(['name' => 'tags']);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Removes subscriber tags
     *
     * @link https://rule.se/apidoc/#subscribers-delete-subscriber-tag-delete
     *
     * @param $id
     * @param $tag
     * @param string $identifyBy
     * @return array
     * @throws \Exception
     */
    public function deleteTag($id, $tag, $identifyBy = "email")
    {
        $request = new Request('subscribers');
        $request->setQuery(['identified_by' => $identifyBy]);
        $request->setIdParam($id);
        $request->addSubresource(['name' => 'tags', 'id' => urlencode($tag)]);

        $response = $this->client->delete($request);

        $this->assertSuccessResponse($response);

        return $response->getData();

    }

    /**
     * @link https://rule.se/apidoc/#subscribers-delete-subscriber-delete
     * @param int|string $id User identifier to delete
     * @param string $identifiedBy Identifier type
     * @return array Server response
     */
    public function delete($id, $identifiedBy = 'email')
    {
        $request = new Request('subscribers');
        $request->setQuery(['identified_by' => $identifiedBy]);
        $request->setIdParam($id);

        $response = $this->client->delete($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * @param array $subscribers
     * @return array
     */
    public function deleteMultiple(array $subscribers)
    {
        $request = new Request('subscribers');
        $request->setParams($subscribers);

        $response = $this->client->delete($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * @param string $filename Name of the file stored on s3
     * @param array $mappings Mappings for the columns
     * @param array $tags Tags to import to
     * @return array Response data
     */
    public function import($filename, array $mappings, array $tags)
    {
        $params = [
            'filename' => $filename,
            'mappings' => $mappings,
            'tags' => $tags
        ];

        $request = new Request('import');
        $request->setParams($params);
        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * @param array $subscriber
     * TODO: refactor this
     * @return array
     */
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
}
