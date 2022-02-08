$(document).ready(function () {

    $(function () {
        $.datepicker.regional['es'] = {
            clearText: 'Borra',
            clearStatus: 'Borra fecha actual',
            closeText: 'Cerrar',
            closeStatus: 'Cerrar sin guardar',
            prevText: '<Ant',
            prevBigText: '<<',
            prevStatus: 'Mostrar mes anterior',
            prevBigStatus: 'Mostrar año anterior',
            nextText: 'Sig>',
            nextBigText: '>>',
            nextStatus: 'Mostrar mes siguiente',
            nextBigStatus: 'Mostrar año siguiente',
            currentText: 'Hoy',
            currentStatus: 'Mostrar mes actual',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            monthStatus: 'Seleccionar otro mes',
            yearStatus: 'Seleccionar otro año',
            weekHeader: 'Sm',
            weekStatus: 'Semana del año',
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sab'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            dayStatus: 'Set DD as first week day',
            dateStatus: 'Select D, M d',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            initStatus: 'Seleccionar fecha',
            isRTL: false
        };
        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#i_fecha_naci").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#m_fecha_naci").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#i_ini_contrato").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#m_ini_contrato").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#i_fin_contrato").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#m_fin_contrato").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
    //**************************
//    $("#i_dni").numeric();
//    $("#m_dni").numeric();
//    $("#i_telefono").numeric();
//    $("#m_telefono").numeric();

    $.post("consultas/traer_dias.php", function (data) {
        var dato = $.trim(data);
        $("#i_dias").html(dato);
        $("#m_dias").html(dato);
    });
    $.post("consultas/traer_usuario.php", function (data) {
        var dato = $.trim(data);
        $("#i_usuario").html(dato);
        $("#m_usuario").html(dato);
    });
    $.post("consultas/traer_tipo_contrato.php", function (data) {
        var dato = $.trim(data);
        $("#i_tipo_contrato").html(dato);
        $("#m_tipo_contrato").html(dato);
    });

//    $.post("consultas/traer_cargo.php", function (data) {
//        var dato = $.trim(data);
//        $("#i_cargo").html(dato);
//        $("#m_cargo").html(dato);
//    });
//    $.post("consultas/traer_sede.php", function (data) {
//        var dato = $.trim(data);
//        $("#i_sede").html(dato);
//        $("#m_sede").html(dato);
//    });
    $('#btn_insertar').click(function (e) {

//        var i_usuario = $("#i_usuario").val();
        var i_tipo_contrato = $("#i_tipo_contrato").val();
        var i_dias = $("#i_dias").val();
        var i_estado = $("#i_estado").val();

        var i_hora_entrada = $("#i_hora_entrada").val();
        var i_minuto_entrada = $("#i_minuto_entrada").val();

        var hora_entrada_com = i_hora_entrada + ":" + i_minuto_entrada;

        var i_hora_salida = $("#i_hora_salida").val();
        var i_minuto_salida = $("#i_minuto_salida").val();

        var hora_salida_com = i_hora_salida + ":" + i_minuto_salida;

        var i_hora_entrada_re = $("#i_hora_entrada_re").val();
        var i_minuto_entrada_re = $("#i_minuto_entrada_re").val();

        var hora_entrada_com_re = i_hora_entrada_re + ":" + i_minuto_entrada_re;

        var i_hora_salida_re = $("#i_hora_salida_re").val();
        var i_minuto_salida_re = $("#i_minuto_salida_re").val();

        var hora_salida_com_re = i_hora_salida_re + ":" + i_minuto_salida_re;


//        if ($.trim(i_usuario) == 0) {
//            $("#i_usuario").css("border", "1px solid red");
//            alert("Elija un Usuario");
//            return false;
//        } else {
//            $("#i_usuario").css("border", "");
//        }

        if ($.trim(i_tipo_contrato) == 0) {
            $("#i_tipo_contrato").css("border", "1px solid red");
            alert("Elija un Tipo Contrato");
            return false;
        } else {
            $("#i_tipo_contrato").css("border", "");
        }


        if ($.trim(i_dias) == 0) {
            $("#i_dias").css("border", "1px solid red");
            alert("Elija Dias");
            return false;
        } else {
            $("#i_dias").css("border", "");
        }

        var dataString = 'i_tipo_contrato=' + i_tipo_contrato +
                '&i_dias=' + i_dias +
                '&i_estado=' + i_estado +
                '&hora_entrada_com=' + hora_entrada_com +
                '&hora_salida_com=' + hora_salida_com +
                '&hora_entrada_com_re=' + hora_entrada_com_re +
                '&hora_salida_com_re=' + hora_salida_com_re;

//        $.post("consultas/verificar_usuario_registrar.php", {i_usuario: i_usuario}, function (data) {
//            var dato = $.trim(data);
//            if (dato == 0) {
                $.ajax({
                    type: "POST",
                    url: "controlador/insertar.php",
                    data: dataString,
                    cache: false,
                    success: function (result) {
                        if (result == 1) {
                            location.reload();
                        } else {
                            alert("Error" + result);
                        }
                    },
                    error: function (result) {
                        alert("error");
                    }
                });
//            } else {
//                alert("Este Usuario ya tiene un horario, por favor elija otro usuario");
//                return false;
//            }
//        });
    });

    $("#i_tipo_contrato").change(function (e) {
        var i_tipo_contrato = $("#i_tipo_contrato").val();
        if (i_tipo_contrato == 1) {
            $("#i_tiempo_completo").show();
             $("#i_tiempo_completo2").show();
        } else {
            $("#i_tiempo_completo").hide();
            $("#i_tiempo_completo2").hide();
        }
    });

    $("#m_tipo_contrato").change(function (e) {
        var i_tipo_contrato = $("#m_tipo_contrato").val();
        if (i_tipo_contrato == 1) {
            $("#m_tiempo_completo").show();
            $("#m_tiempo_completo2").show();
        } else {
            $("#m_tiempo_completo").hide();
            $("#m_tiempo_completo2").hide();
        }
    });

    $('#btn_modificar').click(function (e) {
//        var i_usuario = $("#m_usuario").val();
        var m_id_horario = $("#m_id_horario").val();
        var i_tipo_contrato = $("#m_tipo_contrato").val();
        var i_dias = $("#m_dias").val();
        var i_estado = $("#m_estado").val();

        var i_hora_entrada = $("#m_hora_entrada").val();
        var i_minuto_entrada = $("#m_minuto_entrada").val();

        var hora_entrada_com = i_hora_entrada + ":" + i_minuto_entrada;

        var i_hora_salida = $("#m_hora_salida").val();
        var i_minuto_salida = $("#m_minuto_salida").val();

        var hora_salida_com = i_hora_salida + ":" + i_minuto_salida;

        var i_hora_entrada_re = $("#m_hora_entrada_re").val();
        var i_minuto_entrada_re = $("#m_minuto_entrada_re").val();

        var hora_entrada_com_re = i_hora_entrada_re + ":" + i_minuto_entrada_re;

        var i_hora_salida_re = $("#m_hora_salida_re").val();
        var i_minuto_salida_re = $("#m_minuto_salida_re").val();

        var hora_salida_com_re = i_hora_salida_re + ":" + i_minuto_salida_re;


//        if ($.trim(i_usuario) == 0) {
//            $("#m_usuario").css("border", "1px solid red");
//            alert("Elija un Usuario");
//            return false;
//        } else {
//            $("#m_usuario").css("border", "");
//        }

        if ($.trim(i_tipo_contrato) == 0) {
            $("#m_tipo_contrato").css("border", "1px solid red");
            alert("Elija un Tipo Contrato");
            return false;
        } else {
            $("#m_tipo_contrato").css("border", "");
        }

        if ($.trim(i_dias) == 0) {
            $("#m_dias").css("border", "1px solid red");
            alert("Elija Dias");
            return false;
        } else {
            $("#m_dias").css("border", "");
        }

        var dataString = 'i_tipo_contrato=' + i_tipo_contrato +
                '&m_id_horario=' + m_id_horario +
                '&i_dias=' + i_dias +
                '&i_estado=' + i_estado +
                '&hora_entrada_com=' + hora_entrada_com +
                '&hora_salida_com=' + hora_salida_com +
                '&hora_entrada_com_re=' + hora_entrada_com_re +
                '&hora_salida_com_re=' + hora_salida_com_re;

//        $.post("consultas/verificar_usuario_modificar.php", {i_usuario: i_usuario, m_id_horario: m_id_horario}, function (data) {
//            var dato = $.trim(data);
//            if (dato == 0) {
                $.ajax({
                    type: "POST",
                    url: "controlador/modificar.php",
                    data: dataString,
                    cache: false,
                    success: function (result) {
                        if (result == 1) {
                            location.reload();
                        } else {
                            alert("Error" + result);
                        }
                    },
                    error: function (result) {
                        alert("error");
                    }
                });
//            } else {
//                alert("Este Usuario ya tiene un horario, por favor elija otro usuario");
//                return false;
//            }
//        });
    });
    $('#btn_eliminar').click(function (e) {

        var e_id_horario = $("#e_id_horario").val();
        var dataString = 'e_id_horario=' + e_id_horario;
        $.ajax({
            type: "POST",
            url: "controlador/eliminar.php",
            data: dataString,
            cache: false,
            success: function (result) {
                if (result == 1) {
                    location.reload();
                } else {
                    alert("Error" + result);
                }
            },
            error: function (result) {
                alert("error");
            }
        });
    });
});

function eliminar(id_dato)
{
    $("#e_id_horario").val(id_dato);
    $('#modalEliminar').modal('show');
}



function modificar(id_dato)
{
    $.post("consultas/buscar_horario.php", {id_horario: id_dato}, function (data) {
        var dato = $.trim(data);
        $.each(JSON.parse(dato), function (idx, obj) {
//            $("#m_usuario").val(obj.id_usuario);
//            $("#m_usuario option[value='" + obj.id_usuario + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_id_horario").val(id_dato);
            $("#m_tipo_contrato option[value='" + obj.id_tipo_contrato + "']").attr('selected', 'selected'); //selecciona el combo...

            if (obj.id_tipo_contrato == 1) {
                $("#m_tiempo_completo").show();
                 $("#m_tiempo_completo2").show();
            } else {
                $("#m_tiempo_completo").hide();
                $("#m_tiempo_completo2").hide();
            }


            $("#m_dias option[value='" + obj.id_dias + "']").attr('selected', 'selected'); //selecciona el combo...

            var hora_entrada_com = obj.hora_entrada;
            var hora_en = hora_entrada_com.split(":");

            $("#m_hora_entrada option[value='" + hora_en[0] + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_minuto_entrada option[value='" + hora_en[1] + "']").attr('selected', 'selected'); //selecciona el combo...

            var hora_salida_com = obj.hora_salida;
            var hora_sal = hora_salida_com.split(":");
            $("#m_hora_salida option[value='" + hora_sal[0] + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_minuto_salida option[value='" + hora_sal[1] + "']").attr('selected', 'selected'); //selecciona el combo...

            var hora_entrada_com_re = obj.hora_re_entrada;
            var hora_en_re = hora_entrada_com_re.split(":");

            $("#m_hora_entrada_re option[value='" + hora_en_re[0] + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_minuto_entrada_re option[value='" + hora_en_re[1] + "']").attr('selected', 'selected'); //selecciona el combo...

            var hora_salida_com_re = obj.hora_re_salida;
            var hora_sa_re = hora_salida_com_re.split(":");

            $("#m_hora_salida_re option[value='" + hora_sa_re[0] + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_minuto_salida_re option[value='" + hora_sa_re[1] + "']").attr('selected', 'selected'); //selecciona el combo...

            $("#m_estado option[value='" + obj.id_estado + "']").attr('selected', 'selected'); //selecciona el combo...
        });
    });
    $('#modalEditar').modal('show');
}
