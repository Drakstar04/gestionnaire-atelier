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

    public function findByEmail(string $email) 
    {
        $this->request = $this->connection->prepare("SELECT * FROM users WHERE email_users = :email");
        $this->request->bindParam(":email", $email);
        $this->request->execute();
        return $this->request->fetch();
    }

    public function create(User $user)
    {
        $this->request = $this->connection->prepare(
            "INSERT INTO users (name_users, email_users, password_users, id_roles) 
             VALUES (:name, :email, :password, :role)"
        );
        $this->request->bindValue(":name", $user->getName_users());
        $this->request->bindValue(":email", $user->getEmail_users());
        $this->request->bindValue(":password", $user->getPassword_users());
        $this->request->bindValue(":role", $user->getId_roles());
        $this->executeTryCatch();
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
?>