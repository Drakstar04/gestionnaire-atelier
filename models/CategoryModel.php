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

    // Vérifie si une catégorie est liée à au moins un atelier
    public function isLinkedToWorkshop(int $id)
    {
        $this->request = $this->connection->prepare("SELECT COUNT(*) as total FROM workshops WHERE id_categories = :id");
        $this->request->bindValue(":id", $id);
        $this->request->execute();
        $result = $this->request->fetch();
        
        return $result->total > 0;
    }

    // Suppression d'une catégorie
    public function delete(int $id)
    {
        $this->request = $this->connection->prepare("DELETE FROM categories WHERE id_categories = :id");
        $this->request->bindValue(":id", $id);
        $this->executeTryCatch();
    }

    // Création d'une catégorie
    public function create(Category $category)
    {
        $this->request = $this->connection->prepare("INSERT INTO categories (name_categories) VALUES (:name)");
        $this->request->bindValue(":name", $category->getName_categories());
        $this->executeTryCatch();
    }

    // Modification d'une catégorie
    public function update(int $id, Category $category)
    {
        $this->request = $this->connection->prepare("UPDATE categories SET name_categories = :name WHERE id_categories = :id");
        $this->request->bindValue(":id", $id);
        $this->request->bindValue(":name", $category->getName_categories());
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