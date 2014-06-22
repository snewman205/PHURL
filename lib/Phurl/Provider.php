<?php

/*

Phurl Version: 0.1
By Scott Newman
Copyright (c) 2014

https://www.github.com/snewman205/phurl

*/

namespace Phurl\Providers;

class Provider implements \Phurl\Providers\ProviderInterface
{
   /* Provider name */
   static public $name;

   /* Provider URL */
   static public $url;

   /* Provider descriptiion */
   static public $description;
   
   /* Provider API root URL */
   static private $apiRootUrl;

   /* Provider API key (optional) */
   static private $apiKey;
   
   /* Available domains for provider */
   static protected $availableDomains;
   
   /* Default domain for provider */
   static protected $defaultDomain;
   
   /* Requests authentication token */
   public function requestAuth() {}
   
   /* Shorten the URL using the provided $domain (uses default if none provided) and $opts */
   public function shorten($url, $domain, $opts) {}
   
   /* Expands a given short URL */
   public function expand($url) {}
   
   /* Returns array of available domains for a given provider */
   public function availableDomains()
   {
      return static::$availableDomains;
   }
}