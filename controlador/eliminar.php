<?php
try{
    unlink('descarga.zip');//Destruye el archivo temporal
    echo "exito";
}
catch(Exception $e){
    echo "Ha ocurrido un error: ".$e;
}  