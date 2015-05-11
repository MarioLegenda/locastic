<?php

namespace Locastic\CoreBundle\Tools;
use Locastic\CoreBundle\Tools\Contracts\CacheInterface;
use Locastic\CoreBundle\Tools\Contracts\FileGeneratorInterface;

/**
 Checks if the value exists in the provided cache.

 */

class Cache implements CacheInterface
{
    private $caches;
    private $file;

    public function __construct(array $caches, FileGeneratorInterface $file) {
        $this->caches = $caches;
        $this->file = $file;
    }

    /**
     * @param $cacheName
     * @param bool $returnCache
     * @return bool
     *
     * Checks if the cache exists. If $returnCache is provided, the desired cache is returned if exists. Otherwise, bool is returned
     */
    public function hasCache($cacheName, $returnCache = false) {
        foreach($this->caches as $cache) {
            if(array_key_exists($cacheName, $cache)) {
                return ($returnCache === true) ? $cache : true;
            }
        }

        return false;
    }

    public function getCache($cacheName) {
        $cache = $this->hasCache($cacheName, true);
        if( $cache === false) {
            return null;
        }

        return __DIR__ . '/' . $cache[$cacheName][0];
    }

    /**
     * @param $cacheName
     * @param $value
     * @return bool
     * @throws Exceptions\FileException
     *
     * Lookups the File if the desired row in the cache exists.
     *
     * WARNING: File uses generators
     */
    public function valueExistsInCache($cacheName, $value) {
        $this->file->createFile($this->getCache($cacheName));

        while($this->file->valid()) {
            $generator = $this->file->nextRow();

            if(strcasecmp($value, $generator->current()) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $value
     *
     * Writes value to the cache
     */
    public function writeValue($value) {
        $this->file->write($value);
    }

    public function cacheDone() {
        $this->file->closeFile();
    }
} 