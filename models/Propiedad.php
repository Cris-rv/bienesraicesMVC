<?php 

namespace Model;

class Propiedad extends ActiveRecord {
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorid'];

    // Propiedades del objeto (__construct)
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorid;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date("Ymd");
        $this->vendedorid = $args['vendedorid'] ?? '';
    }

    public function validar() {

        if(!$this->titulo || $this->titulo === ' ') {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = "El precio es obligatorio y debe ser menor a 9 digitos";
        }

        if(!$this->habitaciones) {
            self::$errores[] = "La cantidad de habitaciones es obligatorio";
        }

        if(!$this->wc) {
            self::$errores[] = "La cantidad de baños es obligatorio";
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "El numeró de lugares de estacionamiento es obligatorio";
        }

        if(!$this->vendedorid) {
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores; // retornamos $errores que para este entonces ya si no ha pasado la validacion tendra informacion dentro que sera impresa en pantalla
    }
}