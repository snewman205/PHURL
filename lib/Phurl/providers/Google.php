<?php

/*

Phurl Version: 0.1
By Scott Newman
Copyright (c) 2014

https://www.github.com/snewman205/phurl

*/

namespace Phurl\Providers;

class Google extends \Phurl\Providers\Provider
{
   static public $name = 'Goo.gl';
   static public $url = 'https://goo.gl';
   static public $description = 'Google URL Shortener';
   
   static private $apiRootUrl = 'https://www.googleapis.com/urlshortener/v1';
   static private $apiKey = '';
   
   static protected $availableDomains = array('goo.gl');
   static protected $defaultDomain = 'goo.gl';
	
   function __construct()
   {
   }

   public function requestAuth()
   {
      return self::$apiKey;
   }
   
   public function shorten($url, $domain=NULL, $opts=NULL)
   {
      if($domain === NULL)
      {
         $domain = self::$defaultDomain;
      }
      elseif(!in_array($domain, self::$availableDomains))
      {
         error_log('[' . get_class() . '] WARNING - Domain `' . $domain . '` is not available; reverting to default `' . self::$defaultDomain . '`.');
            
         $domain = self::$defaultDomain;
      }
      
      $apiResp = json_decode(\Phurl\HttpClient::post(self::$apiRootUrl . '/url', array('longUrl' => $url), NULL, TRUE), TRUE);
      
      if(isset($apiResp['error']))
      {
         error_log('[' . get_class() . '] HTTP Error (' . $apiResp['error']['code'] . ') - ' . ((isset($apiResp['error']['errors'][0]['locationType']) ? $apiResp['error']['errors'][0]['locationType'] . ' ' : '')) . $apiResp['error']['message']);
         return FALSE;
      }
      else
      {
         return $apiResp['id'];
      }
   }
   
   public function expand($url)
   {
      $apiResp = json_decode(\Phurl\HttpClient::get(self::$apiRootUrl . '/url', array('shortUrl' => $url, 'key' => self::$apiKey)), TRUE);
      
      if(isset($apiResp['error']))
      {
         error_log('[' . get_class() . '] HTTP Error (' . $apiResp['error']['code'] . ') - ' . ((isset($apiResp['error']['errors'][0]['locationType']) ? $apiResp['error']['errors'][0]['locationType'] . ' ' : '')) . $apiResp['error']['message']);
         return FALSE;
      }
      else
      {
         return $apiResp['longUrl'];
      }
   }
}