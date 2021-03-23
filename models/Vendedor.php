<?php

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnasBD = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar()
    {
        if(!$this->nombre){
            self::$errores[] = "Debes Añadir un Nombre";
        }

        if(!$this->apellido){
            self::$errores[] = "Debes Añadir un Apellido";
        }

        if(!$this->telefono){
            self::$errores[] = "Debes Añadir un Telefono";
        }

        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "Formato de telefono no Valido";
        }

        return self::$errores;
    }
}