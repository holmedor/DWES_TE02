<?php declare(strict_types=1);  //Devuelve "OK" si la letra del DNI es correcta 
function dniok($dni){           //y si no lo es devuelve la letra que le correspondería
    $modulo=array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
    if (empty($dni)){
        return false;
    } else {
        $letra=substr($dni,-1);
        $numero=trim($dni,$letra);
        $res=$modulo[$numero%23];
        if($letra==$res)    {
            return "OK";
        }   else {
            return $res;
        }
    }
}

function fechaok($fecha){       //Devuelve true si la fecha es igual o posterior a la del día actual 
    $hoy=date("Y-m-d",time());
    $fecha_hoy = strtotime($hoy);
    $fecha_entrada = strtotime($fecha);    
    if($fecha_entrada < $fecha_hoy ){
        return false;
    }else{
        return true;
    }
}

function fecha_devol($fecha){   //Devuelve la fecha de devolución (Día indicado más 10 días)
    $fechadev=date("d/m/Y",strtotime($fecha. "+ 10 days")); //sumo 10 días
    return $fechadev;
}

function librook($biblioteca,$libro){ //Devuelve true si el libro no está como alquilado en la biblioteca
    $libre=true;
    foreach($biblioteca as $alquilado){
        if ($alquilado==$libro){
            $libre=false;
        }
    }
    return $libre;
}

function guardar_alquiler($biblioteca,$libro){ //Almacena el libro en la biblioteca de libros alquilados
    array_push($biblioteca,$libro);  
    return $biblioteca; 
}
?>