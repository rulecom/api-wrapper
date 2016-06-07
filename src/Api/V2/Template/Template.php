<?php namespace Rule\ApiWrapper\Api\V2\Template;

use Rule\ApiWrapper\Api\Api;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Template extends Api
{
    /**
     * Get list of templates
     *
     * @link https://rule.se/apidoc/#templates-get-templates-get
     *
     * @return array
     * @throws \Exception
     */
    public function list()
    {
        $request = new Request('templates');

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Get template by id
     *
     * @link https://rule.se/apidoc/#templates-get-template-get
     *
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function get($id)
    {
        $this->assertValidTemplateId($id);
        
        $request = new Request('templates');
        $request->setIdParam($id);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Check if template id is valid
     *
     * @param $id
     */
    private function assertValidTemplateId($id)
    {
        if(!is_int($id)) {
            throw new InvalidArgumentException('Template id is invalid');
        }
    }
}