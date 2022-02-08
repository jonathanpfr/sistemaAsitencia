$(document).ready(function () {
    var timeSlide = 1000;
    $('#login_username').focus();
    $('#timer').hide(0);
    $('#timer').css('display', 'none');
    $('#login_userbttn').click(function () {

        $('#timer').fadeIn(300);
        $('.box-info, .box-success, .box-alert, .box-error').slideUp(timeSlide);
        setTimeout(function () {
            $.ajax({
                type: "POST",
                url: "clases/login/log.inout.ajax.php",
                data: {ruc: $('#empresa').val()},
                cache: false,
                success: function (result) {
                    //alert(result);
                    var bd = result;
                    validar(bd);
                },
                error: function (result) {
                    alert("error");
                }
            });

            function validar(bd) {

                if ($('#login_username').val() != "" && $('#login_userpass').val() != "") {
                    $.ajax({
                        type: 'POST',
                        url: 'clases/login/log.inout.ajax.php',
                        data: 'login_dni=' + $('#login_dni').val() + '&login_pass=' + $('#login_pass').val() + '&i_perfil=' + $('#i_perfil').val() + '&bd=' + bd,
                        success: function (msj) {

                            //alert(msj);
                            if (msj != 0) {
                                 alertify.success("login correcto , bienvenido");
                                $('#alertBoxes').html('<div class="box-success"></div>');
                                $('.box-success').hide(0).html('Espera un momento&#133;');
                                $('.box-success').slideDown(timeSlide);
                                setTimeout(function () {
                                    
                                    if (msj == 1) {
                                        window.location.href = "modulos/principal/principal_usuario.php";
                                    } else if (msj == 2) {
                                        window.location.href = "modulos/principal/principal_supervisor.php";
                                    } else if (msj == 3) {
                                        window.location.href = "modulos/principal/principal.php";
                                    } else {

                                        $('#alertBoxes').html('<div class="box-success"></div>');
                                        $('.box-success').hide(0).html(msj);
                                        $('.box-success').slideDown(timeSlide);
                                    }

                                }, (timeSlide + 500));
                            } else {
                                var login_dni = $('#login_dni').val();
                                $.post("seguridad_clave.php",{login_dni:login_dni}, function (data) {
                                    var dato = $.trim(data);
//                                  alert(dato);
                                  if(dato==1){
                                       alertify.alert('Ha intentado 3 veces sin tener exito, por motivos de seguridad su contraseña a sido cambiada, consulte con el administrador').set('basic', true);
                                       alertify.error("Contraseña cambiada");
//                                        alert("Ha intentado 3 veces sin tener exito, por motivos de seguridad su contraseña a sido cambiada, consulte con el administrador");
                                  }
                                });
                                  alertify.error("Datos Incorrectos");
                                $('#alertBoxes').html('<div class="box-error"></div>');
                                $('.box-error').hide(0).html('Lo sentimos, pero los datos son incorrectos: ' + msj);
                                $('.box-error').slideDown(timeSlide);
                            }
                            $('#timer').fadeOut(300);
                        },
                        error: function () {
                            $('#timer').fadeOut(300);
                            $('#alertBoxes').html('<div class="box-error"></div>');
                            $('.box-error').hide(0).html('Ha ocurrido un error durante la ejecución');
                            $('.box-error').slideDown(timeSlide);
                        }

                    });

                } else {
                    $('#alertBoxes').html('<div class="box-error"></div>');
                    $('.box-error').hide(0).html('Los campos estan vacios');
                    $('.box-error').slideDown(timeSlide);
                    $('#timer').fadeOut(300);
                }

            }

        }, timeSlide);

        return false;

    });

    $('#sessionKiller').click(function () {
        $('#timer').fadeIn(300);
        $('#alertBoxes').html('<div class="box-success"></div>');
        $('.box-success').hide(0).html('Espera un momento&#133;');
        $('.box-success').slideDown(timeSlide);
        setTimeout(function () {
            window.location.href = "logout.php";
        }, 2500);
    });

});
