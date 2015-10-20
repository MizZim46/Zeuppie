<?php

namespace Pipress\Domain;

class Article 
{
    /**
     * Article id.
     *
     * @var integer
     */
    private $id;

    /**
     * Article id user.
     *
     * @var integer
     */
    private $iduser;

    /**
     * Article id category.
     *
     * @var integer
     */
    public $idcategory;

    /**
     * Article title.
     *
     * @var string
     */
    private $title;

    /**
     * Article content.
     *
     * @var string
     */
    private $content;

    /**
     * Article statut.
     *
     * @var integer
     */
    private $statut;

    /**
     * Article date.
     *
     * @var datetime
     */
    private $date;

    /**
     * Article pseudo.
     *
     * @var string
     */
    private $pseudo;

    /**
     * Article name category.
     *
     * @var string
     */
    private $namecategory;

    /**
     * Article number comments.
     *
     * @var integer
     */
    private $nbcomments;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdUser() {
        return $this->iduser;
    }

    public function setIdUser($iduser) {
        $this->iduser = $iduser;
    }

    public function getIdCategory() {
        return $this->idcategory;
    }

    public function setIdCategory($idcategory) {
        $this->idcategory = $idcategory;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }    

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    } 

    public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }   

    public function getNameCategory() {
        return $this->namecategory;
    }

    public function setNameCategory($namecategory) {
        $this->namecategory = $namecategory;
    }     

    public function getNbComments() {
        return $this->nbcomments;
    }

    public function setNbComments($nbcomments) {
        $this->nbcomments = $nbcomments;
    }    
}