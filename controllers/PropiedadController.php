<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class PropiedadController {
    public static function index(Router $router) { // Router hace referencia a la clase que usaremos y $router a la variable que instanciamos desde index para no perder los datos almacenados
        
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router) {
        
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $propiedad = new Propiedad($_POST['propiedad']);

        // Generar un nombre unico y asignar el tipo de archivo (.jpg en este caso)
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $manager = new ImageManager(Driver::class); // Clase instanciada para poder usar intervention/image
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }


        $errores = $propiedad->validar();


        //Revisar que el arreglo de errores este vacio
        if(empty($errores)) { 
            // Crear Carpeta si no esta creada aún
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);


            $propiedad->guardar();
        } 
    }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        // Metodo $_POST para actualizar 
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Le pasamos a $args 
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            $errores = $propiedad->validar();

            $nombreImagen = md5( uniqid( rand(), true ) ) . "jpg";

            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class); // Clase instanciada para poder usar intervention/image
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600); // leer si hay una nueva imagen y cambiar al tamaño deseado
                $propiedad->setImagen($nombreImagen); // Almacenar el nombre unico al objeto para tener de referencia en la base de datos
            }

            if(empty($errores)) {

                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen); // Si hay una nueva imagen almacenarla, caso contrario ignorar y seguir con la imagen ya almacenada
                }

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
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
                    $propiedad = propiedad::find($id);
                    $propiedad->eliminar();
                } 

            }
        }
    }
}