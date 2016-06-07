<?php namespace Rule\ApiWrapper\Api\V2\Template;

use Rule\ApiWrapper\Client\Client;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Template
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Template constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get list of templates
     *
     * @link https://rule.se/apidoc/#templates-get-templates-get
     *
     * @return array
     * @throws \Exception
     */
    public function getTemplates()
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
    public function getTemplate($id)
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

    private function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getData()['message']);
        }
    }
}