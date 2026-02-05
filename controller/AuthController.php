<?php

namespace App\controller;

use App\models\UserModel;
use App\entities\User;

class AuthController extends Controller
{
    public function register()
    {
        if (isset($_POST) && !empty($_POST)) {

            $name = trim(htmlspecialchars($_POST["name"]));
            $email = trim(htmlspecialchars($_POST["email"]));
            $password = $_POST["password"];

            if (empty($name) || empty($email) || empty($password)) {
                $_SESSION["error"] = "Tous les champs sont obligatoires.";
            } 
            elseif (mb_strlen($name) < 2) {
                $_SESSION["error"] = "Le nom est trop court (min 2 caractères).";
            }
            elseif (mb_strlen($name) > 30) { 
                $_SESSION["error"] = "Le nom ne doit pas contenir plus de 30 caractères.";
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION["error"] = "Le format de l'email est invalide.";
            }
            elseif (strlen($password) < 8) {
                $_SESSION["error"] = "Le mot de passe doit faire au moins 8 caractères.";
            }
            else {
                $userModel = new UserModel();
                if ($userModel->findByEmail($email)) {
                    $_SESSION["error"] = "Cet email est déjà utilisé.";
                } else {
                    $user = new User();
                    $user->setName_users($name);
                    $user->setEmail_users($email);
                    $user->setPassword_users(password_hash($password, PASSWORD_DEFAULT));
                    $user->setId_roles(2);
                    
                    $userModel->create($user);

                    $newUser = $userModel->findByEmail($email);

                    if ($newUser) {
                        $_SESSION["user"] = [
                            "id_user" => $newUser->id_users,
                            "name_user" => $newUser->name_users,
                            "email_user" => $newUser->email_users,
                            "id_role" => $newUser->id_roles
                        ];

                        $_SESSION["success"] = "Compte créé !";

                        header("Location: index.php?controller=workshop&action=workshopList");
                        exit;
                    }
                }
            }
        }
        $this->render("authentification/register");
    }



    public function login()
    {
        if (isset($_POST) && !empty($_POST)) {
        
            $email = trim(htmlspecialchars($_POST["email"]));
            $password = $_POST["password"];

            if (empty($email) || empty($password)) {
                $_SESSION["error"] = "Tous les champs sont obligatoires.";
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION["error"] = "Le format de l'email est invalide.";
            }
            elseif (strlen($password) < 8) {
                $_SESSION["error"] = "Le mot de passe doit faire au moins 8 caractères.";
            }
            else {
                $userModel = new UserModel();
                $user = $userModel->findByEmail($email);

                if ($user && password_verify($password, $user->password_users)) {
                
                    $_SESSION["user"] = [
                        "id_user" => $user->id_users,
                        "name_user" => $user->name_users,
                        "email_user" => $user->email_users,
                        "id_role" => $user->id_roles
                    ];

                    header("Location: index.php?controller=workshop&action=workshopList");
                    exit;

                }
            }
        }
        $this->render("authentification/login");
    }

    public function logout() 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_destroy();
        header("Location: index.php?controller=auth&action=login");
    }

}
?>