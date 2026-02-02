<?php

namespace App\entities;

class Role {

    private $id_roles;
    private $name_roles;


    public function getId_roles() {
        return $this->id_roles;
    }

    public function setId_roles($id_roles) {
        $this->id_roles = $id_roles;
        return $this;
    }

    
    public function getName_roles() {
        return $this->name_roles;
    }

    public function setName_roles($name_roles) {
        $this->name_roles = $name_roles;
        return $this;
    }
}