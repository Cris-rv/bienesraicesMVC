<?php 

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    // protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email', 'imagen'];
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email'];

    // Atributos del objeto (__construct)
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    // public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        // $this->imagen = $args['imagen'] ?? '';
    }

public function validar() {

        if(!$this->nombre || $this->nombre === ' ') {
            self::$errores[] = "El nombre de el vendedor(a) es obligatorio";
        }

        if(!$this->apellido) {
            self::$errores[] = "El apellido de el vendedor(a) es obligatorio";
        }

        if(!$this->telefono) {
            self::$errores[] = "El teléfono de el vendedor(a) es obligatorio";
        }
        
        if( !preg_match('/[0-9]{8}/', $this->telefono) ) {
            self::$errores[] = "Formato telefono no valido o numeros insuficientes";
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL) || !$this->email ) {
            self::$errores[] = "El e-mail es obligatorio o no es valido";
        }

        // if(!$this->imagen) {
        //     self::$errores[] = "La imagen es obligatoria";
        // }

        return self::$errores; // retornamos $errores que para este entonces ya si no ha pasado la validacion tendra informacion dentro que sera impresa en pantalla
    }
}