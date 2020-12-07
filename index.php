<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Descargar Imagenes</title>
        <!-- CSS BOOTSTRAP-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="controlador/funciones.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container mt-3">
            <!-- FORMULARIO -->
            <label>URL</label>
            <input type="text" placeholder="Ingresar URL" id="link" name="link">
            <button type="button" class="btn btn-primary" onclick="AñadirImagen();">Guardar a la lista</button>
            <button type="button" class="btn btn-success" onclick="DescargarTodo();">Descargar todo</button><br>
            <!-- ELECCION DE COMPRESION DE ARCHIVO -->
            <div class="input-group mb-3 mt-3" style="width:50vh">
                <div class="input-group-prepend">
                    <label class="input-group-text">Compresion de archivo</label>
                </div>
                <select class="custom-select" id="selec_compresion">
                    <option value="0">Ninguno</option>
                    <option value="1">ZIP</option>
                </select>
            </div>
            <h5 id="total_imagenes">Total imagenes:</h5><br>

            <!-- MENSAJES-->
            <div class="btn-group" role="group" aria-label="Basic example" id="mensaje_descarga" hidden>
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                <span>Descargando..</span>
            </div>
            <div class="alert alert-danger mt-2" role="alert" id="error" hidden="hidden">
            Ha ocurrido un problema!
            </div>
            <div class="alert alert-success mt-2" role="alert" id="exito" hidden="hidden">
            Se ha subido correctamente la foto
            </div>
            <div class="alert alert-success mt-2" role="alert" id="descargado" hidden="hidden">
            Se ha descargado correctamente
            </div>
            <br>
            <label>By Souls</label>
            <img src="img/pepega.gif" width="60px" heigh="auto"/>
            
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
</html>