<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $columnasBD = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes Añadir un Titulo";
        }

        if(!$this->precio){
            self::$errores[] = "El Precio es Obligatorio";
        }

        if(strlen($this->descripcion)<50){
            self::$errores[] = "La Descripcion es Obligatoria y debe tener al menos 50 Caracteres";
        }

        if(!$this->habitaciones){
            self::$errores[] = "El Numero de habitaciones es Obligatorio";
        }

        if(!$this->wc){
            self::$errores[] = "El Numero de baños es Obligatorio";
        }

        if(!$this->estacionamiento){
            self::$errores[] = "El Numero de estacionamieto es Obligatorio";
        }

        if(!$this->vendedorId){
            self::$errores[] = "Elije un Vendedor";
        }

       if(!$this->imagen){
            self::$errores[] = "La imagen es Obligatoria";
        }

        return self::$errores;
    }
}