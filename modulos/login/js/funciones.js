$(document).ready(function () {
$("#login_dni").numeric();
    $.post("modulos/login/obtener_perfil.php", function (data) {
        var dato = $.trim(data);
        $("#i_perfil").html(dato);
    });

    $('#i_perfil').change(function () {
        var i_perfil = $("#i_perfil").val();

        if (i_perfil == 1) {
             $('#cambiar_imagen').attr('src', 'paquetes/img/perfil/user_usuarios.png');
        } else if (i_perfil == 2) {
             $('#cambiar_imagen').attr('src', 'paquetes/img/perfil/user_supervisor.png');
        } else {
             $('#cambiar_imagen').attr('src', 'paquetes/img/perfil/user_admin.png');
        }
    });
    
    //********* EVITAR COPIAR Y PEGAR*******
     $('*').bind("cut copy paste",function(e) {

      e.preventDefault();

    });


});
    //************ CONTRASEÑA SEGURA *************
     function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
    //********************************************