<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text($app));
    return $twig;
}));


$app->register(new Silex\Provider\UrlGeneratorServiceProvider());


// Register services.
$app['dao.article'] = $app->share(function ($app) {
    return new Pipress\DAO\ArticleDAO($app['db']);
});
$app['dao.categorie'] = $app->share(function ($app) {
    return new Pipress\DAO\CategorieDAO($app['db']);
});
$app['dao.notification'] = $app->share(function ($app) {
    return new Pipress\DAO\NotificationDAO($app['db']);
});
$app['dao.utilisateur'] = $app->share(function ($app) {
    return new Pipress\DAO\UtilisateurDAO($app['db']);
});
$app['dao.commentaire'] = $app->share(function ($app) {
    $commentDAO = new Pipress\DAO\CommentaireDAO($app['db']);
    $commentDAO->setArticleDAO($app['dao.article']);
    return $commentDAO;
});