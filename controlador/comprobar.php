<?php
$link = $_POST["link"];
$file_header = @get_headers($link);

if(isset($link)){
    $file_header = @get_headers($link);
    /* var_dump($file_header[0]); */
    if($file_header[0] == 'HTTP/1.1 403 Forbidden') {
        echo "no_existe";
    }
    else if($file_header[0] == 'HTTP/1.1 200 OK') {
        echo "existe";
    }

}
else{
    echo "Fuera de aca!";
}


?>





