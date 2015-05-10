<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 10.5.2015.
 * Time: 17:46
 */

namespace Locastic\CoreBundle\Tools;


class Cache
{
    private $caches;
    private $file;

    public function __construct(array $caches, File $file) {
        $this->caches = $caches;
        $this->file = $file;
    }

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

    public function valueExistsInCache($cacheName, $value) {
        $this->file->createFile($this->getCache($cacheName));

        while($this->file->valid()) {
            $row = $this->file->nextRow();

            if(strcasecmp($value, $row) === 0) {
                return true;
            }
        }

        return false;
    }

    public function cacheDone() {
        $this->file->closeFile();
    }
} 