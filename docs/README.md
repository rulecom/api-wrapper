# RULE Api Wrapper Documentation

## Table of Contents

* [Api](#api)
    * [__construct](#__construct)
    * [getClient](#getclient)
* [ApiFactory](#apifactory)
    * [make](#make)
* [Campaign](#campaign)
    * [__construct](#__construct-1)
    * [getClient](#getclient-1)
    * [getList](#getlist)
    * [get](#get)
    * [statistics](#statistics)
    * [send](#send)
    * [schedule](#schedule)
* [Client](#client)
    * [__construct](#__construct-2)
    * [getApiKey](#getapikey)
    * [getVersion](#getversion)
    * [getBaseUrl](#getbaseurl)
    * [setApiKey](#setapikey)
    * [setVersion](#setversion)
    * [setBaseUrl](#setbaseurl)
    * [get](#get-1)
    * [post](#post)
    * [put](#put)
    * [delete](#delete)
* [Client](#client-1)
    * [__construct](#__construct-3)
    * [getApiKey](#getapikey-1)
    * [getVersion](#getversion-1)
    * [getBaseUrl](#getbaseurl-1)
    * [setApiKey](#setapikey-1)
    * [setVersion](#setversion-1)
    * [setBaseUrl](#setbaseurl-1)
    * [get](#get-2)
    * [post](#post-1)
    * [put](#put-1)
    * [delete](#delete-1)
    * [setLogger](#setlogger)
* [Customization](#customization)
    * [__construct](#__construct-4)
    * [getClient](#getclient-2)
    * [create](#create)
    * [getList](#getlist-1)
    * [get](#get-3)
* [InvalidResourceException](#invalidresourceexception)
* [LaravelServiceProvider](#laravelserviceprovider)
    * [register](#register)
* [Request](#request)
    * [__construct](#__construct-5)
    * [setQuery](#setquery)
    * [getQuery](#getquery)
    * [setIdParam](#setidparam)
    * [getIdParam](#getidparam)
    * [setParams](#setparams)
    * [getParams](#getparams)
    * [setResource](#setresource)
    * [getResource](#getresource)
    * [setSubresources](#setsubresources)
    * [getSubresources](#getsubresources)
    * [addSubresource](#addsubresource)
    * [setMethod](#setmethod)
    * [getMethod](#getmethod)
    * [getRelativeUrl](#getrelativeurl)
* [RequestFactory](#requestfactory)
    * [make](#make-1)
* [Response](#response)
    * [__construct](#__construct-6)
    * [getStatusCode](#getstatuscode)
    * [getData](#getdata)
* [ResponseErrorException](#responseerrorexception)
* [ResponseFactory](#responsefactory)
    * [make](#make-2)
* [Subscriber](#subscriber)
    * [__construct](#__construct-7)
    * [getClient](#getclient-3)
    * [create](#create-1)
    * [createMultiple](#createmultiple)
    * [getList](#getlist-2)
    * [get](#get-4)
    * [getFields](#getfields)
    * [update](#update)
    * [addTags](#addtags)
    * [getTags](#gettags)
    * [deleteTag](#deletetag)
    * [delete](#delete-2)
    * [deleteMultiple](#deletemultiple)
    * [import](#import)
* [Suppression](#suppression)
    * [__construct](#__construct-8)
    * [getClient](#getclient-4)
    * [getList](#getlist-3)
    * [create](#create-2)
* [Tag](#tag)
    * [__construct](#__construct-9)
    * [getClient](#getclient-5)
    * [getList](#getlist-4)
    * [delete](#delete-3)
    * [clear](#clear)
* [Template](#template)
    * [__construct](#__construct-10)
    * [getClient](#getclient-6)
    * [getList](#getlist-5)
    * [get](#get-5)
* [Transaction](#transaction)
    * [__construct](#__construct-11)
    * [getClient](#getclient-7)
    * [send](#send-1)

## Api





* Full name: \Rule\ApiWrapper\Api\Api


### __construct

Create api instance

```php
Api::__construct( \Rule\ApiWrapper\Client\Client $client )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$client` | **\Rule\ApiWrapper\Client\Client** | HTTP client implementation for api |




---

### getClient

Get http client

```php
Api::getClient(  ): \Rule\ApiWrapper\Client\Client
```







---

## ApiFactory





* Full name: \Rule\ApiWrapper\ApiFactory


### make

Creates api resource

```php
ApiFactory::make( string $key, string $resource,  $version = &#039;v2&#039; ): \Rule\ApiWrapper\Api
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **string** | Rule api key |
| `$resource` | **string** | Resource name [subscriber, campaign, customization, suppression, tag, template, transaction] |
| `$version` | **** |  |




---

## Campaign





* Full name: \Rule\ApiWrapper\Api\V2\Campaign\Campaign
* Parent class: \Rule\ApiWrapper\Api\Api


### __construct

Create api instance

```php
Campaign::__construct( \Rule\ApiWrapper\Client\Client $client )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$client` | **\Rule\ApiWrapper\Client\Client** | HTTP client implementation for api |




---

### getClient

Get http client

```php
Campaign::getClient(  ): \Rule\ApiWrapper\Client\Client
```







---

### getList

Get campaigns

```php
Campaign::getList( integer $limit = 100 ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$limit` | **integer** | Limit for the campaigns count, default 100 max 100 |


**Return Value:**

Request result


**See Also:**

* https://rule.se/apidoc/#campaigns-campaigns-get 

---

### get

Get campaign data.

```php
Campaign::get( integer $id ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **integer** | Id of the campaign. |


**Return Value:**

Request result


**See Also:**

* https://rule.se/apidoc/#campaigns-get-campaign-get 

---

### statistics

Get campaign statistics.

```php
Campaign::statistics( integer $id ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **integer** | Id of the campaign. |


**Return Value:**

Request result


**See Also:**

* https://rule.se/apidoc/#campaigns-get-statistics-get 

---

### send

Send campaign.

```php
Campaign::send( array $campaign ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$campaign` | **array** | Campaign data formated according {@link https://rule.se/apidoc/#campaigns-send-campaign-post} |



**See Also:**

* https://rule.se/apidoc/#campaigns-send-campaign-post 

---

### schedule

Schedule campaign.

```php
Campaign::schedule( array $campaign ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$campaign` | **array** | Campaign data formated according {@link https://rule.se/apidoc/#campaigns-send-campaign-post} |



**See Also:**

* https://rule.se/apidoc/#campaigns-schedule-campaign-post 

---

## Client





* Full name: \Rule\ApiWrapper\Guzzle\Client
* Parent class: \Rule\ApiWrapper\Client\Client


### __construct

Creates new Guzzle client instance

```php
Client::__construct( string $apiKey, string $version = &#039;v2&#039;, string $baseUrl = &quot;http://app.rule.io/api/&quot; )
```

Client constructor.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$apiKey` | **string** |  |
| `$version` | **string** |  |
| `$baseUrl` | **string** |  |




---

### getApiKey

Get Rule api key

```php
Client::getApiKey(  ): string
```







---

### getVersion

Get Rule api version

```php
Client::getVersion(  ): string
```







---

### getBaseUrl

Get base Rule url

```php
Client::getBaseUrl(  ): string
```







---

### setApiKey



```php
Client::setApiKey(  $key )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **** |  |




---

### setVersion



```php
Client::setVersion(  $version )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$version` | **** |  |




---

### setBaseUrl



```php
Client::setBaseUrl(  $baseUrl )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$baseUrl` | **** |  |




---

### get

Makes get request

```php
Client::get( \Rule\ApiWrapper\Client\Request $request ): \Rule\ApiWrapper\Client\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Rule\ApiWrapper\Client\Request** | Request instance |




---

### post

Makes post request

```php
Client::post( \Rule\ApiWrapper\Client\Request $request ): \Rule\ApiWrapper\Client\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Rule\ApiWrapper\Client\Request** | Request instance |




---

### put

Makes put request

```php
Client::put( \Rule\ApiWrapper\Client\Request $request ): \Rule\ApiWrapper\Client\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Rule\ApiWrapper\Client\Request** | Request instance |




---

### delete

Makes delete request

```php
Client::delete( \Rule\ApiWrapper\Client\Request $request ): \Rule\ApiWrapper\Client\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Rule\ApiWrapper\Client\Request** | Request instance |




---

## Client





* Full name: \Rule\ApiWrapper\Logger\Client
* Parent class: \Rule\ApiWrapper\Client\Client


### __construct

Client constructor.

```php
Client::__construct(  $apiKey, string $version = &#039;v2&#039;, string $baseUrl = &quot;http://app.rule.io/api/&quot; )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$apiKey` | **** |  |
| `$version` | **string** |  |
| `$baseUrl` | **string** |  |




---

### getApiKey

Get Rule api key

```php
Client::getApiKey(  ): string
```







---

### getVersion

Get Rule api version

```php
Client::getVersion(  ): string
```







---

### getBaseUrl

Get base Rule url

```php
Client::getBaseUrl(  ): string
```







---

### setApiKey



```php
Client::setApiKey(  $key )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **** |  |




---

### setVersion



```php
Client::setVersion(  $version )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$version` | **** |  |




---

### setBaseUrl



```php
Client::setBaseUrl(  $baseUrl )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$baseUrl` | **** |  |




---

### get

Make get request to api

```php
Client::get( \Rule\ApiWrapper\Client\Request $request ): \Rule\ApiWrapper\Client\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Rule\ApiWrapper\Client\Request** | Request instance |




---

### post

Make post request to api

```php
Client::post( \Rule\ApiWrapper\Client\Request $request ): \Rule\ApiWrapper\Client\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Rule\ApiWrapper\Client\Request** | Request instance |




---

### put

Make put request to api

```php
Client::put( \Rule\ApiWrapper\Client\Request $request ): \Rule\ApiWrapper\Client\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Rule\ApiWrapper\Client\Request** | Request instance |




---

### delete

Make delete request to api

```php
Client::delete( \Rule\ApiWrapper\Client\Request $request ): \Rule\ApiWrapper\Client\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Rule\ApiWrapper\Client\Request** | Request instance |




---

### setLogger



```php
Client::setLogger(  $logger )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$logger` | **** |  |




---

## Customization





* Full name: \Rule\ApiWrapper\Api\V2\Customization\Customization
* Parent class: \Rule\ApiWrapper\Api\Api


### __construct

Create api instance

```php
Customization::__construct( \Rule\ApiWrapper\Client\Client $client )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$client` | **\Rule\ApiWrapper\Client\Client** | HTTP client implementation for api |




---

### getClient

Get http client

```php
Customization::getClient(  ): \Rule\ApiWrapper\Client\Client
```







---

### create

Create fields.

```php
Customization::create( array $fields ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$fields` | **array** | Array of fields {@link https://rule.se/apidoc/#subscriber-fields-create-groups-and-fields-post} |


**Return Value:**

Response result



---

### getList

Get groups.

```php
Customization::getList( integer $limit = 100 ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$limit` | **integer** | Limit of the results count |


**Return Value:**

Request result



---

### get

Get group fields

```php
Customization::get( integer $id ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **integer** | Id of the group |


**Return Value:**

Request result



---

## InvalidResourceException





* Full name: \Rule\ApiWrapper\Api\Exception\InvalidResourceException
* Parent class: 


## LaravelServiceProvider





* Full name: \Rule\ApiWrapper\LaravelServiceProvider
* Parent class: 


### register



```php
LaravelServiceProvider::register(  )
```







---

## Request





* Full name: \Rule\ApiWrapper\Client\Request


### __construct

Request constructor. Create new Request instance

```php
Request::__construct(  $resource )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$resource` | **** |  |




---

### setQuery

Sets request query

```php
Request::setQuery( array $query )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$query` | **array** |  |




---

### getQuery

Returns request query

```php
Request::getQuery(  ): mixed
```







---

### setIdParam

Sets id parameter to Request

```php
Request::setIdParam( string $idParam )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$idParam` | **string** |  |




---

### getIdParam

Returns request id parameter

```php
Request::getIdParam(  ): mixed
```







---

### setParams

Sets request parameters

```php
Request::setParams( array $params )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$params` | **array** |  |




---

### getParams

Returns request parameters

```php
Request::getParams(  ): mixed
```







---

### setResource

Sets request resource

```php
Request::setResource( string $resource )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$resource` | **string** |  |




---

### getResource

Returns request resource

```php
Request::getResource(  ): mixed
```







---

### setSubresources

Sets request subresources

```php
Request::setSubresources( array $subresources )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$subresources` | **array** |  |




---

### getSubresources

Returns request subresources

```php
Request::getSubresources(  ): mixed
```







---

### addSubresource

Adds subresources to request

```php
Request::addSubresource( array $subresource )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$subresource` | **array** |  |




---

### setMethod

Set request method

```php
Request::setMethod( string $method )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$method` | **string** |  |




---

### getMethod

Returns request method

```php
Request::getMethod(  ): mixed
```







---

### getRelativeUrl

Get relative url from request

```php
Request::getRelativeUrl(  ): string
```





**Return Value:**

Relative url



---

## RequestFactory





* Full name: \Rule\ApiWrapper\Guzzle\RequestFactory


### make



```php
RequestFactory::make( \Rule\ApiWrapper\Client\Request $request,  $baseUrl = &quot;&quot; )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Rule\ApiWrapper\Client\Request** |  |
| `$baseUrl` | **** |  |




---

## Response





* Full name: \Rule\ApiWrapper\Client\Response


### __construct

Response constructor. Creates new Response instance.

```php
Response::__construct(  $statusCode, array $data )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$statusCode` | **** |  |
| `$data` | **array** |  |




---

### getStatusCode

Returns Response status code.

```php
Response::getStatusCode(  ): integer
```







---

### getData

Returns Response result.

```php
Response::getData(  ): array
```







---

## ResponseErrorException





* Full name: \Rule\ApiWrapper\Api\Exception\ResponseErrorException
* Parent class: 


## ResponseFactory





* Full name: \Rule\ApiWrapper\Guzzle\ResponseFactory


### make



```php
ResponseFactory::make( \GuzzleHttp\Psr7\Response $response )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$response` | **\GuzzleHttp\Psr7\Response** |  |




---

## Subscriber





* Full name: \Rule\ApiWrapper\Api\V2\Subscriber\Subscriber
* Parent class: \Rule\ApiWrapper\Api\Api


### __construct

Create api instance

```php
Subscriber::__construct( \Rule\ApiWrapper\Client\Client $client )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$client` | **\Rule\ApiWrapper\Client\Client** | HTTP client implementation for api |




---

### getClient

Get http client

```php
Subscriber::getClient(  ): \Rule\ApiWrapper\Client\Client
```







---

### create

Creates new subscriber

```php
Subscriber::create( array $subscriber ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$subscriber` | **array** |  |



**See Also:**

* https://rule.se/apidoc/#subscribers-create-new-subscriber-post 

---

### createMultiple

Create new subscribers

```php
Subscriber::createMultiple( array $subscribers ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$subscribers` | **array** |  |



**See Also:**

* https://rule.se/apidoc/#subscribers-create-new-subscriber-post 

---

### getList

Returns subscribers list

```php
Subscriber::getList( integer $limit = 100 ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$limit` | **integer** |  |



**See Also:**

* https://rule.se/apidoc/#subscribers-get-subscribers-get 

---

### get

Returns single subscriber

```php
Subscriber::get(  $id, string $identifyBy = &#039;email&#039; ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$identifyBy` | **string** |  |



**See Also:**

* https://rule.se/apidoc/#subscribers-get-subscriber-get 

---

### getFields

Returns subscriber fields

```php
Subscriber::getFields(  $id, string $identifyBy = &quot;email&quot; ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$identifyBy` | **string** |  |



**See Also:**

* https://rule.se/apidoc/#subscribers-get-subscriber-fields-get 

---

### update

Updates subscriber

```php
Subscriber::update(  $id,  $subscriber ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$subscriber` | **** |  |



**See Also:**

* https://rule.se/apidoc/#subscribers-update-subscriber-put 

---

### addTags

Adds tags to subscriber

```php
Subscriber::addTags(  $id, array $tags, string $identifyBy = &#039;email&#039; ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$tags` | **array** |  |
| `$identifyBy` | **string** |  |



**See Also:**

* https://rule.se/apidoc/#subscribers-tags-post 

---

### getTags

Returns subscriber tags

```php
Subscriber::getTags(  $id, string $identifyBy = &quot;email&quot; ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$identifyBy` | **string** |  |



**See Also:**

* https://rule.se/apidoc/#subscribers-tags-get 

---

### deleteTag

Removes subscriber tags

```php
Subscriber::deleteTag(  $id,  $tag, string $identifyBy = &quot;email&quot; ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$tag` | **** |  |
| `$identifyBy` | **string** |  |



**See Also:**

* https://rule.se/apidoc/#subscribers-delete-subscriber-tag-delete 

---

### delete



```php
Subscriber::delete( integer|string $id, string $identifiedBy = &#039;email&#039; ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **integer&#124;string** | User identifier to delete |
| `$identifiedBy` | **string** | Identifier type |


**Return Value:**

Server response


**See Also:**

* https://rule.se/apidoc/#subscribers-delete-subscriber-delete 

---

### deleteMultiple



```php
Subscriber::deleteMultiple( array $subscribers ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$subscribers` | **array** |  |




---

### import



```php
Subscriber::import( string $filename, array $mappings, array $tags, boolean $overrideSuppressions = false ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$filename` | **string** | Name of the file stored on s3 |
| `$mappings` | **array** | Mappings for the columns |
| `$tags` | **array** | Tags to import to |
| `$overrideSuppressions` | **boolean** |  |


**Return Value:**

Response data



---

## Suppression





* Full name: \Rule\ApiWrapper\Api\V2\Suppression\Suppression
* Parent class: \Rule\ApiWrapper\Api\Api


### __construct

Create api instance

```php
Suppression::__construct( \Rule\ApiWrapper\Client\Client $client )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$client` | **\Rule\ApiWrapper\Client\Client** | HTTP client implementation for api |




---

### getClient

Get http client

```php
Suppression::getClient(  ): \Rule\ApiWrapper\Client\Client
```







---

### getList

Returns suppression list

```php
Suppression::getList( integer $limit = 100 ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$limit` | **integer** |  |



**See Also:**

* https://rule.se/apidoc/#suppressions-get-suppressions-get 

---

### create

Creates new Suppression

```php
Suppression::create( array $suppressions, array $suppressOn = null ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$suppressions` | **array** |  |
| `$suppressOn` | **array** |  |



**See Also:**

* https://rule.se/apidoc/#suppressions-suppressions-post 

---

## Tag





* Full name: \Rule\ApiWrapper\Api\V2\Tag\Tag
* Parent class: \Rule\ApiWrapper\Api\Api


### __construct

Create api instance

```php
Tag::__construct( \Rule\ApiWrapper\Client\Client $client )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$client` | **\Rule\ApiWrapper\Client\Client** | HTTP client implementation for api |




---

### getClient

Get http client

```php
Tag::getClient(  ): \Rule\ApiWrapper\Client\Client
```







---

### getList

Get list of tags

```php
Tag::getList( integer $limit = 100 ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$limit` | **integer** |  |



**See Also:**

* https://rule.se/apidoc/#tags-get-tags-get 

---

### delete

Delete tag by id

```php
Tag::delete(  $id ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |



**See Also:**

* https://rule.se/apidoc/#tags-delete-tag-delete 

---

### clear

Clear associations between subscriber and tag

```php
Tag::clear(  $id ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |



**See Also:**

* https://rule.se/apidoc/#tags-clear-tag-delete 

---

## Template





* Full name: \Rule\ApiWrapper\Api\V2\Template\Template
* Parent class: \Rule\ApiWrapper\Api\Api


### __construct

Create api instance

```php
Template::__construct( \Rule\ApiWrapper\Client\Client $client )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$client` | **\Rule\ApiWrapper\Client\Client** | HTTP client implementation for api |




---

### getClient

Get http client

```php
Template::getClient(  ): \Rule\ApiWrapper\Client\Client
```







---

### getList

Get list of templates

```php
Template::getList(  ): array
```






**See Also:**

* https://rule.se/apidoc/#templates-get-templates-get 

---

### get

Get template by id

```php
Template::get(  $id ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |



**See Also:**

* https://rule.se/apidoc/#templates-get-template-get 

---

## Transaction





* Full name: \Rule\ApiWrapper\Api\V2\Transaction\Transaction
* Parent class: \Rule\ApiWrapper\Api\Api


### __construct

Create api instance

```php
Transaction::__construct( \Rule\ApiWrapper\Client\Client $client )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$client` | **\Rule\ApiWrapper\Client\Client** | HTTP client implementation for api |




---

### getClient

Get http client

```php
Transaction::getClient(  ): \Rule\ApiWrapper\Client\Client
```







---

### send

Send transaction

```php
Transaction::send( array $transaction ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$transaction` | **array** |  |



**See Also:**

* https://rule.se/apidoc/#transactions-send-transaction-post 

---



--------
> This document was automatically generated from source code comments on 2020-02-13 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
