<?php namespace Rule\ApiWrapper\Client;

class Request
{
    private $query;
    private $idParam;
    private $params;
    private $resource;
    private $subresource;
    private $method;

    public function __construct($resource)
    {
        $this->resource = $resource;
    }

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

    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setResource(string $resource)
    {
        $this->resource = $resource;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setSubresource(string $subresource)
    {
        $this->subresource = $subresource;
    }

    public function getSubresource()
    {
        return $this->subresource;
    }

    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    
    /**
     * Get relative url from request
     *
     * @return string Relative url
     */
    public function getRelativeUrl()
    {
        $url = "/{$this->resource}";

        if ($this->idParam)
            $url = $url . "/{$this->idParam}";

        if ($this->subresource)
            $url = $url . "/$this->subresource";

        return $url;
    }
}