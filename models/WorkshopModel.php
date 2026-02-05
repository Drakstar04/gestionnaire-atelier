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

    // Suppression d'un atelier
    public function delete(int $id)
    {
        $this->request = $this->connection->prepare("DELETE FROM workshops WHERE id_workshops = :id");
        $this->request->bindValue(":id", $id);
        $this->executeTryCatch();
    }

    // Création d'un atelier
    public function create(Workshop $workshop)
    {
        $this->request = $this->connection->prepare(
            "INSERT INTO workshops (title_workshops, description_workshops, date_workshops, availability_workshops, id_categories) 
             VALUES (:title, :description, :date, :availability, :category)"
        );

        $this->request->bindValue(":title", $workshop->getTitle_workshops());
        $this->request->bindValue(":description", $workshop->getDescription_workshops());
        $this->request->bindValue(":date", $workshop->getDate_workshops());
        $this->request->bindValue(":availability", $workshop->getAvailability_workshops());
        $this->request->bindValue(":category", $workshop->getId_categories());

        $this->executeTryCatch();
    }

    // Modification d'un atelier
    public function update(int $id, Workshop $workshop)
    {
        $this->request = $this->connection->prepare(
            "UPDATE workshops 
             SET title_workshops = :title, 
                 description_workshops = :description, 
                 date_workshops = :date, 
                 availability_workshops = :availability, 
                 id_categories = :category
             WHERE id_workshops = :id"
        );

        $this->request->bindValue(":id", $id);
        $this->request->bindValue(":title", $workshop->getTitle_workshops());
        $this->request->bindValue(":description", $workshop->getDescription_workshops());
        $this->request->bindValue(":date", $workshop->getDate_workshops());
        $this->request->bindValue(":availability", $workshop->getAvailability_workshops());
        $this->request->bindValue(":category", $workshop->getId_categories());

        $this->executeTryCatch();
    }

    // Récupère uniquement les ateliers à venir avec des places dispo
    public function findUpcomingAvailable()
    {
        $this->request = "SELECT * FROM workshops 
                          WHERE date_workshops >= CURDATE() 
                          AND availability_workshops > 0
                          ORDER BY date_workshops ASC";
        $result = $this->connection->query($this->request);
        return $result->fetchAll();
    }

    // Mise à jour de la disponibilité (+1 ou -1)
    public function updateAvailability(int $id, string $operation)
    {
        $operator = ($operation === "decrement") ? "-" : "+";
        
        $this->request = $this->connection->prepare(
            "UPDATE workshops 
             SET availability_workshops = availability_workshops $operator 1 
             WHERE id_workshops = :id"
        );
        $this->request->bindValue(":id", $id);
        $this->executeTryCatch();
    }

    public function searchWorkshop(string $query)
    {
        $this->request = $this->connection->prepare(
            "SELECT w.*, c.name_categories 
            FROM workshops w 
            INNER JOIN categories c ON w.id_categories = c.id_categories
            WHERE w.title_workshops LIKE :query
            ORDER BY w.date_workshops ASC"
        );

        $this->request->bindValue(":query", "%" . $query . "%");
        $this->request->execute();
        return $this->request->fetchAll();
    }

    // Vérifie si un atelier possède des réservations
    public function hasReservations(int $id)
    {
        $this->request = $this->connection->prepare("SELECT COUNT(*) as count FROM reservations WHERE id_workshops = :id");
        $this->request->bindValue(":id", $id);
        $this->request->execute();
        $result = $this->request->fetch();
        
        return $result->count > 0;
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