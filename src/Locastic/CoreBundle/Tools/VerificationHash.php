<?php

namespace Locastic\CoreBundle\Tools;

use Locastic\CoreBundle\Tools\Contracts\CacheInterface;
use Locastic\CoreBundle\Tools\Exceptions\VerificationHashException;

class VerificationHash
{
    private $cache;
    private $hash;
    private $cacheName = 'verification_hash';

    public function __construct(CacheInterface $cache) {
        $this->cache = $cache;

        if($this->cache->hasCache($this->cacheName) === false) {
            throw new VerificationHashException("Cache verifications_hash does not exist");
        }
    }

    public function hashExists($hash) {
        return $this->cache->valueExistsInCache($this->cacheName, $hash);
    }

    /* Recursive cache creation */
    public function createHash() {
        $hash = sha1(rand(100000, 1000000));

        if($this->hashExists($hash) === true) {
            $this->createHash();
        }

        $this->cache->writeValue($hash);

        $this->hash = $hash;

        $this->cache->cacheDone();

        return $this;
    }

    public function getHash() {
        return $this->hash;
    }
} 