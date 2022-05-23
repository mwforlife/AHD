//Eventos para ejecutar al cargar la pagina
function eventos() {
    listarregiones();
    searchcomuna();
    tipo_id();
    validarlogin();

};
/*-----Validacion de Campos-----*/
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

//-----Tipo de Identificador-----//
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

//-------Listar Region---------//
function listarregiones() {
    $.ajax({
            url: 'view/listarregiones.php',
            type: 'POST',
            data: 'nombre=wilkens',
        })
        .done(function(datos) {
            $(".region").append(datos);
            searchcomuna();
        })
        .fail(function() {
            $(".region").append("<option>Error de conexion</option>");
        })
        .always(function() {

        });
}

//-------Search City------------//
function searchcomuna() {
    var valor = $("#region").val();

    var parametro = "cod=" + valor;
    $.ajax({
            url: 'view/listarcomunas.php',
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

//-------Client Login--------------//
function login_usuario() {
    var nombre = $("#txtusu").val().trim();
    var contra = $("#txtcon").val().trim();
    if (nombre.length <= 0 || contra.length <= 0) {
        //swal("¡Oh Oh!", "Campos Vacios", "error");
        Toastify({
            text: "Hay campos vacios",
            backgroundColor: "linear-gradient(to right, #F15608, #96c93d)",
            className: "info",
            position: "right",
            gravity: "top"
        }).showToast();
        return;

    }

    $('.preloader').fadeIn(1);
    var parametros = "nom_usu=" + nombre + "&pas_usu=" + contra;
    $.ajax({
            url: 'view/User_login.php',
            type: 'POST',
            data: parametros,
        })
        .done(function(datos) {
            if (datos == "Error") {
                $(".preloader").hide(1000);
                swal('¡Oh Oh!', 'Error de usuario o Contraseña', 'error');
            } else if (datos == "Suspendido") {
                $(".preloader").hide(1000);
                swal('¡Atencion!', 'Su cuenta ha sido suspendida \n Escriba al departamento de soporte para resolver su problema! \n Gracias ', 'warning');
            } else if (datos == "Exito") {
                $(".preloader").hide(1000);
                window.location = "client";
                swal('¡Exito!', 'Bienvenido ', 'success');
            }
        })
        .fail(function() {
            $("#preloader").hide(1000);
        })
        .always(function() {

        });
}

//--------Hairdresser Login------------//
function login_peluqueria() {
    var nombre = $("#txtusu1").val().trim();
    var contra = $("#txtcon1").val().trim();
    if (nombre.length <= 0 || contra.length <= 0) {
        Toastify({
            text: "Hay campos vacios",
            backgroundColor: "linear-gradient(to right, #F15608, #96c93d)",
            className: "info",
            position: "right",
            gravity: "top"
        }).showToast();

        return;
    }

    $('.preloader').fadeIn(1);
    var parametros = "nom_usu=" + nombre + "&con_usu=" + contra;
    $.ajax({
            url: 'view/Hairdresser_login.php',
            type: 'POST',
            data: parametros,
        })
        .done(function(datos) {
            if (datos == "Error") {
                $(".preloader").hide(1000);
                swal('¡Oh Oh!', 'Error de usuario o Contraseña', 'error');
            } else if (datos = "Exito") {
                $(".preloader").hide(1000);
                window.location = "manager";
                swal('¡Exito!', 'Bienvenido ', 'success');
            }
        })
        .fail(function() {

        })
        .always(function() {

        });
}

//-------Workers Login-----------//
function login_trabajador() {
    var nombre = $("#txtusu1").val().trim();
    var contra = $("#txtcon1").val().trim();
    if (nombre.length <= 0 || contra.length <= 0) {
        Toastify({
            text: "Hay campos vacios",
            backgroundColor: "linear-gradient(to right, #F15608, #96c93d)",
            className: "info",
            position: "right",
            gravity: "top"
        }).showToast();
        return;
    }

    $('.preloader').fadeIn(1);
    var parametros = "nom_usu=" + nombre + "&con_usu=" + contra;
    $.ajax({
            url: 'view/workers_login.php',
            type: 'POST',
            data: parametros,
        })
        .done(function(datos) {
            $(".preloader").hide(1000);
            if (datos == "Error") {
                swal('¡Oh Oh!', 'Error de usuario o Contraseña', 'error');
            } else if (datos = "Exito") {
                $(".preloader").hide(1000);
                window.location = "Process/gateway.php";
                swal('¡Exito!', 'Bienvenido ', 'success');
            } else {
                $(".preloader").hide(1000);
                window.location = "Process/gateway.php";
                swal('¡Exito!', datos, 'success');
            }
        })
        .fail(function() {

        })
        .always(function() {

        });
}

//-------Receptionist Login-----------//
function login_recepcionista() {
    var nombre = $("#txtusu1").val().trim();
    var contra = $("#txtcon1").val().trim();
    if (nombre.length <= 0 || contra.length <= 0) {
        Toastify({
            text: "Hay campos vacios",
            backgroundColor: "linear-gradient(to right, #F15608, #96c93d)",
            className: "info",
            position: "right",
            gravity: "top"
        }).showToast();
        return;
    }

    $('.preloader').fadeIn(1);
    var parametros = "nom_usu=" + nombre + "&con_usu=" + contra;
    $.ajax({
            url: 'view/Recepcionist_login.php',
            type: 'POST',
            data: parametros,
        })
        .done(function(datos) {
            $(".preloader").hide(1000);
            if (datos == "Error") {
                swal('¡Oh Oh!', 'Error de usuario o Contraseña', 'error');
            } else if (datos = "Exito") {
                $(".preloader").hide(1000);
                window.location = "Process/gateway.php";
                swal('¡Exito!', 'Bienvenido ', 'success');
            } else {
                $(".preloader").hide(1000);
                window.location = "Process/gateway.php";
                swal('¡Exito!', datos, 'success');
            }
        })
        .fail(function() {

        })
        .always(function() {

        });
}


//-------Login User-----------------//
$(document).ready(function() {
    $('#form-login').on('submit', function(e) {
        e.preventDefault();
        login_usuario();

    });
});


//------ General Login Funtion-------//
$(document).ready(function() {
    $('#form-login1').on('submit', function(e) {
        e.preventDefault();
        var tipo = $("#user_tip").val();
        if (tipo == 2 || tipo == '2') {
            login_peluqueria();
        } else if (tipo == 3 || tipo == '3') {
            login_trabajador();
        } else if (tipo == 4 || tipo == '4') {
            login_recepcionista();
        }

    });


});


$(document).ready(function() {
    //Registro de clientes
    $('#form-register').on('submit', function(e) {
        e.preventDefault();
        var tipo = $("#tip_id").val().trim();
        var identificacion = $("#txt_ind").val().trim();
        var nombre = $("#nom_usu").val().trim();
        var apellido = $("#ape_usu").val().trim();
        var login = $("#log_usu").val().trim();
        var password = $("#pas_usu").val().trim();
        var confirmpas = $("#con_pas").val().trim();
        var edad = $("#eda_usu").val().trim();
        var sexo = $("#sex_usu").val().trim();
        var telefono = $("#tel_usu").val().trim();
        var direccion = $("#dir").val().trim();
        var correo = $("#cor_usu").val().trim();
        var region = $("#region").val();
        var comuna = $("#comuna").val();

        if (validarcampos(identificacion) == 2 || validarcampos(nombre) == 2 ||
            validarcampos(apellido) == 2 || validarcampos(login) == 2 ||
            validarcampos(password) == 2 || validarcampos(confirmpas) == 2 ||
            validarcampos(edad) == 2 || validarcampos(sexo) == 2 ||
            validarcampos(telefono) == 2 || validarcampos(direccion) == 2 || validarcampos(correo) == 2) {
            $(".preloader").hide(1000);
            ToastDanger("Hay Campos Vacios");
            $("#txt_ind").focus();
            return;

        }

        if (password != confirmpas) {
            $(".preloader").fadeOut(1000);
            ToastDanger("Las contraseñas no coinciden");
            $("#pas_usu").focus();
            return;
        }

        if (password.length < 6) {
            ToastDanger("La Contraseña debe tener mas de 6 digitos");
            return;
        }
        existe = false;

        if (region == 0) {
            $(".preloader").fadeOut(1000);
            ToastDanger("Elige una region Valida");
            return;
        }
        if (comuna == 0) {
            $(".preloader").fadeOut(1000);
            ToastSuccess("Elige una comuna Valida");
            return;
        }

        if (tipo == 1) {
            if (Fn.validaRut(identificacion) == true) {
                existe = true;
            } else if (Fn.validaRut(identificacion) == false) {
                $(".preloader").fadeOut(1000);
                ToastDanger("El Rut ingresado no es valido");
                $("#txt_ind").focus();
                return;
            }
        } else {
            existe = true;
        }

        var isChecked = document.getElementById("btn_term1").checked;
        if (isChecked) {

        } else {
            $(".preloader").fadeOut(1000);
            ToastDanger("Se debe aceptar los terminos de uso y condiciones para registrarse");
            $("#btn_term1").focus();
            return;
        }

        if (Fn.validaRut(identificacion)) {

        } else {
            ToastDanger("El Rut ingresado no es valido");
            $(".preloader").fadeOut(1000);
            return;
        };

        var data = $("#form-register").serialize();

        $('.preloader').fadeIn(1000);
        $.ajax({
            url: 'view/User_register.php',
            type: 'POST',
            data: data,
            success: function(datos) {
                if (datos == 6 || datos == '6') {
                    $(".preloader").hide(1000);
                    swal('¡Oh Oh!', 'Este Rut o El nombre de usuario ya esta registrado', 'error');
                } else if (datos == 2 || datos == '2') {
                    $(".preloader").hide(1000);
                    swal('¡Oh Oh!', 'Error de registro, verifique los datos!', 'error');
                } else if (datos == 3 || datos == '3') {
                    $(".preloader").hide(1000);
                    swal('¡Exito!', 'Usuarios registrado con exito', 'success');
                    document.getElementById("form-register").reset();
                } else {
                    $(".preloader").hide(1000);
                    swal('¡Owww!', datos, 'warning');
                }

            }

        });



    });

});

function RegistrarSoportes() {
    //Aqui Incluimos el botton de registrar Soporte
    var nombre = $("#name").val().trim();
    var correo = $("#email").val().trim();
    var phone = $("#phone").val().trim();
    var subject = $("#subject").val().trim();
    var message = $("#message").val().trim();

    if (validarcampos(nombre) == 2 || validarcampos(correo) == 2 || validarcampos(phone) == 2 ||
        validarcampos(subject) == 2 || validarcampos(message) == 2) {
        ToastDanger("Hay campos vacios");
        return;
    }

    if (phone < 722222222 || phone > 999999999) {
        ToastDanger("El campo de telefono debe ser mayor a 9 digitos");
        return;
    }

    if (phone.length < 9) {
        ToastDanger("El campo de telefono debe ser mayor a 9 digitos");
        return;
    }
    var parametros = "name=" + nombre + "&email=" + correo + "&phone=" + phone + "&subject=" + subject + "&message=" + message;
    $.ajax({
            url: 'view/Message_Support_Register.php',
            type: 'POST',
            data: parametros,
        })
        .done(function(datos) {
            if (datos == 1 || datos == '1') {
                swal("Oh Oh", "Su solicitud ha sido registrada con exito\n en un momento un funcionario le contactará por telefono o se le hará llegar un correo electronico", "success");

            }

        })
        .fail(function() {

        })
        .always(function() {

        });


}

//-------Toast Danger-------------//
function ToastDanger(text) {
    Toastify({
        text: text,
        backgroundColor: "linear-gradient(to right, #F15608, #96c93d)",
        className: "info",
        position: "right",
        gravity: "top"
    }).showToast();
}

//-----------Toast Success--------//
function ToastSuccess(text) {
    Toastify({
        text: text,
        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
        className: "info",
        position: "right",
        gravity: "top"
    }).showToast();
}

function validarlogin() {
    $.ajax({
            url: 'view/validarlogin.php',
            type: 'POST',
            data: 'none',
        })
        .done(function(datos) {
            if (datos == 0) {
                $("#appointment-btn").append("<a href='#login' class='smoothScoll' data-toggle ='modal' data-target='#login' > Iniciar sesion </a>");
            } else if (datos == 1) {
                $("#appointment-btn").append("<a href='Process/gateway.php'  > Mi Cuenta </a>");
            }
        })
        .fail(function() {

        })
        .always(function() {

        });
}