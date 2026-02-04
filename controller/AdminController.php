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
            if (!empty($_POST["name"])) {
                $category = new Category();
                $category->setName_categories(htmlspecialchars($_POST["name"]));

                $categoryModel = new CategoryModel();
                $categoryModel->create($category);

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
            if (!empty($_POST["name"])) {
                $category = new Category();
                $category->setName_categories(htmlspecialchars($_POST["name"]));

                $categoryModel->update($id, $category);
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
                $_SESSION["error"] = "Impossible de supprimer cette catégorie car elle est liée à des ateliers existants.";
            } else {
                $categoryModel->delete($id);
                $_SESSION["success"] = "Catégorie supprimée avec succès.";
            }
        }

        header("Location: index.php?controller=admin&action=allCategories");
        exit;
    }
}
?>