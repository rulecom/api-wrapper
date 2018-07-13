<?php namespace Rule\ApiWrapper\Client;

class Request
{
    /**
     * @var array
     */
    private $query;
    
    /**
     * @var mixed
     */
    private $idParam;

    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $resource;

    /**
     * @var array
     */
    private $subresources;

    /**
     * @var string
     */
    private $method;

    /**
     * Request constructor. Create new Request instance
     * 
     * @param $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Sets request query
     *
     * @param array $query
     */
    public function setQuery(array $query)
    {
        $this->query = $query;
    }

    /**
     * Returns request query
     *
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Sets id parameter to Request
     *
     * @param string $idParam
     */
    public function setIdParam($idParam)
    {
        $this->idParam = $idParam;
    }

    /**
     * Returns request id parameter
     *
     * @return mixed
     */
    public function getIdParam()
    {
        return $this->idParam;
    }

    /**
     * Sets request parameters
     *
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * Returns request parameters
     *
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Sets request resource
     *
     * @param string $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Returns request resource
     *
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Sets request subresources
     *
     * @param array $subresources
     */
    public function setSubresources(array $subresources)
    {
        $this->subresources = $subresources;
    }

    /**
     * Returns request subresources
     *
     * @return mixed
     */
    public function getSubresources()
    {
        return $this->subresources;
    }

    /**
     * Adds subresources to request
     *
     * @param array $subresource
     */
    public function addSubresource(array $subresource)
    {
        if(!isset($subresource['id'])) {
            $subresource['id'] = null;
        }

        $this->subresources[] = $subresource;
    }

    /**
     * Set request method
     *
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Returns request method
     * 
     * @return mixed
     */
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

        if ($this->subresources && count($this->subresources)) {
            foreach($this->subresources as $subresource) {
                if ($subresource['name']) {
                    $url .= $this->getResourceUrl($subresource['name'], $subresource['id']);
                }
            }
        }

        return $url;
    }

    /**
     * Returns resource URL
     * 
     * @param $name
     * @param null $id
     * @return string
     */
    private function getResourceUrl($name, $id = null) {
        $url = "/{$name}";

        if ($id)
            $url .= "/{$id}";

        return $url;
    }
}