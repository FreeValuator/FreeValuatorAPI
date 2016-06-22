![Free Valuator](https://www.freevaluator.com/images/logo_small.png)

# Free Valuator API

PHP Class for the Free Valuator API.

## Requirements

- PHP 5.2 or higher
- cURL
- Free Valuator API credentials

## Get started

You will find everything you need to know to use this API in the [API Documentation](https://www.freevaluator.com/api-documentation)

## Usage

```php
include('freevaluator.class.php');
$freevaluator = new FreeValuator($username, $api_key);
$domain_appraisal = $freevaluator->domainAppraisal($domain);
```

### What is Free Valuator?

Free Valuator offers free and professional domain and website appraisals. Do you want to know how much your domains are worth? With this free domain valuation tool you can get a preview of what the value is of a domainname. Free Valuator calculates the value of the domain based on the domains keywords, statistics, website rankings and the sales of similar domains.

Free Valuator also offers professional domain appraisals by expert domain appraisers. A professional domain appraisal is based on multiple factors and gives a detailed overview of your domain's worth.

## License

This code is licensed under the GNU license.
