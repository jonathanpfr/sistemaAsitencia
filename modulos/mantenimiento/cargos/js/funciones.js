$(document).ready(function () {

    $('#btn_insertar').click(function (e) {
        var i_nombre = $("#i_nombre").val();
        var i_estado = $("#i_estado").val();//i_estado

        if (i_nombre == "" || i_nombre == null) {
            $("#i_nombre").css("border", "1px solid red");
            alert("Escriba un nombre");
            return false;
        } else {
            $("#i_nombre").css("border", "");
        }

        var dataString = 'i_nombre=' + i_nombre +
                '&i_estado=' + i_estado;

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

    });

    $('#btn_actualizar').click(function (e) {
        var m_nombre = $("#m_nombre").val();
        var m_estado = $("#m_estado").val();//i_estado
        var m_id_cargo = $("#m_id_cargo").val();//i_estado

        if (m_nombre == "" || m_nombre == null) {
            $("#m_nombre").css("border", "1px solid red");
            alert("Escriba un nombre");
            return false;
        } else {
            $("#m_nombre").css("border", "");
        }

        var dataString = 'm_nombre=' + m_nombre +
                '&m_id_cargo=' + m_id_cargo +
                '&m_estado=' + m_estado;

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

    });


    $('#btn_eliminar').click(function (e) {

        var e_id_cargo = $("#e_id_cargo").val();
        var dataString = 'e_id_cargo=' + e_id_cargo;

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
    $("#e_id_cargo").val(id_dato);
    $('#modalEliminar').modal('show');
}



function modificar(id_dato)
{
    $.post("consultas/buscar_cargo.php", {id_cargo: id_dato}, function (data) {
        var dato = $.trim(data);
        $.each(JSON.parse(dato), function (idx, obj) {
            $("#m_id_cargo").val(id_dato);
            $("#m_nombre").val(obj.nombre_cargo);
            $("#m_estado option[value='" + obj.id_estado + "']").attr('selected', 'selected');//selecciona el combo...
        });
    });
    $('#modalEditar').modal('show');
}
