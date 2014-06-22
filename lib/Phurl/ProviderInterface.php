<?php

/*

Phurl Version: 0.1
By Scott Newman
Copyright (c) 2014

https://www.github.com/snewman205/phurl

*/

namespace Phurl\Providers;

interface ProviderInterface
{
   public function requestAuth();
   public function shorten($url, $domain, $opts);
   public function expand($url);
}