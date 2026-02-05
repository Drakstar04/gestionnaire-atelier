<?php

namespace App\controller;

use App\models\ReservationModel;
use App\models\CategoryModel;
use App\entities\Category;

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

    // Création d'une catégorie
    public function addCategory()
    {
        $this->isAdmin();

        if (isset($_POST) && !empty($_POST)) {
            
            $name = htmlspecialchars($_POST["name"]);

            if (empty($name)) {
                $_SESSION["error"] = "Veuillez remplir tous les champs.";
            }
            elseif (mb_strlen($name) < 4) {
                $_SESSION["error"] = "Le nom doit contenir au moins 4 caractères.";
            }elseif (mb_strlen($name) > 35) {
                $_SESSION["error"] = "Le nom doit contenir moins de 35 caractères.";
            }else {
                $category = new Category();
                $category->setName_categories($name);

                $categoryModel = new CategoryModel();
                $categoryModel->create($category);

                $_SESSION["success"] = "Catégorie ajouté avec succès !";
                header("Location: index.php?controller=admin&action=allCategories");
                exit;
            }
        }
        $this->render("admin/addCategory");
    }

    // Modification d'une catégorie
    public function editCategory()
    {
        $this->isAdmin();

        if (!isset($_GET["id"]) || empty($_GET["id"])) {
            header("Location: index.php?controller=admin&action=allCategories");
            exit;
        }

        $id = (int)$_GET["id"];
        $categoryModel = new CategoryModel();

        if (isset($_POST) && !empty($_POST)) {
            
            $name = htmlspecialchars($_POST["name"]);

            if (empty($name)) {
                $_SESSION["error"] = "Veuillez remplir tous les champs.";
            }
            elseif (mb_strlen($name) < 4) {
                $_SESSION["error"] = "Le nom doit contenir au moins 4 caractères.";
            }elseif (mb_strlen($name) > 35) {
                $_SESSION["error"] = "Le nom doit contenir moins de 35 caractères.";
            }else {
                $category = new Category();
                $category->setName_categories($name);

                $categoryModel->update($id, $category);

                $_SESSION["success"] = "Catégorie modifié avec succès !";
                header("Location: index.php?controller=admin&action=allCategories");
                exit;
            }
        }
        $category = $categoryModel->find($id);
        $this->render("admin/editCategory", ["category" => $category]);
    }

    // Suppresion d'une catégorie si aucun atelier n'est liée
    public function deleteCategory()
    {
        $this->isAdmin();

        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $id = (int)$_GET["id"];
            $categoryModel = new CategoryModel();

            if ($categoryModel->isLinkedToWorkshop($id)) {
                $_SESSION["error"] = "Impossible de supprimer : cette catégorie contient des ateliers.";
            } else {
                $categoryModel->delete($id);
                $_SESSION["success"] = "La catégorie a bien été supprimée.";
            }
        } else {
            $_SESSION["error"] = "ID de catégorie invalide.";
        }

        header("Location: index.php?controller=admin&action=allCategories");
        exit;
    }
}
?>