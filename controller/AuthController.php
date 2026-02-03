<?php

namespace App\controller;

use App\models\UserModel;
use App\entities\User;

class AuthController extends Controller
{
    public function register()
    {
        $error = null;

        if (isset($_POST) && !empty($_POST)) {
            
            if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
                
                $name = htmlspecialchars($_POST["name"]);
                $email = htmlspecialchars($_POST["email"]);
                $password = $_POST["password"];

                $userModel = new UserModel();

                if ($userModel->findByEmail($email)) {
                    $error = "Cet email est déjà utilisé.";
                } else {
                    $user = new User();
                    $user->setName_users($name);
                    $user->setEmail_users($email);
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $user->setPassword_users($passwordHash);
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

                        header("Location: index.php?controller=workshop&action=workshopList");
                        exit;
                    }
                }
            } else {
                $error = "Veuillez remplir tous les champs.";
            }
        }

        $this->render("authentification/register", ["error" => $error]);
    }



    public function login()
    {
        $error = null;
        if (isset($_POST) && !empty($_POST)) {

            if (!empty($_POST["email"]) && !empty($_POST["password"])) {
                
                $email = htmlspecialchars($_POST["email"]);
                $password = $_POST["password"];
             
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

                } else {
                    $error = "Identifiants incorrects.";
                }
            } else {
                $error = "Veuillez remplir tous les champs.";
            }
        }

        $this->render("authentification/login", ["error" => $error]);
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