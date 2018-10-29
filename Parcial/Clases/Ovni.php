<?php

class Ovni{

    public $tipo;
    public $velocidad;
    public $planetaOrigen;
    public $pathFoto;

    public function __construct($tipo = 0, $velocidad= 0, $planetaOrigen ="Sin planeta", $pathFoto = "Sin path")
    {
        $this->tipo = $tipo;
        $this->velocidad = $velocidad;
        $this->planetaOrigen = $planetaOrigen;
        $this->pathFoto = $pathFoto;
    }

    public function ToJSON()
    {
        $claseEstandar = new stdClass();

        $claseEstandar->tipo = $this->tipo;
        $claseEstandar->velocidad = $this->velocidad;
        $claseEstandar->planetaOrigen = $this->planetaOrigen;
        $claseEstandar->pathFoto = $this->pathFoto;

        return json_encode($claseEstandar);
    }

    public function Agregar()
    {
        $conexion = 'mysql:host=localhost;dbname=aliens_bd;charset=utf8';
        $usuario='root';
        $clave='';

        try
        {
            $pdo = new PDO($conexion, $usuario, $clave);
            
            //Preparo la sentencia.
            //$sentencia = $pdo->prepare('INSERT INTO ovnis(tipo,velocidad,planeta,foto) VALUES ("'.$this->tipo.'","'. $this->velocidad.'",'.$this->planetaOrigen.',"'.$this->pathFoto.'")');
            $sentencia = $pdo->prepare('INSERT INTO ovnis(tipo,velocidad,planeta,foto) VALUES ("'.$this->tipo.'","'. $this->velocidad.'","'.$this->planetaOrigen.'","'.$this->pathFoto.'")');
            //Ejecuto la sentencia.
            $retornador = $sentencia->execute();

            var_dump($retornador);

            return $retornador;
        }
        catch(PDOException $e)
        {
            echo $e;
            return false;
        }
    }

    public static function Traer()
    {
        $conexion = 'mysql:host=localhost;dbname=aliens_bd;charset=utf8';
        $usuario='root';
        $clave='';

        try
        {
            $pdo = new PDO($conexion, $usuario, $clave);

            //Preparo la sentencia.
            $sentencia = $pdo->prepare('SELECT * FROM ovnis');

            if($sentencia->execute())
            {
                $ovni = NULL;
                $ovnis = NULL;

                //$fila = $sentencia->fetch(PDO::FETCH_ASSOC);
                //var_dump($fila);

                $sentencia->setFetchMode(PDO::FETCH_ASSOC);
                $sentencia->execute();
                print_r($sentencia->fetchAll());

                /*
                while($fila = $sentencia->fetch(PDO::FETCH_ASSOC))
                {
                    ini_set('memory_limit', '-1');

                    $ovni = new stdClass();//Atributos todos públicos.

                    //$tipo,$velocidad,$planetaOrigen,$pathFoto

                    $ovni->tipo = $fila['tipo'];
                    $ovni->velocidad = $fila['velocidad'];
                    $ovni->planetaOrigen = $fila['planeta'];
                    $ovni->pathFoto = $fila['foto'];

                    //$ovnis[] = array();
                    $ovnis[] = $ovni;
                }*/

                return $ovnis;
            }
        }
        catch(PDOException $e)
        {
            echo $e;
            return null;
        }
    }

    public function ActivarVelocidadWarp()
    {

    }

}

?>