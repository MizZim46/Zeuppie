<?php

namespace Pipress\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Pipress\Domain\Utilisateur;

class UtilisateurDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \Pipress\Domain\Utilisateur|throws an exception if no matching user is found
     */
    public function findAll($id) {
        $sql = "SELECT * 
            FROM utilisateurs AS u 
            LEFT JOIN profil_utilisateurs AS pu
            ON u.id_utilisateurs = pu.id_utilisateurs
            WHERE u.id_utilisateurs = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "SELECT * 
            FROM utilisateurs AS u 
            LEFT JOIN profil_utilisateurs AS pu
            ON u.id_utilisateurs = pu.id_utilisateurs
            WHERE u.login = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function login($username, $password)
    {
        $sql = "SELECT * 
            FROM utilisateurs AS u 
            LEFT JOIN profil_utilisateurs AS pu
            ON u.id_utilisateurs = pu.id_utilisateurs
            WHERE u.login = ? OR u.pseudo = ?
            AND u.password = '".crypt(htmlspecialchars($password), '$2y$08$'.__SALTCRYPT__.'$')."'";
        $row = $this->getDb()->fetchAssoc($sql, array($username, $username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function register($username)
    {
        $sql = "SELECT * 
            FROM utilisateurs AS u 
            LEFT JOIN profil_utilisateurs AS pu
            ON u.id_utilisateurs = pu.id_utilisateurs
            WHERE u.login = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'Pipress\Domain\Utilisateur' === $class;
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \Pipress\Domain\Utilisateur
     */
    protected function buildDomainObject($row) {
        $user = new Utilisateur();
        $user->setId($row['id_utilisateurs']);
        $user->setUsername($row['login']);
        $user->setPassword($row['password']);
        $user->setPseudo($row['pseudo']);
        $user->setStatut($row['status']);
        $user->setSalt($row['salt']);
        $user->setRole($row['role']);
        $user->setDate($row['date_inscription']);
        $user->setPrenom($row['prenom']);
        $user->setNom($row['nom']);
        $user->setAge($row['age']);
        $user->setPays($row['pays']);
        $user->setInteret($row['interet']);
        $user->setDescription($row['description']);
        $user->setTwitter($row['twitter']);
        $user->setFacebook($row['facebook']);
        $user->setGoogle($row['google']);

        return $user;
    }
}