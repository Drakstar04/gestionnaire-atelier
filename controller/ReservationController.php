<?php

namespace App\controller;

use App\models\ReservationModel;
use App\models\WorkshopModel;
use App\entities\Reservation;
use DateTime;

class ReservationController extends Controller
{
    public function reservationList()
    {
       $this->isLogged();
        $userId = $_SESSION["user"]["id_user"];
        
        $reservationModel = new ReservationModel();
        $allReservations = $reservationModel->findByUser($userId);

        $upcomingReservations = [];
        $pastReservations = [];
        $now = new DateTime();

        foreach($allReservations as $res) {
            $workshopDate = new DateTime($res->date_workshops);
            if ($workshopDate >= $now) {
                $upcomingReservations[] = $res;
            } else {
                $pastReservations[] = $res;
            }
        }

        $this->render("reservation/reservationList", [
            "upcomingReservations" => $upcomingReservations,
            "pastReservations" => $pastReservations
        ]);
    }

    // Créer une réservation
    public function reservationCreate()
    {
        $this->isLogged();
        $workshopModel = new WorkshopModel();
        $reservationModel = new ReservationModel();

        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST["workshop_id"]) && !empty($_POST["workshop_id"])) {
                
                $workshopId = (int)$_POST["workshop_id"];
                $userId = $_SESSION["user"]["id_user"];

                if ($reservationModel->checkDuplicate($userId, $workshopId)) {
                    $_SESSION["error"] = "Vous êtes déjà inscrit à cet atelier.";
                } else {
                    $workshop = $workshopModel->find($workshopId);

                    if ($workshop && $workshop->availability_workshops > 0) {
                        $reservation = new Reservation();
                        $reservation->setId_users($userId);
                        $reservation->setId_workshops($workshopId);

                        $reservationModel->create($reservation);
                        $workshopModel->updateAvailability($workshopId, "decrement");

                        $_SESSION["success"] = "Votre réservation a été confirmée avec succès !";

                        header("Location: index.php?controller=reservation&action=reservationList");
                        exit;
                    } else {
                        $_SESSION["error"] = "Désolé, cet atelier n'a plus de places disponibles.";
                    }
                }
            }
        }

        $workshops = $workshopModel->findUpcomingAvailable();
        
        $selectedWorkshopId = isset($_GET["id"]) ? (int)$_GET["id"] : null;

        $this->render("reservation/reservationCreate", [
            "workshops" => $workshops,
            "selectedId" => $selectedWorkshopId
        ]);
    }

    // Annuler une réservation
    public function reservationCancel()
    {
        $this->isLogged();

        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $reservationId = (int)$_GET["id"];
            $reservationModel = new ReservationModel();
            
            $reservationData = $reservationModel->find($reservationId);

            if ($reservationData && $reservationData->id_users == $_SESSION["user"]["id_user"]) {
                
                $reservationModel->delete($reservationId);

                $workshopModel = new WorkshopModel();
                $workshopModel->updateAvailability($reservationData->id_workshops, "increment");

                $_SESSION["success"] = "La réservation a bien été annulée.";
            } else {
                $_SESSION["error"] = "Impossible d'annuler cette réservation.";
            }
        } else {
            $_SESSION["error"] = "Identifiant de réservation invalide.";
        }

        header("Location: index.php?controller=reservation&action=reservationList");
        exit;
    }
}
?>