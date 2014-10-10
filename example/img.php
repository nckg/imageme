<?php

require '../vendor/autoload.php';

$parameters = filter_input_array(INPUT_GET);
$directory = 'assets';
$filename = 'happy-kitten.jpg';

$imageMe = new \Nckg\ImageMe\ImageMe;
$img = $imageMe->make($directory, $filename, $parameters);
echo $img->response();