<?php
namespace App\models;

use Exception;
use App\core\DbConnect;
use App\entities\Workshop;

class WorkshopModel extends DbConnect {

    public function findAll() 
    {
        $this->request = "SELECT w.*, c.name_categories 
                        FROM workshops w 
                        INNER JOIN categories c ON w.id_categories = c.id_categories
                        ORDER BY w.date_workshops ASC";
        $result = $this->connection->query($this->request);
        return $result->fetchAll();
    }

    public function find(int $id) 
    {
        $this->request = $this->connection->prepare("SELECT w.*, c.name_categories 
                                                    FROM workshops w 
                                                    INNER JOIN categories c 
                                                    ON w.id_categories = c.id_categories
                                                    WHERE w.id_workshops = :id");
        $this->request->bindParam(":id", $id);
        $this->request->execute();
        return $this->request->fetch();
    }

    public function findAvailable()
    {
        $this->request = "SELECT * FROM workshops 
                        WHERE date_workshops >= CURDATE() 
                        AND availability_workshops > 0
                        ORDER BY date_workshops ASC";
        
        $result = $this->connection->query($this->request);
        return $result->fetchAll();
    }

    public function findByCategory(int $categoryId) 
    {
        $this->request = $this->connection->prepare(
            "SELECT w.*, c.name_categories 
            FROM workshops w 
            INNER JOIN categories c ON w.id_categories = c.id_categories
            WHERE w.id_categories = :cat_id
            ORDER BY w.date_workshops ASC"
        );
        $this->request->bindParam(":cat_id", $categoryId);
        $this->request->execute();
        return $this->request->fetchAll();
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