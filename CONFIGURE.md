Configure
======

This document details the configuration steps for the three built-in providers.

Bit.ly
======

Visit https://bitly.com/a/oauth_apps to generate your API token. At the bottom of the page, you will see the following:

![Bit.ly API token generation](https://raw.githubusercontent.com/snewman205/PHURL/master/docs/images/bitly_token_gen.png "Bit.ly API token generation")

Click **Generate Token** to receive the generic token for your account. 

Finally, open *lib/Phurl/providers/Bitly.php* and insert your token near the top of the file:

```
static private $apiKey = '{YOUR_KEY_HERE}';
```

Goo.gl
======

Visit https://console.developers.google.com/ and create a project if necessary. Select your project, then select **APIs** under the **APIs and Auth** menu on the left.

![Goo.gl API token generation](https://raw.githubusercontent.com/snewman205/PHURL/master/docs/images/googl_api_console_1.png "Goo.gl API token generation")

Find **URL Shortener API** in the list and toggle it on (if necessary).

![Goo.gl API token generation](https://raw.githubusercontent.com/snewman205/PHURL/master/docs/images/googl_api_console_2.png "Goo.gl API token generation")

Next, select **Credentials** under the **APIs and Auth** menu on the left.

![Goo.gl API token generation](https://raw.githubusercontent.com/snewman205/PHURL/master/docs/images/googl_api_console_3.png "Goo.gl API token generation")

Under **Public API access**, select **Create new Key**.

![Goo.gl API token generation](https://raw.githubusercontent.com/snewman205/PHURL/master/docs/images/googl_api_console_4.png "Goo.gl API token generation")

Select **Browser Key**.

![Goo.gl API token generation](https://raw.githubusercontent.com/snewman205/PHURL/master/docs/images/googl_api_console_5.png "Goo.gl API token generation")

Finally, specified the allowed referrers for your key (eg. mydomain.com/*). You may leave this blank to allow any referrer (you can always edit this later).  

![Goo.gl API token generation](https://raw.githubusercontent.com/snewman205/PHURL/master/docs/images/googl_api_console_6.png "Goo.gl API token generation")

Click **Create** and you will be presented with your new API key. Open *lib/Phurl/providers/Google.php* and insert your token near the top of the file:

```
static private $apiKey = '{YOUR_KEY_HERE}';
```

Adf.ly
======

Visit https://adf.ly/publisher/tools#tools-api to view your API token and UID. You will see an example url that will include your API key and UID:

![Adf.ly API token generation](https://raw.githubusercontent.com/snewman205/PHURL/master/docs/images/adfly_token_gen.png "Adf.ly API token generation")

Open *lib/Phurl/providers/Adfly.php* and insert your API key and UID near the top of the file:

```
static private $apiKey = '{YOUR_KEY_HERE}';
static private $apiUid = '{YOUR_UID_HERE}';
```
