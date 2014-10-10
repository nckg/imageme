<?php namespace Nckg\ImageMe;

use Intervention\Image\Image;
use Nckg\ImageMe\Storage\StorageInterface;

class ImageMe
{
    /**
     * An array of Cache/CacheInterface
     *
     * @var array
     */
    protected $storage = array();

    /**
     * Add a storage interface
     * @param StorageInterface $storage [description]
     * @return $this
     */
    public function addStorage(StorageInterface $storage)
    {
        $this->storage[] = $storage;

        return $this;
    }

    /**
     * Create a new instance of Intervention\Image\Image. This image
     * will have all the transformations applied to.
     *
     * @param  string $directory The directory of the image
     * @param  string $filename The image wil resize itself base on this value
     * @param  mixed $parameters The image wil resize itself base on this value
     * @return \Intervention\Image\Image
     */
    public function make($directory, $filename, $parameters)
    {
        // create image
        $image = new Image($directory.DIRECTORY_SEPARATOR.$filename);

        // Parse all the parameters from the parameters variable
        // Parameters can be an array or a string:
        // eg: w100-h100
        $request = new Request;
        $manipulators = $request->parse($parameters);

        // Apply the transformations to the image
        foreach ($manipulators as $class) {
            $class->transform($image);
        }

        // store
        $this->store($image);

        // return the image
        return $image;
    }

    /**
     * Loop through different storage and cache it
     *
     * @param  Image  $image
     * @return void
     */
    private function store(Image $image)
    {
        if ( ! empty($this->storage)) {
            foreach ($this->storage as $storage) {
                $storage->store($image);
            }
        }
    }
}