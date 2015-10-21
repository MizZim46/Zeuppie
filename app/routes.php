<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;

$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());

// Login form
$app->match('/login', function (Request $request) use ($app) {

  session_start();


      $form = $app['form.factory']->createBuilder('form')
        ->add('login', 'email', array('attr' => array('placeholder' => 'Email OU Pseudo')))
        ->add('password', 'password', array('attr' => array('placeholder' => 'Mot de passe')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();


    $users = $app['dao.utilisateur']->login($data['login'], $data['password']);


        if ($users) {
          
          $_SESSION['login'] = $users->login;
          $Users = $_SESSION['login'];
          $erreur = false;
        }
        else {
          $erreur = true;
        }

        if ($erreur != true) {
          return $app->redirect('../');
        }
        else {
          return $app->redirect('inscription');
        }
    }

if (!isset($_SESSION['login'])) {
    return $app['twig']->render('login.html.twig', array('form' => $form->createView()));
}
else {
      return $app->redirect('../');
}
});



// Register

$app->match('/inscription', function (Request $request) use ($app) {

session_start();

    $form = $app['form.factory']->createBuilder('form')
        ->add('login', 'email', array('attr' => array('placeholder' => 'Email')))
        ->add('password', 'password', array('attr' => array('placeholder' => 'Mot de passe')))
        ->add('confirmpassword', 'password', array('attr' => array('placeholder' => 'Confirmer mot de passe')))
        ->add('pseudo', 'text', array('attr' => array('placeholder' => 'Pseudo')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

    $users = $app['dao.utilisateur']->register($data['login']);

        if (!$users) {

        if ($data['confirmpassword'] == $data['password']) {

            $app['db']->insert('utilisateurs', array(
                  'login' => htmlspecialchars($data['login']),
                  'password' => crypt(htmlspecialchars($data['password']), '$2y$08$'.__SALTCRYPT__.'$'),
                  'pseudo' => htmlspecialchars($data['pseudo']),
                  'status' => '1',
                  'date_inscription' => date('Y-m-d H:i:s')
                ));

            $_SESSION['login'] = $data['login'];
            
          return $app->redirect('../');

        }
      }
      else {
        return $app->redirect('inscription');
      }
    }

if (!isset($_SESSION['login'])) {
    return $app['twig']->render('inscription.html.twig', array('form' => $form->createView()));
}
else {
      return $app->redirect('../');
}

});





// Home page
$app->get('/', function () use ($app) {
session_start();

    if (isset($_SESSION['login'])) {
		$layout = $app['twig']->loadTemplate('layout.html.twig');
	    $articles = $app['dao.article']->findAll();
	    $notificationsUser = $app['dao.notification']->findUser($_SESSION['login']);
	    $notifications = $app['dao.notification']->findAll($_SESSION['login']);
	    $users = $app['dao.utilisateur']->loadUserByUsername($_SESSION['login']);
	    $categories = $app['dao.categorie']->findAll();

    	return $app['twig']->render('index.html.twig', array('layout' => $layout, 'users' => $_SESSION['login'], 'notifications' => $notifications, 'notif' => $notificationsUser, 'infousers' => $users, 'categories' => $categories, 'articles' => $articles));
	}
	else {
		return $app->redirect('login');
	}
});

// Article details with comments
$app->match('/article/{id}', function ($id, Request $request) use ($app) {
session_start();

    if (isset($_SESSION['login'])) {

		$layout = $app['twig']->loadTemplate('layout.html.twig');
	    $articles = $app['dao.article']->find($id);
	    $commentaire = $app['dao.commentaire']->findAllByArticle($id);
	    $notificationsUser = $app['dao.notification']->findUser($_SESSION['login']);
	    $notifications = $app['dao.notification']->findAll($_SESSION['login']);
	    $users = $app['dao.utilisateur']->loadUserByUsername($_SESSION['login']);
	    $categories = $app['dao.categorie']->findAll();
	    $categoriesbyid = $app['dao.categorie']->find($articles->idcategory);

    $form = $app['form.factory']->createBuilder('form')
        ->add('commentaire', 'textarea', array('attr' => array('placeholder' => 'Votre message')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

            $app['db']->insert('commentaires', array(
                  'id_articles_commentaires' => htmlspecialchars($id),
                  'id_utilisateurs_commentaires' => $users->id,
                  'message_commentaires' => htmlspecialchars($data['commentaire']),
                  'date_commentaires' => date('Y-m-d H:i:s'),
                  'active_commentaires' => '1'
                ));
            
          return $app->redirect(htmlspecialchars($id));
      }

    	return $app['twig']->render('article.html.twig', array('form' => $form->createView(), 'layout' => $layout, 'users' => $_SESSION['login'], 'notifications' => $notifications, 'notif' => $notificationsUser, 'infousers' => $users, 'categories' => $categories, 'categoriesbyid' => $categoriesbyid, 'articles' => $articles, 'commentaires' => $commentaire));
	}
	else {
		return $app->redirect('login');
	}
})->bind('article');

// Category article
$app->get('/categorie/{id}', function ($id) use ($app) {
session_start();

    if (isset($_SESSION['login'])) {

		$layout = $app['twig']->loadTemplate('layout.html.twig');
	    $articles = $app['dao.article']->findAllById($id);
	    $notificationsUser = $app['dao.notification']->findUser($_SESSION['login']);
	    $notifications = $app['dao.notification']->findAll($_SESSION['login']);
	    $users = $app['dao.utilisateur']->loadUserByUsername($_SESSION['login']);
	    $categories = $app['dao.categorie']->findAll();
	    $categoriesbyid = $app['dao.categorie']->find($id);


    	return $app['twig']->render('categorie.html.twig', array('layout' => $layout, 'users' => $_SESSION['login'], 'notifications' => $notifications, 'notif' => $notificationsUser, 'infousers' => $users, 'categories' => $categories, 'categoriesbyid' => $categoriesbyid, 'articles' => $articles));
	}
	else {
		return $app->redirect('login');
	}
});

// Add article

$app->match('/ajouter/articles', function (Request $request) use ($app) {

session_start();

		$layout = $app['twig']->loadTemplate('layout.html.twig');
	    $articles = $app['dao.article']->findAll();
	    $notificationsUser = $app['dao.notification']->findUser($_SESSION['login']);
	    $notifications = $app['dao.notification']->findAll($_SESSION['login']);
	    $users = $app['dao.utilisateur']->loadUserByUsername($_SESSION['login']);
	    $categories = $app['dao.categorie']->findAll();

    $form = $app['form.factory']->createBuilder('form')
        ->add('titre', 'text', array('attr' => array('placeholder' => 'Titre de votre article')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        $contenuRegex = preg_replace("/<script(.*?)<\/script>/si", "", $_POST['contenu']);
        $contenuRegex = preg_replace("/onclick(.*?)<\/a>/si", "", $contenuRegex);
        $contenuRegex = preg_replace("/onload(.*?)<\/a>/si", "", $contenuRegex);
        $contenuRegex = preg_replace("/onmousehover(.*?)<\/a>/si", "", $contenuRegex);
        $contenuRegex = preg_replace("/<a href=javascript(.*?)<\/a>/si", "", $contenuRegex);
        $contenuRegex = preg_replace("/<a href=\"javascript(.*?)<\/a>/si", "", $contenuRegex);
        $contenuRegex = preg_replace("/<iframe(.*?)<\/iframe>/si", "", $contenuRegex);

$categorie = $app['dao.categorie']->find($_POST['categories']);

  if ($categorie) {

            $app['db']->insert('articles', array(
                  'id_utilisateurs' => $users->id,
                  'id_categories' => htmlspecialchars(addslashes($_POST['categories'])),
                  'titre' => htmlspecialchars(addslashes($data['titre'])),
                  'contenu' => $contenuRegex,
                  'status' => '1',
                  'date_articles' => date('Y-m-d H:i:s')
                ));
  }
  else {
            $app['db']->insert('articles', array(
                  'id_utilisateurs' => $users->id,
                  'id_categories' => '4',
                  'titre' => htmlspecialchars(addslashes($data['titre'])),
                  'contenu' => $contenuRegex,
                  'status' => '1',
                  'date_articles' => date('Y-m-d H:i:s')
                ));
  }
            
          return $app->redirect('../');

        }

if (isset($_SESSION['login'])) {
    $layout = $app['twig']->loadTemplate('layout.html.twig');
    return $app['twig']->render('addarticles.html.twig', array('form' => $form->createView(), 'layout' => $layout, 'users' => $_SESSION['login'], 'notifications' => $notifications, 'notif' => $notificationsUser, 'infousers' => $users, 'categories' => $categories, 'articles' => $articles));
}
else {
      return $app->redirect('../inscription');
}

});


// Add Category

$app->match('/ajouter/categorie', function (Request $request) use ($app) {

session_start();

		$layout = $app['twig']->loadTemplate('layout.html.twig');
	    $articles = $app['dao.article']->findAll();
	    $notificationsUser = $app['dao.notification']->findUser($_SESSION['login']);
	    $notifications = $app['dao.notification']->findAll($_SESSION['login']);
	    $users = $app['dao.utilisateur']->loadUserByUsername($_SESSION['login']);
	    $categories = $app['dao.categorie']->findAll();

    $form = $app['form.factory']->createBuilder('form')
        ->add('nom', 'text', array('attr' => array('placeholder' => 'Nom de la catégorie')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

            $app['db']->insert('categories', array(
                  'nom_categories' => $data['nom'],
                  'status' => '1'
                ));
            
          return $app->redirect('../');

        }

if (isset($_SESSION['login'])) {
    $layout = $app['twig']->loadTemplate('layout.html.twig');
    return $app['twig']->render('addcategories.html.twig', array('form' => $form->createView(), 'layout' => $layout, 'users' => $_SESSION['login'], 'notifications' => $notifications, 'notif' => $notificationsUser, 'infousers' => $users, 'categories' => $categories, 'articles' => $articles));
}
else {
      return $app->redirect('../inscription');
}

});



// Profil

$app->get('/profil', function () use ($app) {

session_start();

if (isset($_SESSION['login'])) {

		$layout = $app['twig']->loadTemplate('layout.html.twig');
	    $articles = $app['dao.article']->findAll();
	    $notificationsUser = $app['dao.notification']->findUser($_SESSION['login']);
	    $notifications = $app['dao.notification']->findAll($_SESSION['login']);
	    $users = $app['dao.utilisateur']->loadUserByUsername($_SESSION['login']);
	    $categories = $app['dao.categorie']->findAll();
      $commentaire = $app['dao.commentaire']->findAllByUser($_SESSION['login']);

	    $NoProfil = true;

    return $app['twig']->render('profil.html.twig', array('layout' => $layout, 'NoProfil' => $NoProfil, 'users' => $_SESSION['login'], 'notifications' => $notifications, 'notif' => $notificationsUser, 'infousers' => $users, 'categories' => $categories, 'articles' => $articles, 'commentaire' => $commentaire));
}
else {
	return $app->redirect('inscription');
	exit();
}
});



$app->get('/profil/{idProfil}', function ($idProfil) use ($app) {

$idProfil = str_replace("'", "", $idProfil);


    if (empty($idProfil)) {
        return $app->redirect('../');
    }
    
session_start();

	if (isset($_SESSION['login'])) {

		$layout = $app['twig']->loadTemplate('layout.html.twig');
	    $articles = $app['dao.article']->findAll();
	    $notificationsUser = $app['dao.notification']->findUser($_SESSION['login']);
	    $notifications = $app['dao.notification']->findAll($_SESSION['login']);
	    $users = $app['dao.utilisateur']->findAll($idProfil);
	    $categories = $app['dao.categorie']->findAll();
      $commentaire = $app['dao.commentaire']->findAllByUserCible($idProfil);


	if ($users) {
		$NoProfil = true;
	}
	else {
		$NoProfil = false;
	}

	    return $app['twig']->render('profil.html.twig', array('layout' => $layout, 'NoProfil' => $NoProfil, 'users' => $_SESSION['login'], 'notifications' => $notifications, 'notif' => $notificationsUser, 'infousers' => $users, 'categories' => $categories, 'articles' => $articles, 'commentaire' => $commentaire));
	}
	else {
		return $app->redirect('inscription');
		exit();
	}

});