<?php
$imagenes = $_POST["imagenes"];
if(isset($imagenes)){
    try{
        for($i = 0;$i < count($imagenes);$i++){
            $nombre = uniqid() . ".jpg";
            $dir = "C:/Users/Oscar/Downloads/TRANSFERIR/";
            $imagen = file_get_contents($_POST["imagenes"][$i]); //OBTENEMOS IMAGEN
            file_put_contents($dir . $nombre,$imagen);
        }
        echo "exito";
    }
    catch(Exception $e){
        echo "Ha ocurrido un error: ".$e;
    }  
}
else{
    echo "Fuera de aca";
}
?>





