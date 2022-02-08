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
    $("#i_dni").numeric();
    $("#m_dni").numeric();
    $("#i_telefono").numeric();
    $("#m_telefono").numeric();
    $.post("consultas/traer_sexo.php", function (data) {
        var dato = $.trim(data);
        $("#i_sexo").html(dato);
        $("#m_sexo").html(dato);
    });
    $.post("consultas/traer_departamento.php", function (data) {
        var dato = $.trim(data);
        $("#i_departamento").html(dato);
        $("#m_departamento").html(dato);
    });
    $.post("consultas/traer_perfil.php", function (data) {
        var dato = $.trim(data);
        $("#i_perfil").html(dato);
        $("#m_perfil").html(dato);
    });
    $.post("consultas/traer_cargo.php", function (data) {
        var dato = $.trim(data);
        $("#i_cargo").html(dato);
        $("#m_cargo").html(dato);
    });
    $.post("consultas/traer_sede.php", function (data) {
        var dato = $.trim(data);
        $("#i_sede").html(dato);
        $("#m_sede").html(dato);
    });

    $.post("consultas/traer_tipo_contrato.php", function (data) {
        var dato = $.trim(data);
        $("#i_tipo_contrato").html(dato);
        $("#m_tipo_contrato").html(dato);
    });

    $('#i_tipo_contrato').change(function (e) {
        var i_tipo_contrato = $("#i_tipo_contrato").val();
        $.post("consultas/traer_horario.php", {i_tipo_contrato: i_tipo_contrato}, function (data) {
            var dato = $.trim(data);
            $("#i_horario").html(dato);
        });
    });
    $('#m_tipo_contrato').change(function (e) {
        var i_tipo_contrato = $("#m_tipo_contrato").val();
        $.post("consultas/traer_horario.php", {i_tipo_contrato: i_tipo_contrato}, function (data) {
            var dato = $.trim(data);
            $("#m_horario").html(dato);
        });
    });

    $('#btn_insertar').click(function (e) {

        var i_nombre = $("#i_nombre").val();
        var i_apellidos = $("#i_apellidos").val();
        var i_sexo = $("#i_sexo").val();
        var i_fecha_naci = $("#i_fecha_naci").val();
        var i_departamento = $("#i_departamento").val();
        var i_telefono = $("#i_telefono").val();
        var i_dni = $("#i_dni").val();
        var i_clave = $("#i_clave").val();
        var i_perfil = $("#i_perfil").val();
        var i_cargo = $("#i_cargo").val();
        var i_sede = $("#i_sede").val();
        var i_ini_contrato = $("#i_ini_contrato").val();
        var i_fin_contrato = $("#i_fin_contrato").val();
        var i_estado = $("#i_estado").val();
        var i_tipo_contrato = $("#i_tipo_contrato").val();
        var i_horario = $("#i_horario").val();

        if ($.trim(i_nombre) == "" || $.trim(i_nombre) == null) {
            $("#i_nombre").css("border", "1px solid red");
            alert("Escriba un nombre");
            return false;
        } else {
            $("#i_nombre").css("border", "");
        }
        if ($.trim(i_apellidos) == "" || $.trim(i_apellidos) == null) {
            $("#i_apellidos").css("border", "1px solid red");
            alert("Escriba los Apellidos");
            return false;
        } else {
            $("#i_apellidos").css("border", "");
        }
        if ($.trim(i_sexo) == 0) {
            $("#i_sexo").css("border", "1px solid red");
            alert("Elija un sexo");
            return false;
        } else {
            $("#i_sexo").css("border", "");
        }

        if ($.trim(i_fecha_naci) == "" || $.trim(i_fecha_naci) == null) {
            $("#i_fecha_naci").css("border", "1px solid red");
            alert("Escriba una fecha de nacimiento");
            return false;
        } else {
            $("#i_fecha_naci").css("border", "");
        }

        if ($.trim(i_departamento) == 0) {
            $("#i_departamento").css("border", "1px solid red");
            alert("Elija un Depatamento");
            return false;
        } else {
            $("#i_departamento").css("border", "");
        }

        if ($.trim(i_telefono) == "" || $.trim(i_telefono) == null) {
            $("#i_telefono").css("border", "1px solid red");
            alert("Escriba un Telefono");
            return false;
        } else {
            $("#i_telefono").css("border", "");
        }
        if ($.trim(i_dni) == "" || $.trim(i_dni) == null) {
            $("#i_dni").css("border", "1px solid red");
            alert("Escriba un dni");
            return false;
        } else {
            $("#i_dni").css("border", "");
        }

        if ($.trim(i_dni).length < 8) {
            $("#i_dni").css("border", "1px solid red");
            alert("El dni debe tener 8 digitos");
            return false;
        } else {
            $("#i_dni").css("border", "");
        }

        if ($.trim(i_clave) == "" || $.trim(i_clave) == null) {
            $("#i_clave").css("border", "1px solid red");
            alert("Escriba una clave");
            return false;
        } else {
            $("#i_clave").css("border", "");
        }

        if ($.trim(i_perfil) == 0) {
            $("#i_perfil").css("border", "1px solid red");
            alert("Elija un perfil");
            return false;
        } else {
            $("#i_perfil").css("border", "");
        }

        if ($.trim(i_cargo) == 0) {
            $("#i_cargo").css("border", "1px solid red");
            alert("Elija un cargo");
            return false;
        } else {
            $("#i_cargo").css("border", "");
        }

        if ($.trim(i_sede) == 0) {
            $("#i_sede").css("border", "1px solid red");
            alert("Elija una sede");
            return false;
        } else {
            $("#i_sede").css("border", "");
        }

        if ($.trim(i_ini_contrato) == "" || $.trim(i_ini_contrato) == null) {
            $("#i_ini_contrato").css("border", "1px solid red");
            alert("Escriba una fecha de inicio de contrato");
            return false;
        } else {
            $("#i_ini_contrato").css("border", "");
        }

        if ($.trim(i_fin_contrato) == "" || $.trim(i_fin_contrato) == null) {
            $("#i_fin_contrato").css("border", "1px solid red");
            alert("Escriba una fecha de fin de contrato");
            return false;
        } else {
            $("#i_fin_contrato").css("border", "");
        }
        if (i_tipo_contrato == 0) {
            $("#i_tipo_contrato").css("border", "1px solid red");
            alert("Elija un tipo de contrato");
            return false;
        } else {
            $("#i_tipo_contrato").css("border", "");
        }
        if (i_horario == 0) {
            $("#i_horario").css("border", "1px solid red");
            alert("Elija un Horario");
            return false;
        } else {
            $("#i_horario").css("border", "");
        }

        var dataString = 'i_nombre=' + i_nombre +
                '&i_apellidos=' + i_apellidos +
                '&i_sexo=' + i_sexo +
                '&i_fecha_naci=' + i_fecha_naci +
                '&i_departamento=' + i_departamento +
                '&i_telefono=' + i_telefono +
                '&i_dni=' + i_dni +
                '&i_clave=' + i_clave +
                '&i_perfil=' + i_perfil +
                '&i_cargo=' + i_cargo +
                '&i_sede=' + i_sede +
                '&i_ini_contrato=' + i_ini_contrato +
                '&i_fin_contrato=' + i_fin_contrato +
                '&i_tipo_contrato=' + i_tipo_contrato +
                '&i_horario=' + i_horario +
                '&i_estado=' + i_estado;

        $.post("consultas/verificar_dni_registrar.php", {dni: i_dni}, function (data) {
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
                alert("El dni ya esta siendo usado, por favor escriba otro dni");
                return false;
            }
        });
    });
    $('#btn_actualizar').click(function (e) {
        var m_id_usuario = $("#m_id_usuario").val();
        var i_nombre = $("#m_nombre").val();
        var i_apellidos = $("#m_apellidos").val();
        var i_sexo = $("#m_sexo").val();
        var i_fecha_naci = $("#m_fecha_naci").val();
        var i_departamento = $("#m_departamento").val();
        var i_telefono = $("#m_telefono").val();
        var i_dni = $("#m_dni").val();
        var i_clave = $("#m_clave").val();
        var i_perfil = $("#m_perfil").val();
        var i_cargo = $("#m_cargo").val();
        var i_sede = $("#m_sede").val();
        var i_ini_contrato = $("#m_ini_contrato").val();
        var i_fin_contrato = $("#m_fin_contrato").val();
        var i_estado = $("#m_estado").val();
        
        var m_tipo_contrato=$("#m_tipo_contrato").val();
        var m_horario=$("#m_horario").val();
        
        if ($.trim(i_nombre) == "" || $.trim(i_nombre) == null) {
            $("#m_nombre").css("border", "1px solid red");
            alert("Escriba un nombre");
            return false;
        } else {
            $("#m_nombre").css("border", "");
        }
        if ($.trim(i_apellidos) == "" || $.trim(i_apellidos) == null) {
            $("#m_apellidos").css("border", "1px solid red");
            alert("Escriba los Apellidos");
            return false;
        } else {
            $("#m_apellidos").css("border", "");
        }
        if ($.trim(i_sexo) == 0) {
            $("#m_sexo").css("border", "1px solid red");
            alert("Elija un sexo");
            return false;
        } else {
            $("#m_sexo").css("border", "");
        }

        if ($.trim(i_fecha_naci) == "" || $.trim(i_fecha_naci) == null) {
            $("#m_fecha_naci").css("border", "1px solid red");
            alert("Escriba una fecha de nacimiento");
            return false;
        } else {
            $("#m_fecha_naci").css("border", "");
        }

        if ($.trim(i_departamento) == 0) {
            $("#m_departamento").css("border", "1px solid red");
            alert("Elija un Depatamento");
            return false;
        } else {
            $("#m_departamento").css("border", "");
        }

        if ($.trim(i_telefono) == "" || $.trim(i_telefono) == null) {
            $("#m_telefono").css("border", "1px solid red");
            alert("Escriba un Telefono");
            return false;
        } else {
            $("#m_telefono").css("border", "");
        }
        if ($.trim(i_dni) == "" || $.trim(i_dni) == null) {
            $("#m_dni").css("border", "1px solid red");
            alert("Escriba un dni");
            return false;
        } else {
            $("#m_dni").css("border", "");
        }

        if ($.trim(i_dni).length < 8) {
            $("#m_dni").css("border", "1px solid red");
            alert("El dni debe tener 8 digitos");
            return false;
        } else {
            $("#m_dni").css("border", "");
        }

        if ($.trim(i_clave) == "" || $.trim(i_clave) == null) {
            $("#m_clave").css("border", "1px solid red");
            alert("Escriba una clave");
            return false;
        } else {
            $("#m_clave").css("border", "");
        }

        if ($.trim(i_perfil) == 0) {
            $("#m_perfil").css("border", "1px solid red");
            alert("Elija un perfil");
            return false;
        } else {
            $("#m_perfil").css("border", "");
        }

        if ($.trim(i_cargo) == 0) {
            $("#m_cargo").css("border", "1px solid red");
            alert("Elija un cargo");
            return false;
        } else {
            $("#m_cargo").css("border", "");
        }

        if ($.trim(i_sede) == 0) {
            $("#m_sede").css("border", "1px solid red");
            alert("Elija una sede");
            return false;
        } else {
            $("#m_sede").css("border", "");
        }

        if ($.trim(i_ini_contrato) == "" || $.trim(i_ini_contrato) == null) {
            $("#m_ini_contrato").css("border", "1px solid red");
            alert("Escriba una fecha de inicio de contrato");
            return false;
        } else {
            $("#m_ini_contrato").css("border", "");
        }

        if ($.trim(i_fin_contrato) == "" || $.trim(i_fin_contrato) == null) {
            $("#m_fin_contrato").css("border", "1px solid red");
            alert("Escriba una fecha de fin de contrato");
            return false;
        } else {
            $("#m_fin_contrato").css("border", "");
        }

        var dataString = 'i_nombre=' + i_nombre +
                '&i_apellidos=' + i_apellidos +
                '&m_id_usuario=' + m_id_usuario +
                '&i_sexo=' + i_sexo +
                '&i_fecha_naci=' + i_fecha_naci +
                '&i_departamento=' + i_departamento +
                '&i_telefono=' + i_telefono +
                '&i_dni=' + i_dni +
                '&i_clave=' + i_clave +
                '&i_perfil=' + i_perfil +
                '&i_cargo=' + i_cargo +
                '&i_sede=' + i_sede +
                '&i_ini_contrato=' + i_ini_contrato +
                '&i_fin_contrato=' + i_fin_contrato +
                '&m_tipo_contrato=' + m_tipo_contrato +
                '&m_horario=' + m_horario +
                '&i_estado=' + i_estado;

        
        $.post("consultas/verificar_dni_modificar.php", {dni: i_dni, m_id_usuario: m_id_usuario}, function (data) {
            var dato = $.trim(data);
            if (dato == 0) {
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
            } else {
                alert("El dni ya esta siendo usado, por favor escriba otro dni");
                return false;
            }
        });
    });
    
    $('#btn_eliminar').click(function (e) {

        var e_id_usuario = $("#e_id_usuario").val();
        var dataString = 'e_id_usuario=' + e_id_usuario;
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
    $("#e_id_usuario").val(id_dato);
    $('#modalEliminar').modal('show');
}



function modificar(id_dato)
{
    $.post("consultas/buscar_usuario.php", {id_usuario: id_dato}, function (data) {
        var dato = $.trim(data);
        $.each(JSON.parse(dato), function (idx, obj) {
            $("#m_id_usuario").val(id_dato);
            $("#m_nombre").val(obj.nombre);
            $("#m_apellidos").val(obj.apellidos);
            $("#m_sexo option[value='" + obj.id_sexo + "']").attr('selected', 'selected');
            $("#m_fecha_naci").val(obj.fecha_nacimiento);
            $("#m_departamento option[value='" + obj.id_departamento + "']").attr('selected', 'selected');
            $("#m_telefono").val(obj.telefono);
            $("#m_dni").val(obj.dni);
            $("#m_clave").val(obj.clave);
            $("#m_perfil option[value='" + obj.id_perfil + "']").attr('selected', 'selected');
            $("#m_cargo option[value='" + obj.id_cargo + "']").attr('selected', 'selected');
            $("#m_sede option[value='" + obj.id_sede + "']").attr('selected', 'selected');
            $("#m_ini_contrato").val(obj.fecha_inicio_contrato);
            $("#m_fin_contrato").val(obj.fecha_termino_contrato);
            $("#m_estado option[value='" + obj.id_estado + "']").attr('selected', 'selected'); //selecciona el combo...
            $("#m_tipo_contrato option[value='" + obj.id_tipo_contrato_2 + "']").attr('selected', 'selected');

            $.post("consultas/traer_horario.php", {i_tipo_contrato: obj.id_tipo_contrato_2}, function (data) {
                var dato = $.trim(data);
                $("#m_horario").html(dato);
                $("#m_horario option[value='" + obj.id_horario + "']").attr('selected', 'selected');
            });

        });
    });
    $('#modalEditar').modal('show');
}
