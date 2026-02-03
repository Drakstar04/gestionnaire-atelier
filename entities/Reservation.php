<?php

namespace App\entities;

class Reservation {

    private $id_reservations;
    private $date_reservations;
    private $id_workshops;
    private $id_users;


    public function getId_reservations() {
        return $this->id_reservations;
    }

    public function setId_reservations($id_reservations) {
        $this->id_reservations = $id_reservations;
        return $this;
    }


    public function getDate_reservations() {
        return $this->date_reservations;
    }

    public function setDate_reservations($date_reservations) {
        $this->date_reservations = $date_reservations;
        return $this;
    }


    public function getId_workshops() {
        return $this->id_workshops;
    }

    public function setId_workshops($id_workshops) {
        $this->id_workshops = $id_workshops;
        return $this;
    }
    

    public function getId_users() {
        return $this->id_users;
    }

    public function setId_users($id_users) {
        $this->id_users = $id_users;
        return $this;
    }
}
?>