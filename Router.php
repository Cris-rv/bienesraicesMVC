<?php 

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {

        session_start();
        $auth = $_SESSION['login'] ?? null;


        // Arreglo de rutas protegidas
        // $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null; // Mediante el codigo en $urlActual filtramos dentro de nuestro arreglo, para traer la fn asociada a cada url ($key)
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // // Si la url actual es la misma que la url protegida y no esta autenticado redireccionamos al usuario
        // if(in_array($urlActual, $rutas_protegidas) && !$auth) {
        //     header('Location: /');
        // }

        if($fn) {
            // Si la URL existe y hay una funcion asociada a la ruta que el usuario esta visitando entonces:
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }

    // Muestra una vista
    public function render($view, $datos = []) {
        foreach($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Inicia el almacenamiento en memoria.
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el buffer
        include __DIR__ . "/views/layout.php";
    }
}