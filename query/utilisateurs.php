<?php
	$Utilisateurs = "SELECT * 
			FROM utilisateurs
			WHERE login = '".$_SESSION['login']."'";

    $utilisateursReponse = $app['db']->fetchAssoc($Utilisateurs);

	$NbNotifications = "SELECT COUNT(n.id_notifications) AS nbNotifs 
			FROM utilisateurs AS u
			LEFT JOIN notifications AS n
			ON u.id_utilisateurs = n.id_utilisateurs
			WHERE u.login = '".$_SESSION['login']."'";

    $NbNotificationsReponse = $app['db']->fetchAssoc($NbNotifications);

    $Notifications = "SELECT * 
			FROM utilisateurs AS u
			LEFT JOIN notifications AS n
			ON u.id_utilisateurs = n.id_utilisateurs
			WHERE u.login = '".$_SESSION['login']."'";

    $NotificationsReponse = $app['db']->fetchAll($Notifications);