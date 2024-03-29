window.addEventListener('DOMContentLoaded',function(){
    const btn = document.getElementById('descargar_todo');
    $( "#selec_compresion")
    .change(function() {
        $( "#selec_compresion :selected" ).each(function() {
            const opcion = $( this ).text();
            if(opcion == "ZIP"){
                console.log('generar cambio');
                $("#descargar_todo").removeAttr('disabled');
                $("#descargar_todo").removeAttr('style');
            }
            else{
                btn.style.pointerEvents = "none";
                btn.disabled = true;
            }
        });
    })
    .trigger( "change" );
});



function EliminarTemporal(){
    $.post("http://localhost/Descarga_Imagenes/controlador/eliminar.php",
    {},
        function(result){
            alert(result);
        }
    );
}
function AñadirImagen() 
{
    $("#error").attr("hidden","hidden");
    var link = $("#link").val();
    var contador_imagenes = $("#tabla tr").length;
    if(link != "")
    {
        var repetida = false;
        var imagenes = [];
        $('.boton-descargar').each(function(index,value) {
            var prueba = $(value).val();
            imagenes.push(prueba);
        });
        for(var i = 0; i < imagenes.length;i++){
            if(imagenes[i] == link){
                alert("Imagen ya esta en la lista");
                repetida = true;
            }
            else{repetida = false;}
        }
        if(repetida == false)
        {
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
    }
    else{
        $("#error").removeAttr("hidden");
    }
}
function DescargarTodo(){
    $("#mensaje_descarga").removeAttr("hidden");
    var imagenes = [];
    var opcion = $("#selec_compresion option:selected").val();
    $('.boton-descargar').each(function(index,value) {
        var prueba = $(value).val();
        imagenes.push(prueba);
    });
    if(imagenes.length == 0){
        alert("Ingrese una imagen");
        $("#mensaje_descarga").attr("hidden","hidden");
        return;
    }
    else if(imagenes.length > 0){
        $.post("http://localhost/Descarga_Imagenes/controlador/descarga_multiple.php",
        {imagenes: imagenes, opcion: opcion},
            function(result){
                if(result.trim() == "exito"){
                    alert("Se ha descargado todas las imagenes");
                    window.location.href="controlador/descarga.zip";
                    $("#mensaje_descarga").attr("hidden","hidden");
                    VaciarImagenes();
                }
                else if(result.trim() == "exito_no_compresion")
                {
                    alert("Se ha descargado todas las imagenes");
                    $("#mensaje_descarga").attr("hidden","hidden");
                }
                else{
                    alert("Ha fallado la descarga de todas las imagenes");
                }
            }
        );
    }
}

function VaciarImagenes(){
    $.post("http://localhost/Descarga_Imagenes/controlador/vaciar_img.php",
    {},
    function(result){
        if(result.trim() === "exito"){
            console.log('Se ha vaciado con exito las imagenes');
        }
        else{
            console.log('No se ha podido borrar las imagenes');
        }
    });
}

function Descargar(url){
    $.post("http://localhost/Descarga_Imagenes/controlador/descarga.php",
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
    var id_td = document.getElementById(link);
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