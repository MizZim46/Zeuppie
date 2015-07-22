<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Doctrine\DBAL\Connection;

$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());

$app->match('/', function (Request $request) use ($app) {

session_start();
  
      $form = $app['form.factory']->createBuilder('form')
        ->add('login', 'email')
        ->add('password', 'password')
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();


    include basename('/query/login.php');


        if ($LoginReponse) {
          $_SESSION['login'] = $LoginReponse['email'];
          $Users = $_SESSION['login'];
        }
        else {
          $erreur = true;
        }

        if ($erreur != true) {
          return $app->redirect('index');
        }
        else {
          return $app->redirect('/');
        }
    }

if (!isset($_SESSION['login'])) {
    return $app['twig']->render('login.twig', array('form' => $form->createView(), 'users' => $_SESSION['login']));
}
else {
      return $app->redirect('index');
}
});