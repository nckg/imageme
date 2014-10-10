<?php

use Intervention\Image\Image;
use Nckg\ImageMe\Storage\FileSystem;
use org\bovigo\vfs\vfsStream;

class FileSystemTest extends TestCase
{

    /**
     *
     */
    public function testCanStoreToFileSystem()
    {
        // Arrange
        $directory = vfsStream::url('assets');
        $filename = 'happy-kitten.jpg';
        $params = 'w100';
        $storage = new FileSystem($directory.DIRECTORY_SEPARATOR.$params, $filename);
        $img = new Image(vfsStream::url('assets').DIRECTORY_SEPARATOR.$filename);

        // Act
        $storage->store($img);

        // Assert
        $this->assertTrue($this->root->hasChild('w100'));
        $this->assertTrue($this->root->getChild('w100')->hasChild('happy-kitten.jpg'));
    }
}