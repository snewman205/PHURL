<?php

/*

Phurl Version: 0.1
By Scott Newman
Copyright (c) 2014

https://www.github.com/snewman205/phurl

*/

namespace Phurl;

class HttpClient
{
   /**
   * Sets global options for all cURL requests
   *
   * @param   cURL Instance   $ch   A cURL instance
   */ 
   private static function setGlobalOpts($ch)
   {
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   }      
      
   /**
   * Builds and executes an HTTP POST request
   *
   * @param   String   $url        A unformatted, unencoded URL (it will be encoded here)
   * @param   Array    $params     An associative array of parameters to POST
   * @param   Array    $headers    An array of headers to include in the request (eg. array('Content-type: application/json'))
   * @param   Boolean  $jsonEncode A boolean indicating whether the parameteters should be JSON encoded or not
   * @return  String   Returns output from the request
   */  
   public static function post($url, $params=array(), $headers=array(), $jsonEncode=FALSE)
   {  
      $ch = curl_init();
      
      self::setGlobalOpts($ch);
      
      curl_setopt($ch, CURLOPT_POST, 'TRUE');
      curl_setopt($ch, CURLOPT_URL, $url);
            
      if(gettype($params) == 'array' && count($params) > 0)
      {
         curl_setopt($ch, CURLOPT_POSTFIELDS, (($jsonEncode) ? json_encode($params) : http_build_query($params)));
      }
      
      if(gettype($headers) == 'array' && count($headers) > 0)
      {
         if($jsonEncode)
         {
            $headers = array_merge($headers, array('Content-Type: application/json'));
         }
         
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      }
      elseif($jsonEncode)
      {
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      }
      
      $output = curl_exec($ch);
      
      if(curl_errno($ch))
      {
         error_log('[' . get_class() . '] ERROR - ' . curl_error($ch));
      }
      
      curl_close($ch);
      
      return $output;
   }
   
   /**
   * Builds and executes an HTTP GET request
   *
   * @param   String   $url        A unformatted, unencoded URL (it will be encoded here)
   * @param   Array    $params     An associative array of parameters to include in the request as a query string
   * @param   Array    $headers    An array of headers to include in the request (eg. array('Content-type: application/json'))
   * @return  String   Returns output from the request
   */ 
   public static function get($url, $params=array(), $headers=array())
   {  
      $ch = curl_init();
      
      self::setGlobalOpts($ch);
      
      if(gettype($params) == 'array' && count($params) > 0)
      {
         $url .= '?' . http_build_query($params);
      }
      
      curl_setopt($ch, CURLOPT_URL, $url);
      
      if(gettype($headers) == 'array' && count($headers) > 0)
      {
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      }
      
      curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
      
      $output = curl_exec($ch);
      
      if(curl_errno($ch))
      {
         error_log('[' . get_class() . '] ERROR - ' . curl_error($ch));
      }
      
      curl_close($ch);
      
      return $output;
   }
}