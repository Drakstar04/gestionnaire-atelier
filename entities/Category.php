<?php

namespace App\entities;

class Category {

    private $id_categories;
    private $name_categories;


    public function getId_categories() {
        return $this->id_categories;
    }

    public function setId_categories($id_categories) {
        $this->id_categories = $id_categories;
        return $this;
    }

    
    public function getName_categories() {
        return $this->name_categories;
    }

    public function setName_categories($name_categories) {
        $this->name_categories = $name_categories;
        return $this;
    }
}