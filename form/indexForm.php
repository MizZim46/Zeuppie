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
        ->add('login', 'email', array('attr' => array('placeholder' => 'Email OU Pseudo')))
        ->add('password', 'password', array('attr' => array('placeholder' => 'Mot de passe')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();


    include '../query/login.php';


        if ($LoginReponse) {
          
          $_SESSION['login'] = $LoginReponse['login'];
          $Users = $_SESSION['login'];
        }
        else {
          $erreur = true;
        }

        if ($erreur != true) {
          return $app->redirect('accueil');
        }
        else {
          return $app->redirect('inscription');
        }
    }

if (!isset($_SESSION['login'])) {
    return $app['twig']->render('login.twig', array('form' => $form->createView()));
}
else {
      return $app->redirect('accueil');
}
});