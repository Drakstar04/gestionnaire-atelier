<?php
namespace App\models;

use Exception;
use App\core\DbConnect;
use App\entities\Reservation;

class ReservationModel extends DbConnect {

    public function findAll() 
    {
        $this->request = "SELECT * FROM reservations";
        $result = $this->connection->query($this->request);
        return $result->fetchAll();
    }

    public function find(int $id) 
    {
        $this->request = $this->connection->prepare("SELECT * FROM reservations WHERE id_reservations = :id");
        $this->request->bindParam(":id", $id);
        $this->request->execute();
        return $this->request->fetch();
    }

    public function findByUser(int $userId) 
    {
        $this->request = $this->connection->prepare(
            "SELECT r.*, w.title_workshops, w.date_workshops, w.description_workshops 
            FROM reservations r
            INNER JOIN workshops w ON r.id_workshops = w.id_workshops
            WHERE r.id_users = :user_id
            ORDER BY r.date_reservations DESC"
        );
        $this->request->bindParam(":user_id", $userId);
        $this->request->execute();
        return $this->request->fetchAll();
    }
    
    public function findAllWithDetails() 
    {
        $this->request = "SELECT 
                            r.id_reservations, 
                            r.date_reservations,
                            u.name_users, 
                            u.email_users,
                            w.id_workshops, 
                            w.title_workshops, 
                            w.date_workshops
                        FROM reservations r
                        INNER JOIN users u ON r.id_users = u.id_users
                        INNER JOIN workshops w ON r.id_workshops = w.id_workshops
                        ORDER BY r.date_reservations DESC";
        
        $result = $this->connection->query($this->request);
        return $result->fetchAll();
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