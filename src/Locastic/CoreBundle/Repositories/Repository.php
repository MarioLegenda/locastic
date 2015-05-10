<?php

namespace Locastic\CoreBundle\Repositories;


abstract class Repository
{
    protected $doctrine;
    protected $manager;

    public function __construct($doctrine) {
        $this->doctrine = $doctrine;
        $this->manager = $doctrine->getManager();
    }
} 