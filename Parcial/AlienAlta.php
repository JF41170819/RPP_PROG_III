<?php

    require_once "./Clases/Alien.php";

    if(isset($_POST['planeta']) && isset($_POST['email']) && isset($_POST['clave']))
    {
        $planeta = $_POST['planeta'];
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        $alien = new Alien($planeta, $email, $clave);

        $retorno = $alien->GuardarEnArchivo();
        
        var_dump($retorno);
    }

?>