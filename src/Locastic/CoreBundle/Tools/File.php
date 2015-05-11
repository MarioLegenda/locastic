<?php

namespace Locastic\CoreBundle\Tools;

/**
 * File traversing object/generator. File::nextRow() returns the next row from fgets() with generators
 */

use Locastic\CoreBundle\Tools\Contracts\FileGeneratorInterface;
use Locastic\CoreBundle\Tools\Contracts\FileInterface;
use Locastic\CoreBundle\Tools\Exceptions\FileException;

class File implements FileInterface, FileGeneratorInterface
{
    private $handle = null;

    public function createFile($path) {
        if( ! is_readable($path)) {
            throw new FileException('File with path ' . $path . 'is not readable or does not exits');
        }

        if($this->handle !== null) {
            throw new FileException("File is already open");
        }

        /**
         * Opens with read/write permissions
         */
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

    /**
     * @return string
     *
     * Checks if has next row
     */
    public function valid() {
        return fgets($this->handle);
    }

    /**
     * Generator
     */
    public function nextRow() {
        while(($buffer = fgets($this->handle)) !== false) {
            yield $buffer;
        }

        yield null;
    }

    public function write($value) {
        fwrite($this->handle, $value . "\r\n");
    }
} 