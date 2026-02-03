<?php

namespace App\controller;

use App\models\ReservationModel;
use App\models\WorkshopModel;
use App\entities\Reservation;

class ReservationController extends Controller
{
    public function reservationList()
    {
        $this->isLogged();
        
        $userId = $_SESSION["user"]["id_user"];
        
        $reservationModel = new ReservationModel();
        $reservations = $reservationModel->findByUser($userId);

        $this->render("reservation/reservationList", ["reservations" => $reservations]);
    }
}
?>