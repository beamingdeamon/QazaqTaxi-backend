# PayHost #

This library is merely a Merchant integration helper in PHP

**Requirements: PHP 5.3** because of *namespaces*.

## Setup ##

Add a `composer.json` file to your project:

```javascript
{
  "require": {
      "paygate/payhost-helper": "1.0.2"
  }
}
```
Then provided you have [composer](http://getcomposer.org) installed, you can run the following command:
 
```bash
$ composer.phar install
```

That will fetch the library and its dependencies inside your vendor folder. Then you can add the following to your
.php files in order to use the library

```php
require_once __DIR__.'/vendor/autoload.php';
```

Then you need to `use` the relevant classes, for example:

```php
use PayGate\PayHost\Helper;
```

## Usage ##

We start by mapping all our front end html inputs to their respective sections in the PayHost wsdl:
```php
$inputMap = array();
```

The values in the array should be the html input names on the form, while the keys remain untouched as these are what the Helper class looks for.

For an example of the array contents, look at the `public $inputMap` property in `Helper.php`.

Initiate the `Helper` class, passing in the input map array:

```php
$Helper = new Helper($inputMap);
```
At the moment, all the sanitizing of the inputs received from the form is not being done by the helper.
One *could* use PHP's [filter_var_array](http://php.net/manual/en/function.filter-var-array.php) to create a new array containing the sanitized values.

We'll call this new array `$filteredPost` for now.

Then call `setWebPaymentRequestMessage` or `setCardPaymentRequestMessage` depending on your needs, and pass in the array created before:

```php
$SinglePaymentRequest = $Helper->setWebPaymentRequestMessage($filteredPost);
```

Once the request object has been built, create valid XML from it by calling:

```php
$xml = Helper::generateValidXmlFromObj($SinglePaymentRequest, 'SinglePaymentRequest');
```
We now have a valid XML to pass to PHP's [SoapClient](http://php.net/manual/en/soapclient.soapclient.php).

eg.
```php
$SoapClient = new SoapClient("https://www.secure.paygate.co.za/payhost/process.trans?wsdl", array('trace' => 1)); //point to WSDL and set trace value to debug
 
try {
    /*
     * Send SOAP request
     */
    $result = $SoapClient->__soapCall('SinglePayment', array(
        new SoapVar($xml, XSD_ANYXML)
    ));
} catch (SoapFault $sf){
    /*
     * handle errors
     */
    $err = $sf->getMessage();
}
```
