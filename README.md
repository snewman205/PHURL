PHURL
=====

A delightful PHP library for shortening URLs.

Support for the following providers is baked in:

* Bit.ly (https://bit.ly)
* Goo.gl (https://goo.gl)
* Adf.ly (https://adf.ly)

No worries ... adding support for additional providers is simple!

Requirements
=====

* PHP >= 5.3
* libCurl

Usage
=====

First, you'll need to configure your individual API keys for the provider(s) you wish to utilize. See [this document](https://github.com/snewman205/PHURL/blob/master/CONFIGURE.md) for complete instructions.

When you're ready, begin shortening URLs in just three lines of code:

```
<?php

   require_once("lib/Phurl/Phurl.php");
   
   $phurl = new Phurl\Phurl("Bitly");
   
   echo $phurl->shorten("http://www.google.com/");
   
?>
```
