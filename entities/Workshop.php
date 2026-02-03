<?php

namespace App\entities;

class Workshop {

    private $id_workshops;
    private $title_workshops;
    private $description_workshops;
    private $date_workshops;
    private $availability_workshops;
    private $id_categories;

    
    public function getId_workshops() {
        return $this->id_workshops;
    }

    public function setId_workshops($id_workshops) {
        $this->id_workshops = $id_workshops;
        return $this;
    }


    public function getTitle_workshops() {
        return $this->title_workshops;
    }

    public function setTitle_workshops($title_workshops) {
        $this->title_workshops = $title_workshops;
        return $this;
    }


    public function getDescription_workshops() {
        return $this->description_workshops;
    }

    public function setDescription_workshops($description_workshops) {
        $this->description_workshops = $description_workshops;
        return $this;
    }


    public function getDate_workshops() {
        return $this->date_workshops;
    }

    public function setDate_workshops($date_workshops) {
        $this->date_workshops = $date_workshops;
        return $this;
    }


    public function getAvailability_workshops() {
        return $this->availability_workshops;
    }

    public function setAvailability_workshops($availability_workshops) {
        $this->availability_workshops = $availability_workshops;
        return $this;
    }


    public function getId_categories() {
        return $this->id_categories;
    }

    public function setId_categories($id_categories) {
        $this->id_categories = $id_categories;
        return $this;
    }
}
?>