<?php
if (!empty($idProfil)) {
	$Utilisateurs = "SELECT * 
			FROM utilisateurs AS u 
			LEFT JOIN profil_utilisateurs AS pu
			ON u.id_utilisateurs = pu.id_utilisateurs
			WHERE u.id_utilisateurs = '".$idProfil."'";

    $utilisateursReponse = $app['db']->fetchAssoc($Utilisateurs);
}
else {
	$Utilisateurs = "SELECT * 
			FROM utilisateurs AS u 
			LEFT JOIN profil_utilisateurs AS pu
			ON u.id_utilisateurs = pu.id_utilisateurs
			WHERE u.login = '".$_SESSION['login']."'";

    $utilisateursReponse = $app['db']->fetchAssoc($Utilisateurs);
}
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