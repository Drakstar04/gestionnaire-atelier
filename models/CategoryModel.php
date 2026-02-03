<?php
namespace App\models;

use Exception;
use App\core\DbConnect;
use App\entities\Category;

class CategoryModel extends DbConnect {

    public function findAll() 
    {
        $this->request = "SELECT * FROM categories";
        $result = $this->connection->query($this->request);
        return $result->fetchAll();
    }

    public function find(int $id) 
    {
        $this->request = $this->connection->prepare("SELECT * FROM categories WHERE id_categories = :id");
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
?>