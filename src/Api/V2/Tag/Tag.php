<?php namespace Rule\ApiWrapper\Api\V2\Tag;

use Rule\ApiWrapper\Client\Client;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Tag
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Tag constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get list of tags
     *
     * @link https://rule.se/apidoc/#tags-get-tags-get
     *
     * @param int $limit
     * @return array
     * @throws \Exception
     */
    public function get($limit = 100)
    {
        $request = new Request('tags');
        $request->setQuery(['limit' => $limit]);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Delete tag by id
     *
     * @link https://rule.se/apidoc/#tags-delete-tag-delete
     *
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function delete($id)
    {
        $request = new Request('tags');
        $request->setIdParam(urlencode($id));

        $response = $this->client->delete($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Clear associations between subscriber and tag
     *
     * @link https://rule.se/apidoc/#tags-clear-tag-delete
     *
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function clear($id)
    {
        $request = new Request('tags');
        $request->setIdParam(urlencode($id));
        $request->addSubresource(['name' => 'clear']);
        $response = $this->client->delete($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    private function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getData()['message']);
        }
    }

}