<?php namespace Rule\ApiWrapper\Client;

class Response
{
    private $statusCode;
    private $data;

    public function __construct($statusCode, array $data)
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getData()
    {
        return $this->data;
    }
}