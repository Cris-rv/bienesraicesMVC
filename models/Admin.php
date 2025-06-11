<?php

namespace Model;

class Admin extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL) || !$this->email ) {
            self::$errores[] = "El e-mail es obligatorio o no es valido";
        }

        if(!$this->password) {
            self::$errores[] = 'El password es obligatorio';
        }

        return self::$errores;
    }

    public function existeUsuario() {
        // Revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if(!$resultado->num_rows) {
            self::$errores[] = "Este usuario no existe o no coincide";
            return;
        } 

        return $resultado;
    }

    public function comprobarPassword($resultado) {

        // Convertimos el resultado en un arreglo asociativo (id, email, password)
        $usuario = $resultado->fetch_object();

        // Autenticamos al usuario comparando el password de $_POST con el que tenemos en la DB
        $autenticado = password_verify($this->password, $usuario->password);

        // Si no hay coincidencias (false) entonces mostramos este mensaje
        if(!$autenticado) {
            self::$errores[] = "El password es incorrecto";
        }

        // en ambos casos ya sea true o false retornamos para obtener el valor en la vista
        return $autenticado;
    }

    public function autenticar() {
        
        session_start();

        // Llenar el arreglo de sesion
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
};