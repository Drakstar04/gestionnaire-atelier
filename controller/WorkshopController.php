<?php

namespace App\controller;

use App\models\WorkshopModel;
use App\models\CategoryModel;

class WorkshopController extends Controller
{
    // Affiche la liste de tous les ateliers + filtres par catégorie
    public function workshopList()
    {
        $workshopModel = new WorkshopModel();
        $categoryModel = new CategoryModel();

        $categories = $categoryModel->findAll();

        if (isset($_GET["category"]) && !empty($_GET["category"])) {
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
            "currentCategory" => $currentCategory
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
                $this->render("workshop/workshopDetail", ["workshop" => $workshop]);
            } else {
                header("Location: index.php?controller=workshop&action=workshopList");
                exit;
            }
        } else {
            header("Location: index.php?controller=workshop&action=workshopList");
            exit;
        }
    }
}
?>