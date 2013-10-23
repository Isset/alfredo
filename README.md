# Requirements
To take advantage of Online PDF Converter's API you'll need to install the client in your project and have access to our system. There are two keys need to access the API, a:

* Consumer key
* Private key

Without these you won't be able to connect to our servers. Next is the client. This installation process will be explained in the next chapter.

# Installation
At the moment the client library is not publicly available. Please contact us to obtain access to this library.
The client library needs to be installed through Composer. Click here if you've never used Composer. (http://getcomposer.org/doc/00-intro.md)

Add the following to your composer.json file in the "require" section:

```php
    "isset/alfredo": "1.*"
```

After you've added the requirement go to your terminal of choice and run the command:
If you've installed Composer on your machine:

```php
    composer update
```

Otherwise:

```php
    php composer.phar update
```

Online PDF Converter's API will now be installed and added to Composer's autoloader.

# Create Payload
The conversion of a PDF is done through a payload, which is send to the server. With our API it's possible to create a pdf from several different sources.
Currently the available sources: HTML, Pdf and Url.
These examples will show you how this it's done:

## Attach A Source

### Attach HTML
```php
    $payload = new Alfredo\Payload\Pdf\Convert;
    $payload->addhtml('<html><thead></thead><tbody>test</tbody></html>');
```

### Attach Pdf
```php
    $payload = new Alfredo\Payload\Pdf\Convert;
    $pdf = file_get_contents('path/to/pdf/file.pdf');
    $payload->addPdf($pdf);
```

### Attach Url
```php
    $payload = new Alfredo\Payload\Pdf\Convert;
    $payload->addUrl('http://online-pdfconverter.nl');
```

* Note: Currently our Url conversion is unstable. This is due to the fact that some web pages are not formatted correctly.

## Set Callback Url
A callback url is only needed when <a href="#queue-payload">working with queues</a>.
This url will be called with response of the conversion. It'll contain two items, named:

* Identifier
* Response

With the identifier it's possible to download the when it's converted.
Here's an example of how to set the callback:

```php
    $payload = new Alfredo\Payload\Pdf\Convert;
    $payload->setCallback('http://example.com/callback_url');
```

## Method chaining
All the above methods could be chained together:

```php
    $payload = new Alfredo\Payload\Pdf\Convert;
    $payload->addhtml('<html><thead></thead><tbody>test</tbody></html>')
            ->addPdf(file_get_contents('path/to/pdf/file.pdf'))
            ->addUrl('http://online-pdfconverter.nl');
            ->setCallback('http://example.com/callback-response');
```

## Change Converter Type
Our API is able to switch converter type which each payload. Available types:

* wkhtmltopdf
* htmltopdfjava (Default)

This is how you can change the type:

```php
    $payload = new Alfredo\Payload\Pdf\Convert;
    $payload->setConverter('wkhtmltoppdf');
```

# Stream Payload
There are multiple ways to execute conversion. Streaming is one of them.
When streaming you'll immediately get a response, but can't be stored by the server, only by the user.
For this conversion you'll be needing the consumer and private key.
Here is how you can stream a Pdf:

```php
    $payload = new Alfredo\Payload\Pdf\Convert;
    $payload->addhtml('<html><thead></thead><tbody>test</tbody></html>');
    $server = new Alfredo\Server('http://converter.isset.nl', 'consumer_key', 'private_key');

    try {
        $response = $server->stream($payload);
        header('Content-type: application/pdf');
        echo $response
    } catch (Alfredo\ConversionUnableException $e) {
        echo $e->getMessage();
    }
```

# Queue Payload
To queue a pdf conversion you'll need to set a callback url on the payload, this is explained a couple of chapters back.
After adding one or multiple sources and a callback url we'll pass the payload to our API.

```php
    $payload = new Alfredo\Payload\Pdf\Convert;
    $payload->addhtml('<html><thead></thead><tbody>test</tbody></html>');
    $payload->setCallback('http://example.com/callback_url');

    $server = new Alfredo\Server('http://converter.isset.nl', 'consumer_key', 'private_key');

    $response = $server->queue($payload);
```

The server will return a JSON string which contains an identifier and the response status.
It could be helpful to save the identifier somewhere in a database.
When the pdf has converted our server will send a POST request to the callback url with the same JSON string.
If the response status states the converion is completed you'll be able to request the pdf like this:

```php
    $server = new Alfredo\Server('http://converter.isset.nl', 'consumer_key', 'private_key');

    $payload = new Alfredo\Payload\Pdf\QueueItem;
    $payload->setIdentifier('xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

    $pdf = $server->getQueueItem($payload);
```

The response from the method getQueueItem() will be the converted pdf. You could stream it like explained in the chapter above this one.