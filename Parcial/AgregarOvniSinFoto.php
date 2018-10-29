<?php
    
    require_once "./Clases/Ovni.php";

    echo $_POST['tipo'];
    echo $_POST['velocidad'];
    echo $_POST['planetaOrigen'];


    if(isset($_POST['tipo']) && isset($_POST['velocidad']) && isset($_POST['planetaOrigen']))
    {
         //$tipo,$velocidad,$planetaOrigen,$pathFoto

        $tipo = $_POST['tipo'];
        $velocidad = $_POST['velocidad'];
        $planetaOrigen = $_POST['planetaOrigen'];

        $ovni = new Ovni($tipo, $velocidad, $planetaOrigen);

        if($ovni->Agregar())
        {
            echo "Exito!<br>";
        }
        else
        {
            echo "Error al agregar<br>";
        }
    }
    else
    {
        echo "Error al recibir variables por POST!<br>";
    }

?>