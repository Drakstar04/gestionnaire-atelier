<?php

namespace App\entities;

class User {

    private $id_users;
    private $name_users;
    private $email_users;
    private $password_users;
    private $id_roles;


    public function getId_users() {
        return $this->id_users;
    }

    public function setId_users($id_users) {
        $this->id_users = $id_users;
        return $this;
    }


    public function getName_users() {
        return $this->name_users;
    }

    public function setName_users($name_users) {
        $this->name_users = $name_users;
        return $this;
    }


    public function getEmail_users() {
        return $this->email_users;
    }

    public function setEmail_users($email_users) {
        $this->email_users = $email_users;
        return $this;
    }


    public function getPassword_users() {
        return $this->password_users;
    }

    public function setPassword_users($password_users) {
        $this->password_users = $password_users;
        return $this;
    }

    
    public function getId_roles() {
        return $this->id_roles;
    }

    public function setId_roles($id_roles) {
        $this->id_roles = $id_roles;
        return $this;
    }
}