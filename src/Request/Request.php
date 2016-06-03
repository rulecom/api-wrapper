<?php namespace Rule\ApiWrapper\Request;

class Request
{
    private $query;
    private $idParam;
    private $body;
    private $resource;

    public function setQuery(array $query)
    {
        $this->query = $query;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setIdParam(array $idParam)
    {
        $this->idParam = $idParam;
    }

    public function getIdParam()
    {
        return $this->idParam;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setResource(string $resource)
    {
        $this->resource = $resource;
    }
}