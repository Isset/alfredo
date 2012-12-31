PDF
===

The pdf converter converts data into a pdf
In this chapter the Alfredo\Payload\Pdf\Convert class will be explained

Default code for making a pdf convert object:

	$convert = new Alfredo\Payload\Pdf\Convert();

Settings
-------
**converter**

Converter is used as the default converter for all the data that is attached to the convert object
You can set this option with the following code:

	$convert->setConverter(<converter>)

available converts for pdf

- wkhtmltopdf
- htmltopdfjava *default*

When using the htmltopdfjava converter you will need valid html


**packer**

A packer is used to paste multiple pdfs together. This is need if you send more then 1 data part

- pdftk *default*


Adding Data
-----------
You can add 3 kind of data to a converter object 

- Html
- PDF
- URL

**Html**

You can add html to convert using the ->addHtml() method

	$convert->addHtml('<html><thead></thead><tbody>test</tbody></html>');

**Pdf**

You can add an pdf using ->addPdf() method. This will by default encode is to base64
	
	$convert->addPdf(file_get_contents('test.pdf'));

**Url**

You can add an url using the ->addUrl() methods. The url needs to be reachable for the convert server.

	$convert->addUrl('http://isset.nl/nl/home');
	
**Callback**

Callback is only needed if you queue an convert object. The callback is an url and need to return [success] as body.
	
	$convert->setCallback('http://test.test/callback');
	

**Note**

All these methods can be chained to for file convert

	$convert
			->addHtml('<html><thead></thead><tbody>test</tbody></html>')
			->addPdf(file_get_contents('test.pdf'))
			->addUrl('http://isset.nl/nl/home')
			->setCallback('http://test.test/callback');
Examples
--------

Examples for pdf are available in /Example/Pdf/

Pitfalls
________

All entities have to be htmlentities(and be converted in the api) or utf encoded.
For example converting will fail if  & is used instead of &amp; or the utf8 equivalent 







