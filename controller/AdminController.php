<?php

namespace App\controller;

use App\models\ReservationModel;
use App\models\CategoryModel;

class AdminController extends Controller
{
    // Affiche la liste de toutes les réservations
    public function reservations()
    {
        $this->isAdmin(); 

        $reservationModel = new ReservationModel();
        $reservations = $reservationModel->findAllWithDetails();

        $this->render("admin/reservations", ["reservations" => $reservations]);
    }

    // Affiche la liste des catégories
    public function allCategories()
    {
        $this->isAdmin();

        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        $this->render("admin/allCategories", ["categories" => $categories]);
    }
}
?>