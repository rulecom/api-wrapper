<?php namespace Rule\ApiWrapper\Client;

class Response
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $data;

    /**
     * Response constructor. Creates new Response instance.
     *
     * @param $statusCode
     * @param array $data
     */
    public function __construct($statusCode, array $data)
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    /**
     * Returns Response status code.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Returns Response result.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}