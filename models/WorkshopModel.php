<?php
namespace App\models;

use Exception;
use App\core\DbConnect;
use App\entities\Workshop;

class WorkshopModel extends DbConnect {

    public function findAll() 
    {
        $this->request = "SELECT * FROM workshops";
        $result = $this->connection->query($this->request);
        return $result->fetchAll();
    }

    public function find(int $id) 
    {
        $this->request = $this->connection->prepare("SELECT * FROM workshops WHERE id_workshops = :id");
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