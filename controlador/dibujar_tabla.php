<?php
$link = $_POST["link"];
$contador_imagenes = $_POST["contador_imagenes"];
$resolucion = getimagesize($link);


function ObtenerTamañoArchivo($link, $fallback_to_download = false)
{
    try
    {
        static $regex = '/^Content-Length: *+\K\d++$/im';
        if (!$fp = @fopen($link, 'rb')) {
            return false;
        }
        if (isset($http_response_header) && preg_match($regex, implode("\n", $http_response_header), $matches)) {
            return (int)$matches[0];
        }
        if (!$fallback_to_download) {
            return false;
        }
        return strlen(stream_get_contents($fp));
        }
    catch(Exception $e)
    {
        return "No se ha podido obtener";
    }
}

?>
<tr id="linea" value="<?php echo $link;?>" class="imagenes">
    <th scope="row" id="numero_fila"><?php echo $contador_imagenes; ?></th>
    <td class="text-center"><?php echo $resolucion[0]?> x <?php echo $resolucion[1]?></td>
    <td class="text-center"><?php echo round(ObtenerTamañoArchivo($link),2);?> KB</td>
    <td class="text-center">
        <form action="prueba.php" method="POST">
            <button type="button" class="btn btn-success boton-descargar" value="<?php echo $link;?>" onclick="Descargar(this.value)">Descargar</button>
            <button class="btn btn-primary" type="button" data-toggle="modal" id="boton_imagen" value="<?php echo $link;?>" data-target="#modal_imagen" onclick="VerImagen(this.value);">Ver</button>
            <button class="btn btn-danger" type="button" data-toggle="modal" id="boton_eliminar"value="<?php echo $link;?>" data-target="#eliminar_imagen" onclick="EliminarImagen(this.value);">Eliminar</button>
        </form>
    </td>
</tr>




