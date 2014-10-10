<?php

use Nckg\ImageMe\ImageMe;
use Nckg\ImageMe\Storage\FileSystem;
use org\bovigo\vfs\vfsStream;

class ImageMeTest extends TestCase
{
    protected $object;

    /**
     * Setup for each test
     */
    public function setUp()
    {
        parent::setUp();

        $this->object = new ImageMe;
    }

    /**
     * Test if it returns an image
     *
     * @return void
     */
    public function testMakeReturnsImage()
    {
        // Arrange
        $directory = vfsStream::url('assets');
        $filename = 'happy-kitten.jpg';

        // Act

        // Assert
        $this->assertInstanceOf(
            'Intervention\Image\Image',
            $this->object->make($directory, $filename, 'w100')
        );
    }

    /**
     * Test if an image is created
     *
     * @return void
     */
    public function testCanAddStorageClass()
    {
        // Arrange
        $directory = vfsStream::url('assets');
        $filename = 'happy-kitten.jpg';
        $params = 'w100';
        $storage = new FileSystem($directory.DIRECTORY_SEPARATOR.$params, $filename);

        // Act
        $this->object->addStorage($storage);
        $this->object->make($directory, $filename, $params);

        // Assert
        $this->assertTrue($this->root->hasChild('w100'));
        $this->assertTrue($this->root->getChild('w100')->hasChild('happy-kitten.jpg'));
    }

    /**
     * Test if it returns an image
     *
     * @return void
     */
    public function testMakeTransformsImage()
    {
        // Arrange
        $directory = vfsStream::url('assets');
        $filename = 'happy-kitten.jpg';
        $params = 'w100-h100';

        // Act
        $result = $this->object->make($directory, $filename, $params);

        // Assert
        $this->assertInstanceOf('Intervention\Image\Image', $result);
        $this->assertEquals(100, $result->width);
        $this->assertEquals(100, $result->height);
    }
}