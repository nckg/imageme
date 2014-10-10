<?php namespace Nckg\ImageMe\Storage;

use Intervention\Image\Image;

class FileSystem implements StorageInterface
{
    /**
     * The directory in which to save
     *
     * @var string
     */
    protected $directory;

    /**
     * The filename to save
     *
     * @var string
     */
    protected $filename;

    /**
     * Constructor
     *
     * @param string $directory
     * @param string $filename
     */
    public function __construct($directory, $filename)
    {
        $this->directory = $directory;
        $this->filename = $filename;
    }

    /**
     * Store the image
     *
     * @param  Image  $image [description]
     * @return void
     */
    public function store(Image $image)
    {
        // We can use .htaccess to use that file instead of rerendering
        // the image
        if ( ! is_dir($this->directory)) {
            mkdir($this->directory);
        }

        $image->save($this->directory.DIRECTORY_SEPARATOR.$this->filename);
    }
}