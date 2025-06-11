<?php 

namespace Model;

class ActiveRecord {
    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores / Validacion
    protected static $errores = [];

    // Definir la conexion a la DB -- Referencia a la base de datos 
    public static function setDB($conexion) {
        self::$db = $conexion; // self::objetos/metodos estaticos - $this->variables
    }

    public function guardar() {
        if( !is_null($this->id) ) {
            // Actualizar
            $this->actualizar();
        } else {
            // Crear un nuevo registro
            $this->crear();
        }
    }

    public function crear() {

            // Sanitizar los datos
            $atributos = $this->sanitizarAtributos();

            // Ingresar en la base de datos
            // $query = "INSERT INTO propiedades ( "; join(', ', array_keys($atributos)); " ) VALUES ( ' "; join(", ", array_values($atributos)); " ') ";
            
            $query = " INSERT INTO " . static::$tabla . " ( ";
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES (' "; 
            $query .= join("', '", array_values($atributos)); 
            $query .= " ') ";
            $resultado = self::$db->query($query);

            if($resultado) {
                // Redireccionar al usuario
                header("Location: /admin?resultado=1");
            }
    }

    public function actualizar() {
            $atributos = $this->sanitizarAtributos();

            $valores = [];
            foreach($atributos as $key => $value) {
                $valores[] = "$key='$value'"; // Retorna "titulo= 'Mansion Maygur'" en cada campo
            }

            $query = "UPDATE ". static::$tabla ." SET ";
            $query .= join(', ', $valores); 
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1 ";

            $resultado = self::$db->query($query);

            if($resultado) {
                // Redireccionar al usuario
                header("Location: /admin?resultado=2");
            }
    }

    // Eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            // Redireccionar al usuario
            header("Location: /admin?resultado=3");
        }
    }

    // Identificar y unir los atributos.
    public function atributos() {
            // $atributos = [ $key = 'titulo' = $value = '$this->titulo' ya que $this contiene la informacion obtenida del usuario
            // 'titulo' => $this->titulo,
            // 'precio' => $this->precio,
            // 'imagen' => $this->imagen,
            // 'descripcion' => $this->descripcion,
            // 'habitaciones' => $this->habitaciones,
            // 'wc' => $this->wc,
            // 'estacionamiento' => $this->estacionamiento,
            // 'creado' => $this->creado,
            // 'vendedorid' => $this->vendedorid,
            // ];

            $atributos = [];

            foreach(static::$columnasDB as $columna) {
                if($columna === 'id') continue;
                $atributos[$columna] = $this->$columna;
            }

            return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Validacion

    public static function getErrores() { // Retornamos el objeto estatico de $errores = []; que es un arreglo vacio para hacer uso de el en crear.php
        return static::$errores;
    }

    public function validar() {
        static::$errores = []; // Limpiamos el arreglo para generar nuevos errores
        return static::$errores; // retornamos $errores que para este entonces ya si no ha pasado la validacion tendra informacion dentro que sera impresa en pantalla
    }

    public function setImagen($imagen) { // Si hay una nueva $imagen entonces almacena el nombre en $this->imagen para tener la referencia a la imagen que se almacenara en el servidor
        // Elimina la imagen previa
        if( !is_null($this->id) ) { // Si hay un id quiere decir que estamos actualizando, caso contrario ignora este if y pasa al siguiente 
            $this->borrarImagen();
        }
        
        // Asignar la imagen en el campo imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Elimina el archivo (.jpg)
    public function borrarImagen() {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Lista todos los registros como objetos segun el estandar de active Record
    public static function all() {
    $query = "SELECT * FROM " . static::$tabla; // static va a buscar el atributo en la clase que se esta heredando

    $resultado = self::consultarSQL($query);

    return $resultado;

    }

    // Obtiene determinado número de registros
    public static function get($cantidad) {
    $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad; // static va a buscar el atributo en la clase que se esta heredando

    $resultado = self::consultarSQL($query);

    return $resultado;

    }

    // busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";  

        $resultado = self::consultarSQL($query);

        return array_shift($resultado); // Array_shift comienza el arreglo desde su segundo campo en este caso omitiendo el id
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];

        while($registo = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registo);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registo) {
        $objeto = new static; // Crear una nueva instancia dentro de la clase o sea un espejo del __construct con la informacion de default que le asignamos en ?? ''

        foreach($registo as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realiados por el usuario
    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) { // si existe el key en el constructor entonces mapea los objetos y si hay alguna coincidencia en dichos objetos reescribe el nuevo valor
                $this->$key = $value;
            }
        }
    }
}