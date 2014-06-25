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

Specifying a provider to load by default is **not required**.  If you don't specify a default provider, you will need to load it separately as below:

```
<?php

   require_once("lib/Phurl/Phurl.php");
   
   $phurl = new Phurl\Phurl();
   
   $phurl->loadProvider("Bitly");
   
   echo $phurl->shorten("http://www.google.com/");
   
?>
```

In either case, the name should match the corresponding file in the *providers* directory (with or without the .php extension) **OR** should be a fully-qualified namespaced path (eg. \Phurl\Providers\Bitly).

**Available Providers**

```
$phurl->availableProviders();
```

This will return a list of fully-qualified namespaced paths that can be passed to loadProvider().  Displaying a user-friendly list of names would look something like this:

```
<?php

   require_once("lib/Phurl/Phurl.php");
   
   $phurl = new Phurl\Phurl();
   
   foreach($phurl->availableProviders() as $provider)
   {
      echo $provider::$name;
   }
   
?>
```

Optionally, you may request information for a presently loaded provider:

```
<?php

   require_once("lib/Phurl/Phurl.php");
   
   $phurl = new Phurl\Phurl("Bitly");
   
   $info = $phurl->currentProvider();
   
?>
```

Which will produce an associative array:

```
Array ( [name] => Bit.ly [description] => Bitly. The power of the link. [url] => https://bit.ly/ ) 
```

**Available Domains**

Some providers offer multiple domains to choose from for your new URL.  To view available domains for a loaded provider:

```
<?php

   require_once("lib/Phurl/Phurl.php");
   
   $phurl = new Phurl\Phurl("Bitly");
   
   $info = $phurl->availableDomains();
   
?>
```

Which will produce an associative array:

```
Array ( [0] => bit.ly [1] => j.mp [2] => bitly.com ) 
```

Additional documentation forthcoming...
