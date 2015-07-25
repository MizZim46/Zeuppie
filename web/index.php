<?php
require_once __DIR__.'/../vendor/autoload.php';

const __URL__ = "http://localhost/Zeuppie/";

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text($app));
    return $twig;
}));


define("__SALTCRYPT__", "PezOEdkEx781Zopedl309dSK8sxn89eZ");

// Base de donnée
include "../query/sql.php";

// Controllers
include "../controllers/indexController.php";
include "../controllers/indexByCategoriesController.php";
include "../controllers/articlesViewController.php";

// Formulaire
include "../form/indexForm.php";
include "../form/registerForm.php";
include "../form/articleForm.php";

$app['asset_path'] = $app->share(function () {
    return __URL__.'views';
});

$app['index'] = $app->share(function () {
    return __URL__.'web/index.php/';
});


$app['debug'] = true;
$app->run();