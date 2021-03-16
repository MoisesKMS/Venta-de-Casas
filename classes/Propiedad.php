<?php

namespace App;

class Propiedad {
    // Base de Datos
    protected static $db;
    protected static $columnasBD = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    //Errores

    protected static $errores = [];


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

    //Definir la conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardar() {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Insertar en la Base de Datos
        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);
        
        return $resultado;
    }

    //Identificar y unir los atributos de la BD
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasBD as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen){
        //Asignar al atributo de imagen el nombre de la imagen;
        if($imagen){
            $this->imagen = $imagen;
        }
    }


    //Validacion
    public static function getErrores(){
        return self::$errores;
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

    //Lista todas las propiedades
    public static function all(){
        $query = "SELECT * FROM propiedades";
        
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca un registro por su ID
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //COnsultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;
        
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
    }

    //Sincroniza el obj en memoria con los cambios del usuario

    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}