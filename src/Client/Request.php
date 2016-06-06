<?php namespace Rule\ApiWrapper\Client;

class Request
{
    private $query;
    private $idParam;
    private $params;
    private $resource;
    private $subresources;
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

    public function setSubresources(array $subresources)
    {
        $this->subresources = $subresources;
    }

    public function getSubresources()
    {
        return $this->subresources;
    }

    public function addSubresource(array $subresource)
    {
        $this->subresources[] = $subresource;
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
        $url = $this->getResourceUrl($this->resource, $this->idParam);

        if (count($this->subresources)) {
            foreach($this->subresources as $subresource) {
                if ($subresource['name']) {
                    $url .= $this->getResourceUrl($subresource['name'], $subresource['id']);
                }
            }
        }

        return $url;
    }

    private function getResourceUrl($name, $id = null) {
        $url = "/{$name}";

        if ($id)
            $url .= "/{$id}";

        return $url;
    }
}