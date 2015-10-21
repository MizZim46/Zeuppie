<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

const __URL__ = "http://localhost:9080/Zeuppie/";

define("__SALTCRYPT__", "PezOEdkEx781Zopedl309dSK8sxn89eZ");

require __DIR__.'/../app/config/dev.php';
require __DIR__.'/../app/app.php';
require __DIR__.'/../app/routes.php';

$app['asset_path'] = $app->share(function () {
    return __URL__.'views';
});

$app['index'] = $app->share(function () {
    return __URL__.'web/index.php/';
});

$app->run();