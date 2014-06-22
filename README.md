PHURL
=====

<<<<<<< HEAD
A delightful PHP library for shortening URLs
=======
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

```
<?php

   require_once("lib/Phurl/Phurl.php");
   
   $phurl = new Phurl\Phurl("Bitly");
   
   echo $phurl->shorten("http://www.google.com/");
   
?>
```
>>>>>>> 932a4f0468b5995da71f38b4386d6b35b84cd1be
