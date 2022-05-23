//Validacion de Campos
function validarcampos(dato) {
    if (dato.length <= 0) {
        return 2;
    } else {
        return 1;
    }
};

var cor = "";
var nom = "";
var id_sop = 0;
//ShowInfo
function showinfo(nombre, correo, id) {
    cor = correo;
    nom = nombre;
    id_sop = id;

    $("#info_user span").remove();
    $("#info_user p").remove();

    console.log(
        nombre);

    $("#info_user").append("<span>" +
        nombre + "</span>");
    $("#info_user").append("<p>" +
        correo + "</p>");

    $.ajax({
            url: '../view/versoporte.php',
            type: 'POST',
            data: 'id=' + id,
        })
        .done(function(datos) {
            $("#msg_body div").remove();
            $("#msg_body").append(datos);
            $("#group_input").removeAttr("hidden");

        })
        .fail(function() {

        })
        .always(function() {

        });


}

function ReplyMessage() {
    var mensaje = $("#msg").val();
    if (validarcampos(mensaje) == 2) {
        swal.fire("¡Oh Oh!", "El campo de mensaje no puede estar vacio", "warning")
        return;
    }
    $.ajax({
            url: '../view/SupportClient.php',
            type: 'POST',
            data: 'nombre=' + nom + '&correo=' + cor +
                '&msg=' + mensaje + '&id=' + id_sop,
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