<?php
$imagenes = $_POST["imagenes"];
$opcion = $_POST["opcion"];
if(isset($imagenes) && isset($opcion)){
    try
    {
        /* ARCHIVO ZIP */
        $archivo_zip = "descarga.zip";
        $zip = new ZipArchive();
        
        /* CARPETA CON LAS IMAGENES */
        $nombre = "imagen_s";
        $archivo_n = "ImagenesBySouls";
        if(!is_dir($archivo_n)){
            mkdir($archivo_n);
        }
        $ruta_n = "/xampp/htdocs/Descarga_Imagenes/controlador/";
        if($opcion == "0")
        {
            /* AGREGARA IMAGENES A CARPETA "IMAGENES" */
            for($i = 0;$i < count($imagenes);$i++)
            {
                //OBTENEMOS IMAGEN
                $imagen = file_get_contents($_POST["imagenes"][$i]);
                file_put_contents($ruta_n.$archivo_n."/".$nombre.$i.".jpg",$imagen);
            }
            echo "exito_no_compresion";
        }
        if($opcion == "1")
        {
            /* AGREGARA IMAGENES A CARPETA "IMAGENES" */
            for($i = 0;$i < count($imagenes);$i++)
            {
                //OBTENEMOS IMAGEN
                $imagen = file_get_contents($_POST["imagenes"][$i]);
                file_put_contents($ruta_n.$archivo_n."/".$nombre.$i.".jpg",$imagen);
            }
            if($zip->open($archivo_zip,ZipArchive::CREATE == TRUE))
            {
                for($i = 0;$i < count($imagenes);$i++)
                {
                    $zip->addFile($archivo_n."/".$nombre.$i.".jpg");
                }
                echo "exito";
            }
            /* Vaciar_Carpeta($archivo_n); */
        }
    }
    catch(Exception $e){
        echo "Ha ocurrido un error: ".$e;
    }  
}
else{
    echo "Fuera de aca";
}
function Vaciar_Carpeta($carpeta)
{
    foreach(glob($carpeta . "/*") as $archivos_carpeta)
    {             
        if (is_dir($archivos_carpeta)){
            Vaciar_Carpeta($archivos_carpeta);
        } else {
        unlink($archivos_carpeta);
        }
    }
    rmdir($carpeta);
}
?>





