<?php

namespace Locastic\CoreBundle\Tools\Contracts;


interface CacheInterface
{
    function hasCache($cacheName, $returnCache = false);
    function getCache($cacheName);
    function valueExistsInCache($cacheName, $value);
    function writeValue($value);
    function cacheDone();
} 