<?php

/*

Phurl Version: 0.1
By Scott Newman
Copyright (c) 2014

https://www.github.com/snewman205/phurl

*/

namespace Phurl\Providers;

class Bitly extends \Phurl\Providers\Provider
{
   static public $name = 'Bit.ly';
   static public $url = 'https://bit.ly/';
   static public $description = 'Bitly. The power of the link.';
   
   static private $apiRootUrl = 'https://api-ssl.bitly.com/v3';
   static private $apiKey = '';
   
   static protected $availableDomains = array('bit.ly', 'j.mp', 'bitly.com');
   static protected $defaultDomain = 'bit.ly';
	
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
      
      $apiResp = json_decode(\Phurl\HttpClient::get(self::$apiRootUrl . '/shorten', array('access_token' => self::$apiKey, 'longUrl' => $url, 'domain' => $domain)), TRUE);
      
      if($apiResp['status_code'] != 200)
      {
         error_log('[' . get_class() . '] HTTP Error (' . $apiResp['status_code'] . ') - ' . $apiResp['status_txt']);
         return FALSE;
      }
      else
      {
         return $apiResp['data']['url'];
      }
   }
   
   public function expand($url)
   {
      $apiResp = json_decode(\Phurl\HttpClient::get(self::$apiRootUrl . '/expand', array('access_token' => self::$apiKey, 'shortUrl' => $url)), TRUE);
      
      if($apiResp['status_code'] != 200)
      {
         error_log('[' . get_class() . '] HTTP Error (' . $apiResp['status_code'] . ') - ' . $apiResp['status_txt']);
         return FALSE;
      }
      else
      {
         return $apiResp['data']['expand'][0]['long_url'];
      }
   }
}