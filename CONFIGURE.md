Configure
======

This document details the configuration steps for the three built-in providers.

Bit.ly
======

Visit https://bitly.com/a/oauth_apps to generate your API token. At the bottom of the page, you will see the following:

![alt text](https://github.com/snewman205/PHURL/docs/images/bitly_token_gen.png "Bit.ly API token generation")

Click **Generate Token** to receive the generic token for your account. 

Finally, open *lib/Phurl/providers/Bitly.php* and insert your token near the top of the file:

```
static private $apiKey = '{YOUR_KEY_HERE}';
```
