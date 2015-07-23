<?php
require_once __DIR__.'/../vendor/autoload.php';

const __URL__ = "http://localhost/Zeuppie/";

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

define("__SALTCRYPT__", "PezOEdkEx781Zopedl309dSK8sxn89eZ");

include "../query/sql.php";
include "../form/indexForm.php";
include "../form/registerForm.php";

$app['asset_path'] = $app->share(function () {
    return __URL__.'views';
});

$app['index'] = $app->share(function () {
    return __URL__.'web/index.php/';
});

$app['debug'] = true;
$app->run();