<?php

/*

Phurl Version: 0.1
By Scott Newman
Copyright (c) 2014

https://www.github.com/snewman205/phurl

*/

namespace Phurl;

require_once(__DIR__ . '/HttpClient.php');
require_once(__DIR__ . '/ProviderInterface.php');
require_once(__DIR__ . '/Provider.php');

class Phurl
{
   private $providers = array();
   private $providerInstance = NULL;
	
   /**
   * Initializer
   *
   * @param   String   $initProvider   Provider to load - may be passed as class file name with or without .php extension 
   *                                   or fully qualified namespace path (eg. \Phurl\Providers\Google).  (Optional)
   */
   function __construct($initProvider=NULL)
   {
      $providersToVerify = array();

      // Load all known providers
      $providers = glob(__DIR__ . '/providers/*.php');

      $providersToVerify = array_merge($providersToVerify, $providers);

      // Check for validity
      foreach($providersToVerify as $provider)
      {		
         require_once(__DIR__ . '/providers/' . basename($provider));

         $nsClassName = '\\Phurl\\Providers\\' . basename($provider, '.php');
         $implements = class_implements($nsClassName);

	 // Provider shall only be considered valid if it extends the base Provider class (and therefore implements the ProviderInterface)
         if ($implements && in_array('Phurl\Providers\ProviderInterface', $implements))			
         {
            array_push($this->providers, $nsClassName);
         }
         else
         {
            error_log('[' . get_class() . '] ERROR - `' . $provider . '` is not a valid provider.');
            continue;
         }
      }

      // Load specified provider (if provided)
      if(!($initProvider === NULL) && gettype($initProvider) == 'string')
      {
         $this->loadProvider($initProvider);
      }
   }

   // Return an array of valid and loaded providers
   public function availableProviders()
   {
      return $this->providers;
   }
   
   // Return an array of available domains from the currently loaded provider
   public function availableDomains()
   {
      if($this->providerInstance)
      {
         return $this->providerInstance->availableDomains();
      }
      else
      {
         error_log('[' . get_class() . '] ERROR - Unable to retrieve available domains; no provider currently loaded.');
         return FALSE;
      }
   }
        
   // Load provider
   public function loadProvider($provider)
   {        
      if(!empty($this->providerInstance))
      {
         $nsPartsLoaded = explode('\\', get_class($this->providerInstance));
         
         if(strpos($provider, '\\') !== FALSE)
         {
            $nsPartsAttempted = explode('\\', get_class($this->providerInstance));
         }
         
         error_log('[' . get_class() . '] ERROR - Unable to load provider `' . (isset($nsPartsAttempted) ? end($nsPartsAttempted) : $provider) . '`; Provider `' . end($nsPartsLoaded) . '` currently loaded.');
         return FALSE;
      }
      else
      {
         if(strpos($provider, '\\') !== false)
         {
            $providerPath = $provider;
         }
         else
         {
            $providerPath = '\\Phurl\\Providers\\' . basename($provider, '.php');
         }
         
         if(in_array($providerPath, $this->providers))
         {            
            $this->providerInstance = new $providerPath();
         }
         else
         {
            error_log('[' . get_class() . '] ERROR - Unable to load provider `' . $provider . '`.');
            return FALSE;
         }
      }
   }
   
   // Return an array of info for the currently loaded provider
   public function currentProvider()
   {
      if($this->providerInstance)
      {
         $providerInstance = $this->providerInstance;
         
         return array('name' => $providerInstance::$name, 'description' => $providerInstance::$description, 'url' => $providerInstance::$url);
      }
      else
      {
         error_log('[' . get_class() . '] ERROR - Unable to retrieve provider info; no provider currently loaded.');
         return FALSE;
      }
   }
   
   // Request auth token from provider
   private function requestAuth()
   {      
      if($this->providerInstance)
      {
         return $this->providerInstance->requestAuth();
      }
      else
      {
         error_log('[' . get_class() . '] ERROR - Unable to request authorization; no provider has been loaded.');
         return FALSE;
      }
   }
   
   // Shorten URL
   public function shorten($url, $domain=NULL, $opts=NULL)
   {
      if($this->providerInstance)
      {
         return $this->providerInstance->shorten($url, $domain, $opts);
      }
      else
      {
         error_log('[' . get_class() . '] ERROR - Unable to shorten; no provider has been loaded.');
         return FALSE;
      }
   }
   
   // Expand URL
   public function expand($url)
   {
      if($this->providerInstance)
      {
         return $this->providerInstance->expand($url);
      }
      else
      {
         error_log('[' . get_class() . '] ERROR - Unable to expand; no provider has been loaded.');
         return FALSE;
      }
   }
   
   // Clear / reset the provider
   public function reset()
   {
      if($this->providerInstance)
      {
         $this->providerInstance = NULL;
 
         return TRUE;
      }
      else
      {
         error_log('[' . get_class() . '] ERROR - Unable to reset; no provider currently loaded.');
         return FALSE;
      }
   }
   
}