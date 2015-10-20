<?php

namespace Pipress\Domain;

class Commentaire 
{
    /**
     * Comment id.
     *
     * @var integer
     */
    private $id;

    /**
     * Associated article.
     *
     * @var \Pipress\Domain\Article
     */
    private $article;

    /**
     * Comment id user.
     *
     * @var integer
     */
    private $iduser;

    /**
     * Comment message.
     *
     * @var string
     */
    private $message;

    /**
     * Comment date.
     *
     * @var datetime
     */
    private $date;

    /**
     * Comment statut.
     *
     * @var integer
     */
    private $statut;

    /**
     * Comment pseudo.
     *
     * @var string
     */
    private $pseudo;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getArticle() {
        return $this->article;
    }

    public function setArticle(Article $article) {
        $this->article = $article;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }
}