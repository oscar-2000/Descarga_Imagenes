<?php
function Mover_Imagen($archivo,$nombre,$unico,$imagenes,$dir){
    $zip = new ZipArchive();
    $respuesta = $zip->open('descargas.zip');
    if($respuesta === TRUE) 
    {
        for($u = 0;$u < count($imagenes);$u++)
        {
            $zip->addFile($archivo."/".$nombre.$u.".jpg",$dir.$unico);
            echo $archivo."/".$nombre.$u.".jpg"."\n";
        }
    }
    $zip->close();
}