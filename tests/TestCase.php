<?php

use org\bovigo\vfs\vfsStream;

abstract class TestCase extends \PHPUnit_Framework_TestCase {
    /**
     * @var  vfsStreamDirectory
     */
    protected $root;

    /**
     * Set up for each test
     */
    public function setUp()
    {
        // setup
        $this->root = vfsStream::setup('assets');

        // Copy directory structure from file system
        vfsStream::copyFromFileSystem(__DIR__ . '/assets');
    }
}