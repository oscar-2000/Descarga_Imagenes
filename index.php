<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Descargar Imagenes</title>
        <!-- CSS BOOTSTRAP-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-3">
            <!-- FORMULARIO -->
            <label>Link</label>
            <input type="text" placeholder="Ingresar Link" id="link" name="link">
            <button type="button" class="btn btn-primary" onclick="MisImagenes();">Guardar a la lista</button><br>
            <h5 id="total_imagenes">Total imagenes:</h5>

            <!-- MENSAJES-->
            <div class="alert alert-danger mt-2" role="alert" id="error" hidden="hidden">
            Ha ocurrido un problema!
            </div>
            <div class="alert alert-success mt-2" role="alert" id="exito" hidden="hidden">
            Se ha subido correctamente la foto
            </div>
            <div class="alert alert-success mt-2" role="alert" id="descargado" hidden="hidden">
            Se ha descargado correctamente
            </div>

            <!-- TABLA -->
            <table class="table" style="width:75%;" id="tabla">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-center">Resolución</th>
                    <th scope="col" class="text-center">Peso</th>
                    <th scope="col" class="text-center">Opciones</th>
                </tr>
                <tbody id="dibujar_tabla">

                </tbody>
            </table>

            <!-- MODAL PARA VER IMAGEN -->
            <div class="modal fade" id="modal_imagen" tabindex="-1" role="dialog" aria-labelledby="imagen" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagen">Imagen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="cuerpo_modal">
                        <img src="" width="100%" height="100%" id="imagen_modal"/> 
                    </div>
                    <input type="hidden" value="" id="id_dentro_modal">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="0" id="contador_imagen">
        <input type="hidden" value="" id="modal_abierto">
    </body>
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    function MisImagenes() 
    {
        $("#error").attr("hidden","hidden");
        var link = $("#link").val();
        var contador_imagenes = $("#tabla tr").length;
        if(link != ""){
            $.post("http://localhost/Descarga_Imagenes/controlador/comprobar.php",
                {link: link},
                function(result){
                    if(result.trim() == "existe"){
                        $.post("http://localhost/Descarga_Imagenes/controlador/dibujar_tabla.php",
                            {link : link, contador_imagenes : contador_imagenes},
                            function(result){
                                var total = $("#total_imagenes").html("Total imagenes: "+contador_imagenes);
                                total+=contador_imagenes;
                                $("#contador_imagen").val(contador_imagenes);
                                $("#link").val("");
                                $("#exito").removeAttr("hidden");
                                $("#descargado").attr("hidden","hidden");
                                $("#dibujar_tabla").append(result);
                            }
                        );
                    }
                    else if(result.trim() == "NULL"){
                        $("#exito").attr("hidden","hidden");
                        $("#error").removeAttr("hidden");
                    }else{
                        $("#exito").attr("hidden","hidden");
                        $("#error").removeAttr("hidden");
                    }
                }
            );
            
        }
        else{
            $("#error").removeAttr("hidden");
        }
    }

    function Descargar(url){
        $.post("http://localhost/Descarga_Imagenes/prueba.php",
            {url: url},
            function(result){
                if(result == "exito"){
                    $("#descargado").removeAttr("hidden");
                    $("#exito").attr("hidden","hidden");
                }else{
                    alert("No se ha podido descargar");
                }
            }
        );
    }
        
    function VerImagen(link)
    {
        /* obtengo valor del boton */
        var cuerpo_modal = document.getElementById("cuerpo_modal");
        var imagen = document.getElementById("imagen_modal").src = link;
        var nueva_imagen = document.createElement("img");
        nueva_imagen.src = link;
        nueva_imagen.width = "100%";
        nueva_imagen.height = "100%";
        document.body.appendChild(nueva_imagen);

    }

    function EliminarImagen(link)
    {
        /* OBTENER ACTUALES TR */
        var contador = $("#tabla tr").length-2;
        var id_td = document.getElementById("linea");
        id_td.value = link;
        var td = document.getElementById("dibujar_tabla");
        td = id_td.parentNode;
        td.removeChild(id_td);
        ContarImagenes();
    }

    function ContarImagenes()
    {
        var contador = $("#tabla tr").length-1;
        $("#contador_imagen").val(contador);
        $("#total_imagenes").html("Total imagenes: "+contador);
    }
</script>
</html>