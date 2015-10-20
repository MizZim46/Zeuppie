<?php

namespace Pipress\Domain;

class Categorie 
{
    /**
     * Categorie id.
     *
     * @var integer
     */
    private $id;

    /**
     * Categorie name.
     *
     * @var string
     */
    private $name;

    /**
     * Categorie statut.
     *
     * @var integer
     */
    private $statut;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }
}