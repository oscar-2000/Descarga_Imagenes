<?php
try
{
    $archivo_n = "ImagenesBySouls";
    foreach(glob($archivo_n . "/*") as $archivos_carpeta)
    {             
        if (is_dir($archivos_carpeta)){
            Vaciar_Carpeta($archivos_carpeta);
        } else {
        unlink($archivos_carpeta);
        }
    }
    rmdir($archivo_n);
    echo "exito";
    
}
catch(Exception $e){
    echo "Ha ocurrido un error: ".$e;
}  
?>





