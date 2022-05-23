//Validacion de Campos
function validarcampos(dato) {
    if (dato.length <= 0) {
        return 2;
    } else {
        return 1;
    }
};

function onload() {
    listarservicios();
    listarsucursales();
    listarsucursal();
    listarreserva();
    vermicuenta();
    $(".validarCodigo").hide();
    cerrar();
}

function onmodify() {
    listarservicios();
    listarsucursales();
    listarsucursal();
    listarreserva();
    vermicuenta();
}

function cerrar() {
    $(".preloader").fadeOut(1000);
}

function showpeloader() {
    $(".preloader").fadeIn(1000);
}

function tipo_id() {
    var tip = $("#tip_id").val();
    if (tip == 1) {
        $("#txt_ind").attr("placeholder", "Rut: 11.111.111-1 / 11111111-1");
        $('#txt_ind').addClass("rut").mask('00.000.000-A');
    } else if (tip == 2) {
        $("#txt_ind").attr("placeholder", "Ingrese su Numero de Indentificacion");
        $("#txt_ind").removeClass("rut").unmask();
    }
};

function listarservicios() {
    $.ajax({
            url: '../view/listar_servicios.php',
            type: 'POST',
            data: 'nombre=wilkens',
        })
        .done(function(datos) {
            $("#service-list div").remove();
            $("#service-list").append(datos);
        })
        .fail(function() {
            $("#service-list").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });

}

function listarsucursales() {
    $.ajax({
            url: '../view/listar_sucursales.php',
            type: 'POST',
            data: 'nombre=wilkens',
        })
        .done(function(datos) {
            $("#sucur option").remove();
            $("#sucur").append(datos);
            peluquero();
        })
        .fail(function() {
            $("#sucur").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });

}

function listar_hora() {
    var id = $("#sucur").val();
    var fecha1 = $("#fec_res").val();
    fecha1 = fecha1.replace("/", "-");

    var fecha = new Date();
    fechita = (fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate());

    var fecha2 = new Date(fecha1);
    var fecha3 = new Date(fechita);

    if (fecha2 < fecha3) {
        swal.fire("¡Oh Oh!", "No puedes elegir una fecha anterior a la fecha de hoy", "warning");
        $(".hora div").remove();

    } else {

        $.ajax({
                url: '../view/listar_horas.php',
                type: 'POST',
                data: 'id=' + id +
                    '&fecha=' + fecha1,
            })
            .done(function(datos) {
                $(".hora div").remove();
                $(".hora").append(datos);
            })
            .fail(function() {
                $(".hora").append("<option>Error de conexion</option>");
            })
            .always(function() {

            });
    }
}

function peluquero() {
    var id_pel = $("#sucur").val();
    var datos = "id_pel=" + id_pel;
    $.ajax({
            url: '../view/listar_peluqueros.php',
            type: 'POST',
            data: datos,
        })
        .done(function(datos) {
            $(".peluquero option").remove();
            $(".peluquero").append(datos);
        })
        .fail(function() {
            $(".peluquero").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function guardar() {
    var pas1 = $("#conmod1").val().trim();
    var pas2 = $("#conmod2").val().trim();

    if (validarcampos(pas1) == 2 || validarcampos(pas2) == 2) {
        swal.fire("¡Oh Oh!", "Hay Campos vacios", "error");
        return;
    }

    if (pas1 != pas2) {
        swal.fire("¡Oh Oh!", "las contraseñas no coinciden", "error");
        return;
    }

    var datos = "pas=" + pas1;

    $.ajax({
            url: '../view/modificarcontrasena.php',
            type: 'POST',
            data: datos,
        })
        .done(function(datos) {
            swal.fire("Felicidades!", "Contraseña Modificada con exito", "success");
            $("#cont-mod").hide();
        })
        .fail(function() {

        })
        .always(function() {

        });

}

$(document).ready(function() {
    $('#form-reserve').on('submit', function(e) {
        e.preventDefault();
        $('.preloader').fadeIn(1000);

        var data = $("#form-reserve").serialize();

        $.ajax({
            url: '../view/reservahora.php',
            type: 'POST',
            data: data,
            success: function(datos) {
                if (datos == 2 || datos == '2') {
                    $(".preloader").hide(1000);
                    swal.fire('¡Oh Oh!', 'Hubo Un error, Verifique los datos', 'error');
                } else if (datos == 3 || datos == '3') {
                    $(".preloader").hide(1000);
                    swal.fire('¡Felicidades!', 'Su hora ha sido reservada con exito', 'success');
                    document.getElementById("form-reserve").reset();
                    $(".hora div").remove();
                    onmodify();
                } else {
                    $("#preloader").hide(1000);
                    swal.fire('¡Owww!', datos, 'warning');
                }


            }

        });



    });
});

function buscarpeluquero() {
    var id_pel = $("#sucur").val();
    console.log(id_pel);
    var datos = "id_pel=" + id_pel;
    $.ajax({
            url: '../view/listar_peluqueros.php',
            type: 'POST',
            data: datos,
        })
        .done(function(datos) {
            $(".peluquero option").remove();
            $(".peluquero").append(datos);
        })
        .fail(function() {
            $(".peluquero").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function listarsucursal() {
    $.ajax({
            url: '../view/listar_peluquerias.php',
            type: 'POST',
            data: 'none',
        })
        .done(function(datos) {
            $("#accordion div").remove();
            $("#accordion").append(datos);
        })
        .fail(function() {
            $("#accordion").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function listarreserva() {
    $.ajax({
            url: '../view/listar_reserva.php',
            type: 'POST',
            data: 'none',
        })
        .done(function(datos) {
            $("#reserve-content tr").remove();
            $("#reserve-content").append(datos);
        })
        .fail(function() {
            $("#reserve-content").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function vermicuenta() {
    $.ajax({
            url: '../view/vercuenta.php',
            type: 'POST',
            data: 'none',
        })
        .done(function(datos) {
            $(".mi-cuenta div").remove();
            $(".mi-cuenta").append(datos);
        })
        .fail(function() {
            $(".mi-cuenta").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function eliminarcuenta() {
    Swal.fire({
        title: '¿Estás Seguro/a?',
        text: "No podrá revertir esta Decision!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No, Cancelalo',
        confirmButtonText: 'Si, Eliminalo!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                    url: '../view/eliminarcuenta.php',
                    type: 'POST',
                    data: 'none',
                })
                .done(function(datos) {
                    Swal.fire(
                        'Eliminado!',
                        'Tu Cuenta ha sido Eliminada con exito',
                        'success'
                    )
                })
                .fail(function() {

                })
                .always(function() {

                });


            window.location = "../";
        }
    })
}

function modificar_con() {
    $(".cont-mod").removeAttr("hidden");
    $(".cont-mod").show();
}


function IntegrarWhatsapp() {
    var numero = $("#phone-number").val().trim();
    if (validarcampos(numero) == 2) {
        Swal.fire(
            'Oh Oh!',
            'Debes rellenar el campo del numero',
            'error'
        );
        return;
    }

    if (numero.length < 9 || numero.length > 9) {
        Swal.fire(
            'Oh Oh!',
            'El numero debe ser de 9 digitos',
            'error'
        );
        return;
    }

    if (numero < 911111111 || numero > 999999999) {
        Swal.fire('Oh Oh!',
            'El numero debe estar entre 911111111 y 999999999',
            'error'
        );
        return;
    }
    //Buscar Codigo Aleatorio y generar Cookie
    $.ajax({
            url: '../view/GenerarCodigoAleatorio.php',
            type: 'POST',
            data: 'valor=1&numero=56' + numero,

        })
        .done(function(datos) {

            var token = 'ytacxuz4tk1ev4il';
            var instanceId = '320851';
            var url = `https://api.chat-api.com/instance${instanceId}/message?token=${token}`;
            var data = {
                phone: '56' + numero, // Receivers phone
                body: 'Hola, Este codigo tiene un tiempo de caducidad de 5 minutos. No entregues este codigo a ninguna persona. Este codigo solo sirve para la validar su numero de Whatsapp en la pagina AHD.CL Tu Codigo de Validacion es: ' + datos, // Message
            };
            // Enviar solicitud para enviar el mensaje
            $.ajax(url, {
                data: JSON.stringify(data),
                contentType: 'application/json',
                type: 'POST'
            });
            $(".IngresarCodigo").hide();
            $(".validarCodigo").show();
        })
        .fail(function() {

        })
        .always(function() {

        });
}

function ValidarCodigo(valor) {

}

function IntegrarFacebook() {

}

function IntegrarInstagram() {

}

function IntegrarTwitter() {

}




//***********Chat************ */
//ShowInfo
function showinfo(id, sucur) {
    $.ajax({
            url: '../view/cant_message.php',
            type: 'POST',
            data: 'id=' + id,
        })
        .done(function(datos) {
            $("#info_user span").remove();
            $("#info_user p").remove();

            $("#info_user").append("<span> Hablando con Sucursal " +
                sucur + "</span>");
            $("#info_user").append("<p>" +
                datos + "</p>");

        })
        .fail(function() {

        })
        .always(function() {

        });

    $.ajax({
            url: '../view/show_client_message.php',
            type: 'POST',
            data: 'id=' + id,
        })
        .done(function(datos) {
            $("#msg_body div").remove();
            $("#msg_body").append(datos);
            $("#group_input").removeAttr("hidden");
            show_message2();

        })
        .fail(function() {

        })
        .always(function() {

        });
}

function send_message() {
    var mensaje = $("#msg").val();
    if (validarcampos(mensaje) == 2) {
        swal.fire("¡Oh Oh!", "El campo de mensaje no puede estar vacio", "warning")
        return;
    }
    $.ajax({
            url: '../view/send_client_message.php',
            type: 'POST',
            data: 'msg=' + mensaje + '&estado=1',
        })
        .done(function(datos) {
            console.log(datos);
            $("#msg").val("");
            $("#msg").focus();

        })
        .fail(function() {

        })
        .always(function() {

        });
}

function show_message2() {
    $.ajax({
            url: '../view/show_client_message.php',
            type: 'POST',
            data: 'none',
        })
        .done(function(datos) {
            $("#msg_body div").remove();
            $("#msg_body").append(datos);

        })
        .fail(function() {

        })
        .always(function() {

        });
    setTimeout("show_message2()", 300);
}

function sendvalidationmail() {
    $.ajax({
            url: '../view/email_activation.php',
            type: 'POST',
            data: 'none',
        })
        .done(function(datos) {

        })
        .fail(function() {

        })
        .always(function() {

        });
}

function registrarcorreo() {
    var correo = $("#correo").val();
    if (validarcampos(correo) == 2) {
        swal.fire("¡Oh Oh!", "El campo del correo no puede estar vacio", "warning")
        return;
    }
    $.ajax({
            url: '../view/registrarcorreo.php',
            type: 'POST',
            data: 'correo=' +
                correo,
        })
        .done(function(datos) {
            $("#cor span").remove();
            $("#cor").append("<span>" +
                correo + "</span>")

        })
        .fail(function() {

        })
        .always(function() {

        });
}


function Eliminar(id) {
    Swal.fire({
        title: '¿Estás Seguro/a que desea Cancelar esta reserva?',
        text: "No podrá revertir esta Decision!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No, revertir',
        confirmButtonText: 'Si, Cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                    url: '../view/Eliminarreserva.php',
                    type: 'POST',
                    data: 'id=' + id,
                })
                .done(function(datos) {
                    if (datos == 'true') {
                        Swal.fire(
                            'Cancelada!',
                            "Su reserva ha sido eliminada con exito",
                            'success'
                        );
                        setInterval(() => {
                            window.location = 'index.php';
                        }, 2000);
                    } else {
                        Swal.fire(
                            'Oh Oh!',
                            "Hubo un problema, no se pudo Cancelar la hora",
                            'error'
                        );
                    }
                })
                .fail(function() {

                })
                .always(function() {

                });

        }
    })
}