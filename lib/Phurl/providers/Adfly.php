<?php

/*

Phurl Version: 0.1
By Scott Newman
Copyright (c) 2014

https://www.github.com/snewman205/phurl

*/

namespace Phurl\Providers;

class Adfly extends \Phurl\Providers\Provider
{
   static public $name = 'Adf.ly';
   static public $url = 'https://adf.ly/';
   static public $description = 'AdFly - The URL shortener service that pays you!';
   
   static private $apiRootUrl = 'http://api.adf.ly';
   static private $apiKey = '';
   static private $apiUid = '';
   
   static protected $availableDomains = array('adf.ly', 'q.gs');
   static protected $defaultDomain = 'adf.ly';
	
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
      
      $params = array('key' => self::$apiKey, 'uid' => self::$apiUid, 'url' => $url, 'domain' => $domain);
      
      if(!($opts === NULL) && gettype($opts) == 'array')
      {
         $params = array_merge($params, $opts);
      }
      
      $apiResp = \Phurl\HttpClient::get(self::$apiRootUrl . '/api.php', $params);
      $decodedResp = json_decode($apiResp, TRUE);
      
      if(isset($decodedResp))
      {
         error_log('[' . get_class() . '] HTTP Error - ' . $decodedResp['errors'][0]['msg']);
         return FALSE;
      }
      else
      {
         return $apiResp;
      }
   }
   
   public function expand($url)
   {
      return $url;
   }
}