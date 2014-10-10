<?php
    $testArray = array(
        array('w=100'),
        array('h=100'),
        array('w=100', 'h=100'),
        array('w=300', 'h=100'),
        array('w=100', 'h=300'),
    );
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Testing</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

        <style type="text/css">
            .imagme-example {
                margin-left: 0;
                margin-right: 0;
                background-color: #fff;
                border-width: 1px;
                border-color: #ddd;
                border-radius: 4px;
                box-shadow: none;
                border-style: solid;
                margin-bottom: 20px;
            }

            .imagme-example > div {
                padding: 15px;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <?php foreach ($testArray as $test) : ?>
                <div class="row imagme-example">

                    <div class="col-md-6">
                        <img src="img.php?<?= implode('&', $test) ?>">
                    </div>

                    <div class="col-md-6">
                        <pre><?= print_r($test, true); ?></pre>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    </body>
</html>