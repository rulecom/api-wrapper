<?php namespace Rule\ApiWrapper\Api\V2\Tag;

use Rule\ApiWrapper\Api\Api;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Tag extends Api
{
    /**
     * Get list of tags
     *
     * @link https://rule.se/apidoc/#tags-get-tags-get
     *
     * @param int $limit
     * @return array
     * @throws \Exception
     */
    public function getList($limit = 100)
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
}