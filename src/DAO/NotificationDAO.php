<?php

namespace Pipress\DAO;

use Doctrine\DBAL\Connection;
use Pipress\Domain\Notification;

class NotificationDAO extends DAO
{

    /**
     * Return a list of all notifications, sorted by date (most recent first).
     *
     * @return array A list of all notifications.
     */
    public function findAll($user) {
        $sql = "SELECT * 
            FROM utilisateurs AS u
            LEFT JOIN notifications AS n
            ON u.id_utilisateurs = n.id_utilisateurs
            WHERE u.login = '".$user."'";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $notifications = array();
        foreach ($result as $row) {
            $notificationsId = $row['id_notifications'];
            $notifications[$notificationsId] = $this->buildDomainObject($row);
        }
        return $notifications;
    }

    /**
     * Return a list of all notifications, sorted by date (most recent first).
     *
     * @return array A list of all notifications.
     */
    public function findUser($user) {
        $sql = "SELECT *, COUNT(n.id_notifications) AS nbNotifs 
            FROM utilisateurs AS u
            LEFT JOIN notifications AS n
            ON u.id_utilisateurs = n.id_utilisateurs
            WHERE u.login = '".$user."'";
        $result = $this->getDb()->fetchAssoc($sql);
        
            $notificationUsernbNotifs = $result['nbNotifs'];
            return $notificationUsernbNotifs;
    }

    /**
     * Creates an Notification object based on a DB row.
     *
     * @param array $row The DB row containing Notification data.
     * @return \Pipress\Domain\Notification
     */
    protected function buildDomainObject($row) {
        $notification = new Notification();
        $notification->setId($row['id_notifications']);
        $notification->setIdUser($row['id_utilisateurs']);
        $notification->setMessage($row['message']);
        $notification->setDate($row['date_notifications']);
        return $notification;
    }
}