<?php

class Alien{

    private $_planeta;
    private $_email;
    private $_clave;

    public function __construct($planeta, $email, $clave)
    {
        $this->_planeta = $planeta;
        $this->_email = $email;
        $this->_clave = $clave;
    }

    public function getPlaneta()
    {
        return $this->_planeta;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getClave()
    {
        return $this->_clave;
    }

    public function ToJSON()
    {
        $claseEstandar = new stdClass();

        $claseEstandar->planeta = $this->_planeta;
        $claseEstandar->email = $this->_email;
        $claseEstandar->clave = $this->_clave;

        return json_encode($claseEstandar);
    }

    public function GuardarEnArchivo()
    {
        clearstatcache();

        $claseEstandar = new stdClass();

        $claseEstandar->exito = false;
        $claseEstandar->mensaje = "Error, el alien no se ha podido guardar";

        if($archivo = fopen("./Archivos/Alien.json", "a+"))//Modo a, para ir agregando varias cosas al archivo
        {
            $auxJSON = $this->ToJSON();

            if(filesize("./Archivos/Alien.json") > 0)
            {
                $auxJSON = "\r\n" . $auxJSON;
            }

            if(fwrite($archivo, $auxJSON))
            {
                $claseEstandar->exito = true;
                $claseEstandar->mensaje = "El alien se ha guardado correctamente!";
            }

            fclose($archivo);

        }

        return json_encode($claseEstandar);
    }

    public static function TraerTodos()
    {
        $arrayAliens = array();

        if($plectura = fopen("./Archivos/Alien.json", "r+"))
        {
            while(!feof($plectura))
            {
                $alien = fgets($plectura);

                $alien = trim($alien);
                
                array_push($arrayAliens, $alien);
            }

            fclose($plectura);
        }

        return $arrayAliens;
    }

    public static function VerificarExistencia($alien)
    {
        $arrayAliens = Alien::TraerTodos();

        $claseEstandar = new stdClass();

        $claseEstandar->exito = false;
        $claseEstandar->mensaje = "El alien no existe.";

        for($i = 0; $i < count($arrayAliens); $i++)
        {
            $auxAlien = explode('"', $arrayAliens[$i]);

            //var_dump($auxAlien);

            for($j = 0; $j < count($auxAlien); $j++)
            {
                //echo $auxAlien[$j] . "\r\n";

                if($auxAlien[$j] == $alien->getEmail() && $auxAlien[$j+4] == $alien->getClave())
                {
                    $claseEstandar->exito = true;
                    $claseEstandar->mensaje = "El alien existe.";
                    break;
                }
            }
        }

            $contador = 0;

                for($i = 0; $i < count($arrayAliens); $i++)
                {
                    $auxAlien = explode('"', $arrayAliens[$i]);
        
                    for($j = 0; $j < count($auxAlien); $j++)
                    {
                        if($auxAlien[$j] == $alien->_planeta)
                        {
                            $contador++;
                        }
                    }
                }

                $claseEstandar->mismoplaneta = $contador;
            
            

        return $claseEstandar;
    }
}    

?>