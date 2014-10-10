<?php namespace Nckg\ImageMe\Transformers;

use Intervention\Image\Image;

class Resize implements TransformerInterface
{

    /**
     * Maximum width for resized image, in pixels
     *
     * @var integer
     */
    protected $width = null;

    /**
     * Maximum height for resized image, in pixels
     *
     * @var integer
     */
    protected $height = null;

    /**
     * Set the width of the request
     *
     * @param integer $value
     */
    public function setWidth($value)
    {
        $this->width = (int) $value;

        if ($this->width < 1) {
            throw new \RuntimeException('Width must be greater than 0: ' . $this->width);
        }
    }

    /**
     * Set the height of the request
     *
     * @param integer $value
     */
    public function setHeight($value)
    {
        $this->height = (int) $value;

        if ($this->height < 1) {
            throw new \RuntimeException('Height must be greater than 0: ' . $this->height);
        }
    }

    /**
     * Transform the image
     *
     * @param Image $image
     * @return Image
     */
    public function transform(Image $image)
    {
        if ($this->width and $this->height) {
            $image->grab($this->width, $this->height);
        } elseif ($this->width or $this->height) {
            $image->resize($this->width, $this->height, true, false);
        }

        return $image;
    }
}