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
        $("#i_fecha_permiso").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $("#m_fecha_permiso").datepicker({
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

    $.post("consultas/traer_motivo.php", function (data) {
        var dato = $.trim(data);
        $("#i_motivo").html(dato);
        $("#m_motivo").html(dato);
    });
    $.post("consultas/traer_usuario.php", function (data) {
        var dato = $.trim(data);
        $("#i_usuario").html(dato);
        $("#m_usuario").html(dato);
    });
//    $.post("consultas/traer_tipo_contrato.php", function (data) {
//        var dato = $.trim(data);
//        $("#i_tipo_contrato").html(dato);
//        $("#m_tipo_contrato").html(dato);
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

        var i_usuario = $("#i_usuario").val();
        var i_motivo = $("#i_motivo").val();
        var i_estado = $("#i_estado").val();
        var i_fecha_permiso = $("#i_fecha_permiso").val();
        var i_descripcion = $("#i_descripcion").val();

        var i_hora_entrada = $("#i_hora_entrada").val();
        var i_minuto_entrada = $("#i_minuto_entrada").val();

        var hora_entrada_com = i_hora_entrada + ":" + i_minuto_entrada;

        var i_hora_salida = $("#i_hora_salida").val();
        var i_minuto_salida = $("#i_minuto_salida").val();

        var hora_salida_com = i_hora_salida + ":" + i_minuto_salida;

        if ($.trim(i_usuario) == 0) {
            $("#i_usuario").css("border", "1px solid red");
            alert("Elija un Usuario");
            return false;
        } else {
            $("#i_usuario").css("border", "");
        }

        if ($.trim(i_fecha_permiso) == "") {
            $("#i_fecha_permiso").css("border", "1px solid red");
            alert("Elija una fecha de permiso");
            return false;
        } else {
            $("#i_fecha_permiso").css("border", "");
        }

        if ($.trim(i_motivo) == 0) {
            $("#i_tipo_contrato").css("border", "1px solid red");
            alert("Elija un Motivo");
            return false;
        } else {
            $("#i_tipo_contrato").css("border", "");
        }
        var dataString = 'i_usuario=' + i_usuario +
                '&i_motivo=' + i_motivo +
                '&i_estado=' + i_estado +
                '&i_fecha_permiso=' + i_fecha_permiso +
                '&i_descripcion=' + i_descripcion +
                '&hora_entrada_com=' + hora_entrada_com +
                '&hora_salida_com=' + hora_salida_com;

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
    $('#btn_actualizar').click(function (e) {
        var i_usuario = $("#m_usuario").val();
        var m_id_permiso = $("#m_id_permiso").val();
        var m_motivo = $("#m_motivo").val();
        var i_estado = $("#m_estado").val();
        var m_descripcion = $("#m_descripcion").val();
         var m_fecha_permiso = $("#m_fecha_permiso").val();//m_fecha_permiso

        var i_hora_entrada = $("#m_hora_entrada").val();
        var i_minuto_entrada = $("#m_minuto_entrada").val();

        var hora_entrada_com = i_hora_entrada + ":" + i_minuto_entrada;

        var i_hora_salida = $("#m_hora_salida").val();
        var i_minuto_salida = $("#m_minuto_salida").val();

        var hora_salida_com = i_hora_salida + ":" + i_minuto_salida;




        if ($.trim(i_usuario) == 0) {
            $("#m_usuario").css("border", "1px solid red");
            alert("Elija un Usuario");
            return false;
        } else {
            $("#m_usuario").css("border", "");
        }

        if ($.trim(m_motivo) == 0) {
            $("#m_tipo_contrato").css("border", "1px solid red");
            alert("Elija un Motivo");
            return false;
        } else {
            $("#m_tipo_contrato").css("border", "");
        }
        
          if ($.trim(m_fecha_permiso) == "") {
            $("#m_fecha_permiso").css("border", "1px solid red");
            alert("Elija una fecha");
            return false;
        } else {
            $("#m_fecha_permiso").css("border", "");
        }

        var dataString = 'i_usuario=' + i_usuario +
                '&m_id_permiso=' + m_id_permiso +
                '&m_motivo=' + m_motivo +
                '&m_descripcion=' + m_descripcion +
                '&i_estado=' + i_estado +
                '&hora_entrada_com=' + hora_entrada_com +
                '&m_fecha_permiso='+m_fecha_permiso+
                '&hora_salida_com=' + hora_salida_com;

//
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

        var e_id_permiso = $("#e_id_permiso").val();
        var dataString = 'e_id_permiso=' + e_id_permiso;
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
    $("#e_id_permiso").val(id_dato);
    $('#modalEliminar').modal('show');
}



function modificar(id_dato)
{
    $.post("consultas/buscar_permiso.php", {id_permiso: id_dato}, function (data) {
        var dato = $.trim(data);
        $.each(JSON.parse(dato), function (idx, obj) {

            $("#m_usuario").val(obj.id_usuario);
            $("#m_usuario option[value='" + obj.id_usuario + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_id_permiso").val(id_dato);
            $("#m_fecha_permiso").val(obj.fecha_permiso);
            $("#m_descripcion").val(obj.descripcion);
            $("#m_motivo option[value='" + obj.id_motivo + "']").attr('selected', 'selected'); //selecciona el combo...


            var hora_entrada_com = obj.hora_inicio;
            var hora_en = hora_entrada_com.split(":");

            $("#m_hora_entrada option[value='" + hora_en[0] + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_minuto_entrada option[value='" + hora_en[1] + "']").attr('selected', 'selected'); //selecciona el combo...

            var hora_salida_com = obj.hora_fin;
            var hora_sal = hora_salida_com.split(":");
            $("#m_hora_salida option[value='" + hora_sal[0] + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_minuto_salida option[value='" + hora_sal[1] + "']").attr('selected', 'selected'); //selecciona el combo...

            $("#m_estado option[value='" + obj.id_estado + "']").attr('selected', 'selected'); //selecciona el combo...
        });
    });
    $('#modalEditar').modal('show');
}
