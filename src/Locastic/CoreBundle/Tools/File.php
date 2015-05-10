<?php

namespace Locastic\CoreBundle\Tools;


use Locastic\CoreBundle\Tools\Exceptions\FileException;

class File
{
    private $handle = null;

    public function createFile($path) {
        if( ! is_readable($path)) {
            throw new FileException('File with path ' . $path . 'is not readable or does not exits');
        }

        if($this->handle !== null) {
            throw new FileException("File is already open");
        }

        $this->handle = fopen($path, 'a+');

        return $this;
    }

    public function getFile() {
        return $this->handle;
    }

    public function closeFile() {
        if($this->handle !== null) {
            fclose($this->handle);
        }

        return $this;
    }

    public function valid() {
        return fgets($this->handle);
    }

    public function nextRow() {
        while(($buffer = fgets($this->handle)) !== false) {
            yield $buffer;
        }

        yield null;
    }
} 