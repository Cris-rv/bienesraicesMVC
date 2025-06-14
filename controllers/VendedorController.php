<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    
    public static function crear(Router $router) {

        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vendedor = new Vendedor($_POST['vendedor']);

            $errores = $vendedor->validar();

            if(empty($errores)) {

                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        
        $id = validarORedireccionar('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Le pasamos a $args 
                $args = $_POST['vendedor'];

                $vendedor->sincronizar($args);

                $errores = $vendedor->validar();

                if(empty($errores)) {

                    $vendedor->guardar();
                }
        }

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {

                $tipo = $_POST['tipo'];

                // Si el tipo es valido entonces vamos a ejecutar el codigo de eliminar segun sea vendedor o propiedad
                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                } 

            }
        }
    }
}