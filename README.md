# RULE api wrapper
Package wrapping an [RULE Mailer api](https://rule.se/apidoc/) using an `guzzlehttp` client as backend for the requests

# Installation
Regular composer installation supposed, like:
`composer require rulecom/api-wrapper`

# Integration with Laravel
Use `src/LaravelServiceProvider.php` to register API instances in your application.
Create `config/rule-api.php` file for the API configuration. 

Then you'll be able to disectly use configured API classes
```php

use Rule\ApiWrapper\Api\V2\Subscriber\Subscriber;

class Foo
{
    private $subscriberApi;

    public function __construct(Subscriber $subscriberApi)
    {
        $this->subscriberApi = $subscriberApi;
    }

    public function createMeSomeSubscriber($params)
    {
        //... do something 
        $this->subscriberApi->create([
            'email' => $email,
            //... see docs for detailes
        ]);
    }
}
```


# Docs
For the docs please refer [docs](docs/README.md) folder in this repository.
