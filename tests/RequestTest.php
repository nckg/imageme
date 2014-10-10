<?php

use Nckg\ImageMe\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    /**
     * Setup for each test
     */
    public function setUp()
    {
        $this->object = new Request;
    }

    /**
     * Test if it returns an image
     *
     * @return void
     */
    public function testCanParseSingleParameter()
    {
        // Arrange
        $parameters = 'w100';

        // Act
        $result = $this->object->parse($parameters);

        // Assert
        $this->assertInstanceOf('Illuminate\Support\Collection', $result);
        $this->assertInstanceOf('Nckg\ImageMe\Transformers\Resize', $result->first());
    }

    /**
     * Test if it returns an image
     *
     * @return void
     */
    public function testCanParseWidthAndHeightParameter()
    {
        // Arrange
        $parameters = 'w100-h100';

        // Act
        $result = $this->object->parse($parameters);

        // Assert
        $this->assertCount(1, $result);
        $this->assertInstanceOf('Illuminate\Support\Collection', $result);
        $this->assertInstanceOf('Nckg\ImageMe\Transformers\Resize', $result->first());
    }
}