<?php
require_once __DIR__.'/../vendor/autoload.php';

const __URL__ = "http://localhost/Zeuppie/";

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));


include "../query/sql.php";
include "../form/indexForm.php";

$app['asset_path'] = $app->share(function () {
    return __URL__.'views';
});

$app['index'] = $app->share(function () {
    return __URL__.'web/index.php/';
});

$app['debug'] = true;
$app->run();