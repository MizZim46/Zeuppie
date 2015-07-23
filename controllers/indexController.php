<?php
$app->get('/accueil', function () use ($app) {

include '../query/utilisateurs.php';

    return $app['twig']->render('index.twig', array('users' => $_SESSION['login'], 'infousers' => $utilisateursReponse));
});

