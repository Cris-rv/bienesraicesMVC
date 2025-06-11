<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {

    public static function login(Router $router) {

        $errores = Admin::getErrores(); 

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)) {
                // Verificamos si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado) {
                    // Verificamos si el usuario existe o no (mensaje de error)
                    $errores = Admin::getErrores();
                } else {
                    // Verificamos contraseña 
                    $autenticado = $auth->comprobarPassword($resultado);

                    if($autenticado) {
                    // Autenticamos al usuario
                    $auth->autenticar();
                    } else {
                    // mensaje de password incorrecto
                    $errores = Admin::getErrores();
                    }

                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(Router $router) {

        session_start();

        $_SESSION = [];

        header('Location: /');
    }
}