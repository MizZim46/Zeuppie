<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Doctrine\DBAL\Connection;

$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());

$app->match('/inscription', function (Request $request) use ($app) {

session_start();

    $form = $app['form.factory']->createBuilder('form')
        ->add('login', 'email', array('attr' => array('placeholder' => 'Email')))
        ->add('password', 'password', array('attr' => array('placeholder' => 'Mot de passe')))
        ->add('confirmpassword', 'password', array('attr' => array('placeholder' => 'Confirmer mot de passe')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        include '../query/inscription.php';

      if (!$InscriptionReponse) {

        if ($data['confirmpassword'] == $data['password']) {

            $app['db']->insert('utilisateurs', array(
                  'email' => $data['login'],
                  'password' => crypt(htmlspecialchars($data['password']), '$2y$08$'.__SALTCRYPT__.'$'),
                  'status' => '1',
                  'date_inscription' => date('Y-m-d H:i:s')
                ));

            $_SESSION['login'] = $data['email'];
            
          return $app->redirect('accueil');

        }
      }
      else {
        return $app->redirect('inscription');
      }
    }

if (!isset($_SESSION['login'])) {
    return $app['twig']->render('inscription.twig', array('form' => $form->createView()));
}
else {
      return $app->redirect('../../accueil');
}

});