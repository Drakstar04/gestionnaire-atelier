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

    
}


?>