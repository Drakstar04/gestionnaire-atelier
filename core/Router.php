<?php

namespace App\core;


class router 
{
    public function routes()
    {

        $controller = (isset($_GET["controller"]) ? ucfirst(array_shift($_GET)) : "auth");
        $controller = "\\App\\controller\\" . $controller . "controller";
        
        $action = (isset($_GET["action"]) ? array_shift($_GET) : "register");


        if (class_exists($controller)) {
            
            $controller = new $controller();

            if (method_exists($controller, $action)) {
                
               (isset($_GET)) ? $controller->$action($_GET) : $controller->$action();
                
            } else {
                http_response_code(404);
                echo "Erreur 404 : La méthode " . htmlspecialchars($action) . " n'existe pas.";
            }

        } else {
            http_response_code(404);
            echo "Erreur 404 : Le contrôleur " . htmlspecialchars($controller) . " n'existe pas.";
        }
    }
}

?>