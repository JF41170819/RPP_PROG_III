<?php

    require_once "./Clases/Alien.php";

    if((isset($_POST['planeta']) && isset($_POST['email']) && isset($_POST['clave'])))
    {
        $planeta = $_POST['planeta'];
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        $alien = new Alien($planeta, $email, $clave);

        //var_dump(Alien::TraerTodos());

        $std = Alien::VerificarExistencia($alien);

        if($std->exito)
        {
            echo "El alien está.";

            date_default_timezone_set('America/Argentina/Buenos_Aires');            

            $nombre = $email . "_" . $planeta;

            $valor = date("H:i:s") . $std->mensaje;

            setcookie($nombre, $valor, time()+999999);

            header("Location: ListadoAliens.php");
        }
        else
        {
            echo "El alien no está.";
            echo "Hay " . $std->mismoplaneta . " en el mismo planeta";
            echo $std->exito;
            echo $std->mensaje;
        }
    }

?>


