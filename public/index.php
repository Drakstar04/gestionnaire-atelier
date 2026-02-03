<?php       
session_start();

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

use App\Autoloader;
use App\core\Router;

include "../Autoloader.php";
Autoloader::register();

$route = new Router();

$route->routes();

?>