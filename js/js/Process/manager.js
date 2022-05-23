function manageronload() {
    listarcargo();
    tipo_id();
    listarregiones();
    listarsucursales();
    listarsucursal();
    listarreservas();
}

function onmodify() {
    listarsucursales();
    listarcargo();
    listarreservas();
    listarsucursal();
}

function cerrar() {
    $(".preloader").fadeOut(1000);
}

function showPreloader() {
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

//Validacion de Campos
function validarcampos(dato) {
    if (dato.length <= 0) {
        return 2;
    } else {
        return 1;
    }
};
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

function listarcargo() {
    $.ajax({
            url: '../view/listar_cargo.php',
            type: 'POST',
            data: 'nombre=wilkens',
        })
        .done(function(datos) {
            $(".cargo option").remove();
            $(".cargo").append(datos);
        })
        .fail(function() {
            $(".cargo").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function listarservicios() {
    $.ajax({
            url: '../view/listar_servicios.php',
            type: 'POST',
            data: 'nombre=wilkens',
        })
        .done(function(datos) {
            $("#user-content tr").remove();
            $("#user-content").append(datos);
        })
        .fail(function() {
            $(".region").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function listarregiones() {
    $.ajax({
            url: '../view/listarregiones.php',
            type: 'POST',
            data: 'nombre=wilkens',
        })
        .done(function(datos) {
            $(".region").append(datos);
            searchcomuna();
            searchcomuna2();
        })
        .fail(function() {
            $(".region").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function searchcomuna() {
    var valor = $("#region").val();

    var parametro = "cod=" + valor;
    $.ajax({
            url: '../view/listarcomunas.php',
            type: 'POST',
            data: parametro,
        })
        .done(function(datos) {
            $(".comuna option").remove();
            $(".comuna").append(datos);
        })
        .fail(function() {
            $(".comuna").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function searchcomuna2() {
    var valor = $("#region2").val();

    var parametro = "cod=" + valor;
    $.ajax({
            url: '../view/listarcomunas.php',
            type: 'POST',
            data: parametro,
        })
        .done(function(datos) {
            $(".comuna2 option").remove();
            $(".comuna2").append(datos);
        })
        .fail(function() {
            $(".comuna").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

function listarreservas() {
    $.ajax({
            url: '../view/listar_reserva2.php',
            type: 'POST',
            data: 'none',
        })
        .done(function(datos) {
            $(".reserve-content tr").remove();
            $(".reserve-content").append(datos);
        })
        .fail(function() {
            $(".reserve-content").append("<option>Error de conexion</option>");
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

function mostrardatos(valor) {

    $.ajax({
            url: '../view/listar_peluquerias.php',
            type: 'POST',
            data: 'id=' + valor,
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


    $("#content-mod").append("Holaaaa aqui estamos");
}

function Habilidarsucursal(valor) {
    Swal.fire({
        title: '¿Estás Seguro/a que desea Habilitar la peluqueria?',
        text: "No podrá revertir esta Decision!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No, Cancelalo',
        confirmButtonText: 'Si, Habilitalo!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                    url: '../view/Habilitarsucursal.php',
                    type: 'POST',
                    data: 'pel=' + valor,
                })
                .done(function(datos) {
                    Swal.fire(
                        'Eliminado!',
                        'Sucursal Habilitada con exito',
                        'success'
                    )
                    onmodify();
                })
                .fail(function() {

                })
                .always(function() {

                });

        }
    })
};

function eliminarsucursal(valor) {
    Swal.fire({
        title: '¿Estás Seguro/a que desea Deshabilitar la peluqueria?',
        text: "No podrá revertir esta Decision!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No, Cancelalo',
        confirmButtonText: 'Si, Deshabilitala!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                    url: '../view/eliminarsucursal.php',
                    type: 'POST',
                    data: 'pel=' + valor,
                })
                .done(function(datos) {
                    Swal.fire(
                        'Eliminado!',
                        'Sucursal Deshabilitada con exito',
                        'success'
                    )
                    onmodify();
                })
                .fail(function() {

                })
                .always(function() {

                });

        }
    })

}

$(document).ready(function() {
    $('#sed-regis').on('submit', function(e) {
        e.preventDefault();
        $('.preloader').fadeIn(1000);
        var usu = $("#usupel").val().trim();
        var rep = $("#reppel").val().trim();
        var dir = $("#dirpel").val().trim();

        if (validarcampos(usu) == 2 || validarcampos(rep) == 2 ||
            validarcampos(dir) == 2) {
            $(".preloader").hide(1000);
            swal.fire("!Oh Oh!", "hay Campos vacios", "warning");
            return;

        }


        var data = $("#sed-regis").serialize();

        $.ajax({
            url: '../view/hairdresser_register.php',
            type: 'POST',
            data: data,
            success: function(datos) {
                if (datos == 6 || datos == '6') {
                    $(".preloader").fadeOut(1000);
                    swal.fire('¡Oh Oh!', 'El nombre de usuario ya esta registrado', 'error');
                } else if (datos == 2 || datos == '2') {
                    $(".preloader").fadeOut(1000);
                    swal.fire('¡Oh Oh!', 'Error de registro, verifique los datos!', 'error');
                } else if (datos == 3 || datos == '3') {
                    $(".preloader").fadeOut(1000);
                    swal.fire('¡Exito!', 'Sucursal registrado con exito', 'success');
                    document.getElementById("sed-regis").reset();
                    searchcomuna();
                    onmodify();
                } else {
                    $("#preloader").fadeOut(1000);
                    swal.fire('¡Owww!', datos, 'warning');
                }

            }

        });



    });
});

$(document).ready(function() {
    $('#tra-regis').on('submit', function(e) {
        e.preventDefault();
        $('.preloader').fadeIn(1000);
        var tipo = $("#tip_id").val().trim();
        var identificacion = $("#txt_ind").val().trim();
        var nom = $("#nomtra").val().trim();
        var ape = $("#apetra").val().trim();
        var eda = $("#edatra").val().trim();

        var reg = $("#region2").val().trim();
        var com = $("#comuna2").val().trim();
        var dir = $("#dirtra").val().trim();
        var cor = $("#cortra").val().trim();
        var tel = $("#teltra").val().trim();
        var car = $("#cargo").val().trim();
        var sue = $("#suetra").val().trim();
        var ini_con = $("#ini-con").val().trim();
        var term_con = $("#term-con").val().trim();
        var foto = $("#foto").prop('files')[0];

        if (tipo==1) {
            if (Fn.validaRut(identificacion)==false) {
                swal.fire("!Oh Oh", "El Rut Ingresado es Incorrecto", "warning");
                return;
            }
        }

        if (validarcampos(identificacion) == 2 || validarcampos(nom) == 2 || validarcampos(ape) == 2 || validarcampos(eda) == 2 || validarcampos(reg) == 2 || validarcampos(com) == 2 || validarcampos(dir) == 2 || validarcampos(car) == 2 || validarcampos(car) == 2 || validarcampos(sue) == 2 || validarcampos(cor) == 2 || validarcampos(tel) == 2) {
            $(".preloader").hide(1000);
            swal.fire("!Oh Oh!", "hay Campos vacios", "warning");
            return;

        }

        if (sue < 325000) {
            $(".preloader").fadeOut(1000);
            swal.fire("!Oh Oh!", "Digite un Sueldo mayor o Igual al sueldo Minimo", "warning");
            return;

        }

        existe = false;




        var datos = new FormData($("#tra-regis")[0]);

        var res = 0;
        $.ajax({
            url: '../view/registrotrabajadores.php',
            type: 'POST',
            contentType: false,
            processData: false,
            data: datos,
            success: function(datos) {
                $(".preloader").fadeOut(1000);

                if (datos == "Trabajador registrado con exito") {
                    res = 1;
                    document.getElementById("tra-regis").reset();
                    onmodify();
                }
                swal.fire('Felicidades!', datos, 'success');

            }

        });
    });
});

function registrarservicio() {
    var ser = $("#txtser").val();
    var pre = $("#txtpre").val();

    if (validarcampos(ser) == 2 || validarcampos(pre) == 2) {
        swal.fire("¡Oh Oh!", "Hay campos vacios, verifica los campos", "error");
        return;
    }

    if (pre == 0) {
        swal.fire("¡Oh Oh!", "El precio no puede ser menor o igual a 0 pesos", "error");
        return;
    }

    var parametro = "servicio=" + ser + "&pre=" + pre;

    $.ajax({
        url: '../view/registrarservicio.php',
        type: 'POST',
        data: parametro,
        success: function(datos) {
            if (datos == 'true') {
                swal.fire("¡Exito!", "Servicio registrado con exito", "success");
                $("#txtser").val("");
                $("#txtpre").val("");
                listarservicios();
            } else {
                swal.fire("¡Oh Oh!", "Hubo un error en el registro", "error");
            }

        }

    });
}

function eliminartrabajador(id) {
    $.ajax({
            url: '../view/Eliminartrabajador.php',
            type: 'POST',
            data: 'id=' + id,
        })
        .done(function(datos) {

            if (datos == 'true') {
                Swal.fire(
                    'Exitó!',
                    "Trabajador Eliminado con exito",
                    'success'
                );
                setInterval(() => {
                    window.location = 'index.php';
                }, 2000);
            } else {
                Swal.fire(
                    'Oh Oh!',
                    "Hubo un problema, no se pudo EliminarEste trabajador\n Comuniquese con su administrador de sucursal, Gracias",
                    'error'
                );
            }
        })
        .fail(function() {

        })
        .always(function() {

        });
}