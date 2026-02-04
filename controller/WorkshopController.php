<?php

namespace App\controller;

use App\models\WorkshopModel;
use App\models\CategoryModel;
use App\models\ReservationModel;
use App\entities\Workshop;

class WorkshopController extends Controller
{
    // Affiche la liste de tous les ateliers + filtres par catégorie
    public function workshopList()
    {
        $workshopModel = new WorkshopModel();
        $categoryModel = new CategoryModel();
        $currentCategory = null;
        $searchQuery = null;

        $categories = $categoryModel->findAll();

        if (isset($_GET["search"]) && !empty($_GET["search"])) {
            $searchQuery = htmlspecialchars($_GET["search"]);
            $workshops = $workshopModel->searchWorkshop($searchQuery);

        } elseif (isset($_GET["category"]) && !empty($_GET["category"])) {
            $idCategory = (int)$_GET["category"];
            $workshops = $workshopModel->findByCategory($idCategory);
            $currentCategory = $idCategory;
        } else {
            $workshops = $workshopModel->findAll();
            $currentCategory = null;
        }

        $this->render("workshop/workshopList", [
            "workshops" => $workshops,
            "categories" => $categories,
            "currentCategory" => $currentCategory,
            "searchQuery" => $searchQuery
        ]);
    }

    // Affiche le détail d'un seul atelier
    public function workshopDetail()
    {
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $id = (int)$_GET["id"];

            $workshopModel = new WorkshopModel();
            $workshop = $workshopModel->find($id);

            if ($workshop) {
                $isAlreadyReserved = false;
                
                if (isset($_SESSION["user"])) {
                    $reservationModel = new ReservationModel();
                    $isAlreadyReserved = $reservationModel->checkDuplicate(
                        $_SESSION["user"]["id_user"], 
                        $workshop->id_workshops
                    );
                }

                $this->render("workshop/workshopDetail", [
                    "workshop" => $workshop,
                    "isAlreadyReserved" => $isAlreadyReserved
                ]);
            }
        } else {
            header("Location: index.php?controller=workshop&action=workshopList");
            exit;
        }
    }

    // Création d'un atelier
    public function add()
    {
        $this->isAdmin();
        
        if (isset($_POST) && !empty($_POST)) {
            if(!empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["date"]) && !empty($_POST["availability"]) && !empty($_POST["category"])){
                $workshop = new Workshop();

                $workshop->setTitle_workshops(htmlspecialchars($_POST["title"]));
                $workshop->setDescription_workshops(htmlspecialchars($_POST["description"]));
                $workshop->setDate_workshops($_POST["date"]);
                $workshop->setAvailability_workshops((int)$_POST["availability"]);
                $workshop->setId_categories((int)$_POST["category"]);

                $workshopModel = new WorkshopModel();
                $workshopModel->create($workshop);

                header("Location: index.php?controller=workshop&action=workshopList");
                exit;
            }
        }

        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        $this->render("workshop/add", ["categories" => $categories]);
    }

    // Modification d'un atelier
    public function edit()
    {
        $this->isAdmin();

        if (!isset($_GET["id"]) || empty($_GET["id"])) {
            header("Location: index.php?controller=workshop&action=workshopList");
            exit;
        }

        $id = (int)$_GET["id"];
        $workshopModel = new WorkshopModel();

        if (isset($_POST) && !empty($_POST)) {
            if(!empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["date"]) && !empty($_POST["availability"]) && !empty($_POST["category"])){

                $workshop = new Workshop();

                $workshop->setTitle_workshops(htmlspecialchars($_POST["title"]));
                $workshop->setDescription_workshops(htmlspecialchars($_POST["description"]));
                $workshop->setDate_workshops($_POST["date"]);
                $workshop->setAvailability_workshops((int)$_POST["availability"]);
                $workshop->setId_categories((int)$_POST["category"]);

                $workshopModel->update($id, $workshop);

                header("Location: index.php?controller=workshop&action=workshopList");
                exit;
            }
        }

        $workshop = $workshopModel->find($id);
        
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        $this->render("workshop/edit", [
            "workshop" => $workshop,
            "categories" => $categories
        ]);
    }

    // Suppresion d'un atelier
    public function delete()
    {
        $this->isAdmin();

        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $workshopModel = new WorkshopModel();
            $workshopModel->delete((int)$_GET["id"]);
        }
        
        header("Location: index.php?controller=workshop&action=workshopList");
        exit;
    }
}
?>