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

            $title = trim(htmlspecialchars($_POST["title"]));
            $rawDescription = trim($_POST["description"]);
            $date = $_POST["date"];
            $availability = (int)$_POST["availability"];
            $category = isset($_POST["category"]) ? (int)$_POST["category"] : null;

            if (empty($title) || empty($rawDescription) || empty($date)) {
                $_SESSION["error"] = "Veuillez remplir tous les champs.";
            }
            elseif (mb_strlen($title) < 4) {
                $_SESSION["error"] = "Le titre doit contenir minimum 4 caractères.";
            }
            elseif (mb_strlen($title) > 100) {
                $_SESSION["error"] = "Le titre ne doit pas contenir plus de 100 caractères.";
            }
            elseif ($availability < 1) {
                $_SESSION["error"] = "Le nombre de places doit être positif.";
            }
            elseif ($availability > 30) {
                $_SESSION["error"] = "Le nombre de places ne peut pas être supérieur à 30.";
            }
            elseif (empty($category)) {
                $_SESSION["error"] = "Une catégorie doit etre associée.";
            }
            elseif (mb_strlen($rawDescription) > 500) {
                $_SESSION["error"] = "La description doit faire moins de 500 caractères.";
            }
            elseif (strtotime($date) < time()) {
                $_SESSION["error"] = "La date de l'atelier ne peut pas être dans le passé.";
            }
            else {
                $description = trim(htmlspecialchars($_POST["description"]));
                $workshop = new Workshop();
                $workshop->setTitle_workshops($title);
                $workshop->setDescription_workshops($description);
                $workshop->setDate_workshops($date);
                $workshop->setAvailability_workshops($availability);
                $workshop->setId_categories($category);

                $workshopModel = new WorkshopModel();
                $workshopModel->create($workshop);

                $_SESSION["success"] = "Atelier ajouté avec succès !";
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

            $title = trim(htmlspecialchars($_POST["title"]));
            $rawDescription = trim($_POST["description"]);
            $date = $_POST["date"];
            $availability = (int)$_POST["availability"];
            $category = isset($_POST["category"]) ? (int)$_POST["category"] : null;

            if (empty($title) || empty($rawDescription) || empty($date)) {
                $_SESSION["error"] = "Veuillez remplir tous les champs.";
            }
            elseif (mb_strlen($title) < 4) {
                $_SESSION["error"] = "Le titre doit contenir minimum 4 caractères.";
            }
            elseif (mb_strlen($title) > 100) {
                $_SESSION["error"] = "Le titre ne doit pas contenir plus de 100 caractères.";
            }
            elseif ($availability < 0) {
                $_SESSION["error"] = "Le nombre de places ne peut pas être négatif.";
            }
            elseif ($availability > 30) {
                $_SESSION["error"] = "Le nombre de places ne peut pas être supérieur à 30.";
            }
            elseif (empty($category)) {
                $_SESSION["error"] = "Une catégorie doit etre associée.";
            }
            elseif (mb_strlen($rawDescription) > 500) {
                $_SESSION["error"] = "La description doit faire moins de 500 caractères.";
            }
            elseif (strtotime($date) < time()) {
                $_SESSION["error"] = "La date de l'atelier ne peut pas être dans le passé.";
            }
            else {
                $description = trim(htmlspecialchars($rawDescription));
                $workshop = new Workshop();
                $workshop->setTitle_workshops($title);
                $workshop->setDescription_workshops($description);
                $workshop->setDate_workshops($date);
                $workshop->setAvailability_workshops($availability);
                $workshop->setId_categories($category);

                $workshopModel->update($id, $workshop);

                $_SESSION["success"] = "Atelier modifiée avec succès !";
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
            $id = (int)$_GET["id"];
            $workshopModel = new WorkshopModel();

            if ($workshopModel->hasReservations($id)) {
                
                $_SESSION["error"] = "Impossible de supprimer cet atelier car des utilisateurs y sont inscrits.";
                
            } else {
                $workshopModel->delete($id);
                $_SESSION["success"] = "L'atelier a été supprimé avec succès.";
            }

        } else {
            $_SESSION["error"] = "Identifiant d'atelier invalide.";
        }
        
        header("Location: index.php?controller=workshop&action=workshopList");
        exit;
    }
}
?>