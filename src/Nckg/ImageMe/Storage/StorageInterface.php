<?php namespace Nckg\ImageMe\Storage;

use Intervention\Image\Image;

interface StorageInterface
{
    /**
     * Store the image
     *
     * @param  Image  $image [description]
     * @return void
     */
    public function store(Image $image);
}