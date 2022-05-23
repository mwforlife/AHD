//Validacion de Campos
function validarcampos(dato) {
    if (dato.length <= 0) {
        return 2;
    } else {
        return 1;
    }
};

//ShowInfo
function showinfo(id, nombre, apellido) {
    $.ajax({
            url: '../view/cant_message1.php',
            type: 'POST',
            data: 'id=' + id,
        })
        .done(function(datos) {
            $("#info_user span").remove();
            $("#info_user p").remove();

            console.log(
                nombre + " " + apellido);

            $("#info_user").append("<span>" +
                nombre + " " + apellido + "</span>");
            $("#info_user").append("<p>" +
                datos + "</p>");

        })
        .fail(function() {

        })
        .always(function() {

        });

    $.ajax({
            url: '../view/show_hairdresser_message.php',
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
            data: 'msg=' + mensaje + '&estado=2',
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
            url: '../view/show_hairdresser_message.php',
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