function borrar_usuario() {
    with (event) {
        if (keyCode == 8) {
            event.keyCode = 0;
            event.cancelBubble = true;
            $("#i_id_usuario").val("m");
            $("#i_nombre").val("");
            $("#i_apellido").val("");
        }
    }
}

function borrar_usuario_m() {
    with (event) {
        if (keyCode == 8) {
            event.keyCode = 0;
            event.cancelBubble = true;
            $("#m_id_usuario").val("m");
            $("#m_nombre").val("");
            $("#m_apellido").val("");
        }
    }
}

$(document).ready(function () {
    $('#m_dni').on('keyup', function () {
        borrar_usuario_m();
    });
    $('#i_dni').on('keyup', function () {
        borrar_usuario();
    });

    //autocomplete usuario
    $("#b_dni").autocomplete("consultas/traer_usuario.php", {
        width: 460,
        matchContains: true,
        selectFirst: false
    });
    $("#b_dni").result(function (event, data, formatted) {
        $("#b_dni").val(data[4]);
        data = '';
        data = [];
        $("#b_dni").flushCache();
    });

    $("#i_dni").autocomplete("consultas/traer_usuario.php", {
        width: 460,
        matchContains: true,
        selectFirst: false
    });
    $("#i_dni").result(function (event, data, formatted) {
        $("#i_id_usuario").val(data[1]);
        $("#i_dni").val(data[4]);
        $("#i_nombre").val(data[2]);
        $("#i_apellido").val(data[3]);
        data = '';
        data = [];
        $("#i_dni").flushCache();
    });

    $("#m_dni").autocomplete("consultas/traer_usuario.php", {
        width: 460,
        matchContains: true,
        selectFirst: false
    });
    $("#m_dni").result(function (event, data, formatted) {
        $("#m_id_usuario").val(data[1]);
        $("#m_dni").val(data[4]);
        $("#m_nombre").val(data[2]);
        $("#m_apellido").val(data[3]);
        data = '';
        data = [];
        $("#m_dni").flushCache();
    });




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
        $("#b_fec_ini").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#b_fec_fin").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#i_fecha").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#m_fecha").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#i_fin_contrato").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });

    });
    //**************************
    $("#i_dni").numeric();
    $("#m_dni").numeric();
//    $("#i_telefono").numeric();
//    $("#m_telefono").numeric();
    var id_tipo_contrato = $("#i_id_tipo_contrato").val();
    $.post("consultas/traer_tipo.php", {id_tipo_contrato: id_tipo_contrato}, function (data) {
        var dato = $.trim(data);
        $("#i_tipo").html(dato);
//        $("#m_tipo").html(dato);
    });
//    $.post("consultas/traer_departamento.php", function (data) {
//        var dato = $.trim(data);
//        $("#i_departamento").html(dato);
//        $("#m_departamento").html(dato);
//    });
//    $.post("consultas/traer_perfil.php", function (data) {
//        var dato = $.trim(data);
//        $("#i_perfil").html(dato);
//        $("#m_perfil").html(dato);
//    });
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
        var i_id_usuario = $("#i_id_usuario").val();
        var i_fecha = $("#i_fecha").val();
        var i_hora = $("#i_horas").val();

        var i_tipo = $("#i_tipo").val();

        var fecha_inicio_contrato = $("#fecha_inicio_contrato").val();
        var fecha_termino_contrato = $("#fecha_termino_contrato").val();

//                echo "<input type='hidden' id='horario_hora_entrada' value='$hora_entrada' />";
//        echo "<input type='hidden' id='horario_hora_salida' value='$hora_salida' />";
//        echo "<input type='hidden' id='horario_hora_re_entrada' value='$hora_re_entrada' />";
//        echo "<input type='hidden' id='horario_hora_re_salida' value='$hora_re_salida' />";
//        
        var horario_hora_entrada = $("#horario_hora_entrada").val();
        var horario_hora_salida = $("#horario_hora_salida").val();
        var horario_hora_re_entrada = $("#horario_hora_re_entrada").val();
        var horario_hora_re_salida = $("#horario_hora_re_salida").val();
        
        var array_horario_hora_re_entrada = horario_hora_re_entrada.split(":");
        var minutos_re_entrada = parseInt((array_horario_hora_re_entrada[0] * 60)) + parseInt(array_horario_hora_re_entrada[1]);
        
        var array_horario_hora_salida = horario_hora_salida.split(":");
        var minutos_salida = parseInt((array_horario_hora_salida[0] * 60)) + parseInt(array_horario_hora_salida[1]);
        

        var array_minuto_hora = i_hora.split(":");
        var minutos_hora = parseInt((array_minuto_hora[0] * 60)) + parseInt(array_minuto_hora[1]);
//        var i_id_tipo_contrato=$("#i_id_tipo_contrato").val();
//        alert(minutos_hora);

        if (i_tipo == 3) {//hora entrada refrigerio
//            alert(minutos_hora + "<" + minutos_re_entrada);
            if (minutos_hora < minutos_re_entrada) {
                alert("La hora de refrigerio se registra a partir de las " +horario_hora_re_entrada+ " Horas ");
                return false;
            }
        }
        if (i_tipo == 2) {
            if (minutos_hora < minutos_salida) {
                alert("La hora de salida a partir de las " +horario_hora_salida+ " Horas ");
                return false;
            }
        }

        //2016-05-23,2016-05-31
//        alert(i_fecha+" >= "+fecha_inicio_contrato+" && "+i_fecha+" <="+ fecha_termino_contrato);
        if (i_fecha >= fecha_inicio_contrato && i_fecha <= fecha_termino_contrato) {
            $("#m_fecha").css("border", "");
        } else {
            $("#m_fecha").css("border", "1px solid red");
            alert("La fecha esta fuera de su horario de contrato");
            return false;
        }

        if ($.trim(i_tipo) == 0) {
            $("#i_tipo").css("border", "1px solid red");
            alert("Elija un tipo de registro de asistencia");
            return false;
        } else {
            $("#i_tipo").css("border", "");
        }

        var dataString = 'i_id_usuario=' + i_id_usuario +
                '&i_fecha=' + i_fecha +
                '&i_hora=' + i_hora +
                '&i_tipo=' + i_tipo;
        //que sea de su horario
        // que sea unico por dia el tipo

        $.post("consultas/verificar_horario.php", {i_fecha: i_fecha, i_id_usuario: i_id_usuario}, function (data) {
            var dato = $.trim(data);
            if (dato == 0) {
                $.post("consultas/verificar_tipo_unico_dia.php", {i_tipo: i_tipo, i_fecha: i_fecha, i_id_usuario: i_id_usuario}, function (data) {
                    var dato = $.trim(data);
                    if (dato == 0) {
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
                    } else {
                        alert("Ya se registro este tipo de registro de asistencia,por favor elija otro tipo de registro de asistencia ");
                        return false;
                    }
                });
            } else {
                alert("La fecha elegida no concuerda con su horario, elija una fecha de su horario");
                return false;
            }
        });
    });

    $('#btn_consultar').click(function (e) {
        var fec_ini = $("#b_fec_ini").val();
        var fec_fin = $("#b_fec_fin").val();
        var dni = $("#b_dni").val();

        location.href = "vista_asistencia.php?fec_ini=" + fec_ini + "&fec_fin=" + fec_fin + "&dni=" + dni;
    });

//    $('#btn_modificar').click(function (e) {
//        var i_id_usuario = $("#m_id_usuario").val();
//        var i_fecha = $("#m_fecha").val();
//        var i_hora = $("#m_hora").val();
//        var i_minuto = $("#m_minuto").val();
//        var hora_com = i_hora + ":" + i_minuto;
//        var i_tipo = $("#m_tipo").val();
//        var i_estado = $("#m_estado").val();
//        var m_id_asistencia = $("#m_id_asistencia").val();
//
//        if ($.trim(i_id_usuario) == "") {
//            $("#m_dni").css("border", "1px solid red");
//            $("#m_nombre").css("border", "1px solid red");
//            $("#m_apellido").css("border", "1px solid red");
//            alert("Elija un usuario valido");
//            return false;
//        } else {
//            $("#m_dni").css("border", "");
//            $("#m_nombre").css("border", "");
//            $("#m_apellido").css("border", "");
//
//        }
//
//        if ($.trim(i_fecha) == "" || $.trim(i_fecha) == null) {
//            $("#m_fecha").css("border", "1px solid red");
//            alert("Escriba una fecha");
//            return false;
//        } else {
//            $("#m_fecha").css("border", "");
//        }
//
//        if ($.trim(i_tipo) == 0) {
//            $("#m_tipo").css("border", "1px solid red");
//            alert("Elija un tipo");
//            return false;
//        } else {
//            $("#m_tipo").css("border", "");
//        }
//
//        var dataString = 'i_id_usuario=' + i_id_usuario +
//                '&i_fecha=' + i_fecha +
//                '&hora_com=' + hora_com +
//                '&i_tipo=' + i_tipo +
//                '&m_id_asistencia=' + m_id_asistencia +
//                '&i_estado=' + i_estado;
//
//        //que sea de su horario
//        // que sea unico por dia el tipo
//        //verificar que marque a partit de las su hora (8)
//        
//        
//        $.post("consultas/verificar_horario.php", {i_fecha: i_fecha, i_id_usuario: i_id_usuario}, function (data) {
//            var dato = $.trim(data);
//            if (dato == 0) {
//                $.post("consultas/verificar_tipo_unico_dia_mod.php", {i_tipo: i_tipo, i_fecha: i_fecha, i_id_usuario: i_id_usuario, m_id_asistencia: m_id_asistencia}, function (data) {
//                    var dato = $.trim(data);
//                    if (dato == 0) {
//                        $.ajax({
//                            type: "POST",
//                            url: "controlador/modificar.php",
//                            data: dataString,
//                            cache: false,
//                            success: function (result) {
//                                if (result == 1) {
//                                    location.reload();
//                                } else {
//                                    alert("Error" + result);
//                                }
//                            },
//                            error: function (result) {
//                                alert("error");
//                            }
//                        });
//                    } else {
//                        alert("Ya se registro este tipo , elija otro tipo" + dato);
//                        return false;
//                    }
//                });
//            } else {
//                alert("La fecha elegida no concuerda con su horario,elija una fecha de su horario");
//                return false;
//            }
//        });
//    });

    $('#btn_eliminar').click(function (e) {
        var e_id_asistencia = $("#e_id_asistencia").val();
        var dataString = 'e_id_asistencia=' + e_id_asistencia;
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
    $("#e_id_asistencia").val(id_dato);
//    $('#modalEliminar').modal('show');
}



function modificar(id_dato)
{
    $.post("consultas/buscar_asistencia.php", {id_asistencia: id_dato}, function (data) {

        var dato = $.trim(data);
        $.each(JSON.parse(dato), function (idx, obj) {
            $("#m_id_asistencia").val(id_dato);
            $("#m_id_usuario").val(obj.id_usuario);
            $("#m_dni").val(obj.dni);
            $("#m_nombre").val(obj.nombre);
            $("#m_apellido").val(obj.apellidos);
            $("#m_fecha").val(obj.fecha_ingreso);

            var hora_entrada_com = obj.hora;
            var hora_en = hora_entrada_com.split(":");

            $("#m_hora option[value='" + hora_en[0] + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_minuto option[value='" + hora_en[1] + "']").attr('selected', 'selected'); //selecciona el combo...

            $("#m_tipo option[value='" + obj.id_tipo + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_estado option[value='" + obj.id_estado + "']").attr('selected', 'selected'); //selecciona el combo...
        });
    });
//    $('#modalEditar').modal('show');
}
function abrir_horario(id_usuario) {
    $.post("consultas/buscar_horario.php", {id_usuario: id_usuario}, function (data) {
        var dato = $.trim(data);
        $("#div_horario").html(dato);
    });
}