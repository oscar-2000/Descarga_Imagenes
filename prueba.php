<?php
$url = $_POST["url"];
if(isset($url))
{
   try
   {
      $nombre = uniqid() . ".jpg";
      $dir = "C:/Users/Oscar/Downloads/TRANSFERIR/";

      $imagen = file_get_contents($_POST["url"]); //OBTENEMOS IMAGEN
      file_put_contents($dir . $nombre,$imagen);
      }      
   catch(Exception $e){
      echo "Ha ocurrido un error: ".$e;
   }      
}
else{
echo "Fuera de aca!";
}

