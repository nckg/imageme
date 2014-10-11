# Image Me
![Travis CI](https://travis-ci.org/nckg/imageme.svg?branch=master)
[![Latest Stable Version](https://poser.pugx.org/nckg/imageme/v/stable.svg)](https://packagist.org/packages/nckg/imageme)

## Installation
Simply add a dependency on `nckg/imageme` to your project's composer.json file if you use Composer to manage the dependencies of your project.

```
{
    "require-dev": {
        "nckg/imageme": "dev-master"
    }
}
```

## Usage

This is an example for Laravel.

```php
Route::get('/my_image_path/{modifiers}/{src}', function($modifiers, $src)
{
    $directory = Config::get('upload.display_path');
    $image = new \Nckg\ImageMe\ImageMe;
    $image->make($directory, $src, $modifiers);
    return $image->response();
})
    ->where('modifiers', '^((w|h)\d+(\-?))+$')
    ->where('src', '.*\.(?:jpg|gif|png|jpeg)$');
```

## Development

Use terminal to go inside the `example` directory. Once inside the directory fire up the built-in web server with `php -S 0.0.0.0:1337`. Use your browser to navigate to `http::0.0.0.0:1337`.

### License

[MIT license](http://opensource.org/licenses/MIT)
