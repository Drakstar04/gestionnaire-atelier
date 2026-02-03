<?php

namespace App\controller;


abstract class Controller
{
    protected function render(string $path, array $data = [])
    {
        extract($data);

        ob_start();

        include dirname(__DIR__) . "/views/" . $path . ".php";

        $content = ob_get_clean();

        include dirname(__DIR__) . "/views/base.php";
    }

    // Vérifie si l'utilisateur est connectée
    protected function isLogged()
    {
        if (!isset($_SESSION["user"])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }

    // Vérifie si l'utilisateur est ADMIN
    protected function isAdmin()
    {
        $this->isLogged();

        if ($_SESSION["user"]["id_role"] != 1) {
            header("Location: index.php?controller=workshop&action=workshopList");
            exit;
        }
    }
}
?>