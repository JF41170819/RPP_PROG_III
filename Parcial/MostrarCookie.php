<?php

    require_once "./Clases/Alien.php";

    if(isset($_GET['planeta']) && isset($_GET['email']))
    {
        $planeta = $_GET['planeta'];
        $email = $_GET['email'];

        $claseEstandar = new stdClass();

        $claseEstandar->exito = true;
        $claseEstandar->mensaje = "Hay cookie con el siguiente email";

        $nombre = $email . "_" . $planeta;

        echo $nombre;

        var_dump($_COOKIE);

        if(isset($_COOKIE[$nombre]))
        {
            $claseEstandar->exito = false;
            $claseEstandar->mensaje = $_COOKIE[$nombre];
        }

        var_dump($claseEstandar);
        return json_encode($claseEstandar);
    }

?>