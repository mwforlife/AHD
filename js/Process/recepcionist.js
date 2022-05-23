function confirmar(id) {
    Swal.fire({
        title: '¿Estás Seguro/a que desea Confirmar esta reserva?',
        text: "No podrá revertir esta Decision!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No, Cancelalo',
        confirmButtonText: 'Si, Confirmar!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                    url: '../view/confirmarreserva.php',
                    type: 'POST',
                    data: 'id=' + id,
                })
                .done(function(datos) {

                    if (datos == 'true') {
                        Swal.fire(
                            'Confirmada!',
                            "Hora ha sido confirmada con exito",
                            'success'
                        );
                        setInterval(() => {
                            window.location = 'index.php';
                        }, 2000);
                    } else {
                        Swal.fire(
                            'Oh Oh!',
                            "Hubo un problema, no se pudo confirmar la hora",
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

function Atender(id) {
    $.ajax({
            url: '../view/AtenderClientes.php',
            type: 'POST',
            data: 'id=' + id,
        })
        .done(function(datos) {

            if (datos == 'true') {
                Swal.fire(
                    'Gracias!',
                    "Gracias por su asistencia",
                    'success'
                );
                setInterval(() => {
                    window.location = 'index.php';
                }, 2000);
            } else {
                Swal.fire(
                    'Oh Oh!',
                    "Hubo un problema, no se pudo confirmar la Asistencia\n Comuniquese con su administrador de sucursal, Gracias",
                    'error'
                );
            }
        })
        .fail(function() {

        })
        .always(function() {

        });
}

function tipo_id() {
    var tip = $("#ind_tip").val();
    if (tip == 1) {
        $("#ind_val").attr("placeholder", "Rut: 11.111.111-1 / 11111111-1");
        $('#ind_val').addClass("rut").mask('00.000.000-A');
    } else if (tip == 2) {
        $("#ind_val").attr("placeholder", "Ingrese su Numero de Indentificacion");
        $("#ind_val").removeClass("rut").unmask();
    }
};

function cancelar(id) {
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
                    url: '../view/cancelarreserva.php',
                    type: 'POST',
                    data: 'id=' + id,
                })
                .done(function(datos) {
                    if (datos == 'true') {
                        Swal.fire(
                            'Cancelada!',
                            "Hora ha sido Cancelada con exito",
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

function listarsucursales() {
    $.ajax({
            url: '../view/listar_sucursales.php',
            type: 'POST',
            data: 'nombre=wilkens',
        })
        .done(function(datos) {
            $(".peluqueria option").remove();
            $(".peluqueria").append(datos);
        })
        .fail(function() {
            $(".peluqueria").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

//---------------------------------------------------------------------------------
var Fn = { //-------------
    // Valida el rut con su cadena completa "XXXXXXXX-X"---------------------------
    validaRut: function(rutCompleto) { //-------------
        rutCompleto = rutCompleto.replace(".", ""); //-------------
        rutCompleto = rutCompleto.replace(".", ""); //-------------
        rutCompleto = rutCompleto.replace("‐", "-"); //-------------
        //-------------
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto)) //-------------
            return false; //-------------
        var tmp = rutCompleto.split('-'); //-------------
        var digv = tmp[1]; //-------------
        var rut = tmp[0]; //-------------
        if (digv == 'K') digv = 'k'; //-------------
        //-------------
        return (Fn.dv(rut) == digv); //-------------
    }, //-------------
    dv: function(T) { //-------------
            var M = 0,
                S = 1; //-------------
            for (; T; T = Math.floor(T / 10)) //-------------
                S = (S + T % 10 * (9 - M++ % 6)) % 11; //-------------
            return S ? S - 1 : 'k'; //-------------
        } //-------------
}; //-------------
//---------------------------------------------------------------------------------

function listarhoras(id) {
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

$(document).ready(function() {
    $('#form-reserve').on('submit', function(e) {
        e.preventDefault();
        $('.preloader').fadeIn(1000);

        var tipo = $("#ind_tip").val();
        var ind = $("#ind_val").val();
        if (tipo == 1) {
            if (Fn.validaRut(ind) == false) {
                swal.fire("¡Oh Oh!", "El RUT ingresado es incorrecto", "warning");
                return;
            }
        }

        var data = $("#form-reserve").serialize();

        $.ajax({
            url: '../view/reservahora2.php',
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
                    setInterval(() => {
                        window.location = 'index.php';
                    }, 2000);
                } else {
                    $("#preloader").hide(1000);
                    swal.fire('¡Owww!', datos, 'warning');
                }


            }

        });



    });
});