//function borrar_usuario() {
//    with (event) {
//        if (keyCode == 8) {
//            event.keyCode = 0;
//            event.cancelBubble = true;
//            $("#i_id_usuario").val("m");
//            $("#i_nombre").val("");
//            $("#i_apellido").val("");
//        }
//    }
//}
//function borrar_usuario_b() {
//    with (event) {
//        if (keyCode == 8) {
//            event.keyCode = 0;
//            event.cancelBubble = true;
//            $("#m_id_usuario").val("m");
//
//        }
//    }
//}
$(document).ready(function () {

//    $('#b_dni').on('keyup', function () {
//        borrar_usuario_b();
//    });

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
    });
    //**************************
    $("#b_dni").numeric();

    $('#btn_consultar').click(function (e) {
        var fec_ini = $("#b_fec_ini").val();
        var fec_fin = $("#b_fec_fin").val();
        var dni = $("#b_dni").val();
        var i_estado = $("#i_estado").val();
        var nombre_estado = $("#i_estado option:selected").text();

        location.href = "vista_asistencia.php?fec_ini=" + fec_ini + "&fec_fin=" + fec_fin + "&dni=" + dni + "&i_estado=" + i_estado + "&nombre_estado=" + nombre_estado;
    });

});



//  echo "<input type='hidden' id='s_faltas' value='$s_faltas' />";
//            echo "<input type='hidden' id='s_tardanzas' value='$s_tardanzas' />";
//            echo "<input type='hidden' id='s_asistencias' value='$s_asistencias' />";
//            echo "<input type='hidden' id='s_sin_marcar' value='$s_sin_marcar' />";
//            echo "<input type='hidden' id='s_todos' value='$s_todos' />";
//            echo "<input type='hidden' id='s_solo_dias' value='$s_solo_dias' />";
//            echo "<input type='hidden' id='todos_marcar' value='$todos_marcar' />";
//            echo "<input type='hidden' id='todos_asistencia' value='$todos_asistencia' />";
function fn_marcar() {
    var s_sin_marcar = $("#s_sin_marcar").val();
    var todos_marcar = $("#todos_marcar").val();
    var dias = todos_marcar - s_sin_marcar;

    newwindow = window.open("grafico_marcar/index.php?s_sin_marcar=" + s_sin_marcar + "&todos_marcar=" + dias, 'name', 'height=350,width=650,left=400,padding=700');
    if (window.focus) {
        newwindow.focus();
    }
}

function fn_tardanzas() {
    var s_tardanzas = $("#s_tardanzas").val();
    var todos_marcar = $("#todos_marcar").val();
    var dias = todos_marcar - s_tardanzas;
    newwindow = window.open("grafico_tardanzas/index.php?s_tardanzas=" + s_tardanzas + "&todos_marcar=" + dias, 'name', 'height=350,width=650,left=400,padding=700');
    if (window.focus) {
        newwindow.focus();
    }
}

function fn_faltas() {
    var s_faltas = $("#s_faltas").val();
    var total_asistencias = $("#s_solo_dias").val();
    var dias = total_asistencias - s_faltas;
//    alert(dias);
//    alert(total_asistencias);
    newwindow = window.open("grafico_faltas/index.php?s_faltas=" + s_faltas + "&total_asistencias=" + dias, 'name', 'height=350,width=650,left=400,padding=700');
    if (window.focus) {
        newwindow.focus();
    }
}

function fn_asistencia() {
    var asistencias = $("#s_asistencias").val();
    var total_asistencias = $("#todos_asistencia").val();
    var dias = total_asistencias - asistencias;
    newwindow = window.open("grafico_asistencias/index.php?asistencias=" + asistencias + "&total_asistencias=" + dias, 'name', 'height=350,width=650,left=400,padding=700');
    if (window.focus) {
        newwindow.focus();
    }
}

function fn_todos() {
    //asistencias
    var asistencias = $("#s_asistencias").val();
    var total_asistencias = $("#todos_asistencia").val();
    var t_asistencias=(asistencias/total_asistencias)*100;
    //faltas
    var s_faltas = $("#s_faltas").val();
    var total_asistencias1 = $("#s_solo_dias").val();
    var t_faltas=(s_faltas/total_asistencias1)*100;
    //tardanzas
    var s_tardanzas = $("#s_tardanzas").val();
    var todos_marcar = $("#todos_marcar").val();
    var t_tardanzas=(s_tardanzas/todos_marcar)*100;
    //marcar
    var s_sin_marcar = $("#s_sin_marcar").val();
    var todos_marcar = $("#todos_marcar").val();
    var t_sin_marcar=(s_sin_marcar/todos_marcar)*100;

    newwindow = window.open("grafico_todos/index.php?t_asistencias=" + t_asistencias
            + "&t_faltas=" + t_faltas
     + "&t_tardanzas=" + t_tardanzas
      + "&t_sin_marcar=" + t_sin_marcar
    , 'name', 'height=350,width=650,left=400,padding=700');
    if (window.focus) {
        newwindow.focus();
    }
}

function abrir_horario(id_usuario) {
    $.post("consultas/buscar_horario.php", {id_usuario: id_usuario}, function (data) {
        var dato = $.trim(data);
        $("#div_horario").html(dato);
    });
}