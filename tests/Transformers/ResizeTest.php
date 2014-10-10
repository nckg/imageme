<?php

use Intervention\Image\Image;
use Nckg\ImageMe\Transformers\Resize;
use org\bovigo\vfs\vfsStream;

class ResizeTest extends TestCase
{
    protected $object;

    public function testTransformReturnsImage()
    {
        // Arrange
        $img = new Image;
        $resize = new Resize;

        // Act
        $result = $resize->transform($img);

        // Assert
        $this->assertInstanceOf('Intervention\Image\Image', $result);
    }

    public function testTransformOnlyWidthKeepsRatio()
    {
        // Arrange
        $filename = vfsStream::url('assets/happy-kitten.jpg');
        $img = new Image($filename);
        $realHeight = $img->height;
        $resize = new Resize;

        // Act
        $resize->setWidth(100);
        $result = $resize->transform($img);

        // Assert
        $this->assertEquals(100, $result->width);
        $this->assertLessThan($realHeight, $result->height);
    }

    public function testTransformOnlyHeightKeepsRatio()
    {
        // Arrange
        $filename = vfsStream::url('assets/happy-kitten.jpg');
        $img = new Image($filename);
        $realWidth = $img->width;
        $resize = new Resize;

        // Act
        $resize->setHeight(100);
        $result = $resize->transform($img);

        // Assert
        $this->assertEquals(100, $result->height);
        $this->assertLessThan($realWidth, $result->width);
    }

    public function testTransformBothLosesRatio()
    {
        // Arrange
        $filename = vfsStream::url('assets/happy-kitten.jpg');
        $img = new Image($filename);
        $resize = new Resize;

        // Act
        $resize->setHeight(100);
        $resize->setWidth(100);
        $result = $resize->transform($img);

        // Assert
        $this->assertEquals(100, $result->height);
        $this->assertEquals(100, $result->width);
    }


}