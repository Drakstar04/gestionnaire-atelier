<?php
namespace App\models;

use Exception;
use App\core\DbConnect;
use App\entities\User;

class UserModel extends DbConnect {

    public function findAll() 
    {
        $this->request = "SELECT * FROM users";
        $result = $this->connection->query($this->request);
        return $result->fetchAll();
    }

    public function find(int $id) 
    {
        $this->request = $this->connection->prepare("SELECT * FROM users WHERE id_users = :id");
        $this->request->bindParam(":id", $id);
        $this->request->execute();
        return $this->request->fetch();
    }
    
    private function executeTryCatch()
    {
        try {
            $this->request->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
        $this->request->closeCursor();
    }
}