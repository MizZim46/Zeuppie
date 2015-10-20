<?php

namespace Pipress\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class Utilisateur implements UserInterface
{
    /**
     * Utilisateur id.
     *
     * @var integer
     */
    public $id;

    /**
     * Utilisateur login.
     *
     * @var string
     */
    public $login;

    /**
     * Utilisateur pseudo.
     *
     * @var string
     */
    private $pseudo;

    /**
     * Utilisateur status.
     *
     * @var integer
     */
    private $statut;

    /**
     * Utilisateur roles.
     *
     * @var string
     */
    private $role;

    /**
     * Utilisateur salt.
     *
     * @var string
     */
    private $salt;

    /**
     * Utilisateur date.
     *
     * @var datetime
     */
    private $date;

    /**
     * User password.
     *
     * @var string
     */
    private $password;

    /**
     * User prenom.
     *
     * @var string
     */
    private $prenom;

    /**
     * User nom.
     *
     * @var string
     */
    private $nom;

    /**
     * User age.
     *
     * @var string
     */
    private $age;

    /**
     * User pays.
     *
     * @var string
     */
    private $pays;

    /**
     * User interet.
     *
     * @var string
     */
    private $interet;

    /**
     * User description.
     *
     * @var string
     */
    private $description;

    /**
     * User twitter.
     *
     * @var string
     */
    private $twitter;

    /**
     * User facebook.
     *
     * @var string
     */
    private $facebook;

    /**
     * User google.
     *
     * @var string
     */
    private $google;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->login;
    }

    public function setUsername($login) {
        $this->login = $login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getRoles()
    {
        return array($this->getRole());
    }

    public function eraseCredentials() {
        // Nothing to do here
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getPays() {
        return $this->pays;
    }

    public function setPays($pays) {
        $this->pays = $pays;
    }

    public function getInteret() {
        return $this->interet;
    }

    public function setInteret($interet) {
        $this->interet = $interet;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getTwitter() {
        return $this->twitter;
    }

    public function setTwitter($twitter) {
        $this->twitter = $twitter;
    }

    public function getFacebook() {
        return $this->facebook;
    }

    public function setFacebook($facebook) {
        $this->facebook = $facebook;
    }

    public function getGoogle() {
        return $this->google;
    }

    public function setGoogle($google) {
        $this->google = $google;
    }
}