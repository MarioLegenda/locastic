<?php

namespace Locastic\CoreBundle\Tools\Factories;


use Locastic\CoreBundle\Tools\Factories\Exceptions\DoctrineFactoryException;
use Locastic\CoreBundle\Tools\Factories\EntityFactory\ListFactory;

class DoctrineEntityFactory
{
    private static $instance;

    private $closures = array();
    private $entity;
    private $setValues;
    private $factory;

    private function __construct() {
        $this->closures['List'] = function() {
            return new ListFactory();
        };
    }

    public static function initiate($entity) {
        self::$instance = (self::$instance instanceof self) ? self::$instance : new self();

        if( ! array_key_exists($entity, self::$instance->closures)) {
            throw new DoctrineFactoryException('DoctrineEntityFactory: Entity ' . $entity . ' not found in factory');
        }

        self::$instance->factory = self::$instance->closures[$entity]->__invoke();

        return self::$instance;
    }

    public function with(array $data) {
        $this->setValues = $data;

        $this->factory->addConstructionData($this->setValues);

        return $this;
    }

    public function create() {
        return $this->factory->create();
    }
} 