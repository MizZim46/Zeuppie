<?php

namespace Pipress\Domain;

class Notification 
{
    /**
     * Notification id.
     *
     * @var integer
     */
    private $id;

    /**
     * Notification id user.
     *
     * @var integer
     */
    private $iduser;

    /**
     * Notification message.
     *
     * @var string
     */
    private $message;

    /**
     * Notification date.
     *
     * @var datetime
     */
    private $date;

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

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}