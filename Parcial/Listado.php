<?php

    require_once "./Clases/Ovni.php";

    $ovnis = Ovni::Traer();

    //$auxJson = json_encode($ovnis);

    var_dump($ovnis);

?>