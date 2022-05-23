//Validacion de Campos
function validarcampos(dato) {
    if (dato.length <= 0) {
        return 2;
    } else {
        return 1;
    }
};

/***Mail Contact***/
$(document).ready(function () {
    $('#form-contact').on('submit', function (e) {
        e.preventDefault();
        $('.preloader').fadeIn(1);
        var nombre = $("#name").val().trim();
        var mail = $("#email").val().trim();
        var asunto = $("#asunto").val().trim();
        var phone = $("#phone").val().trim();
        var mensaje = $("#message").val().trim();
        
        if(validarcampos(nombre)==2 || validarcampos(mail)==2 || validarcampos(asunto)==2 || validarcampos(phone)==2 || validarcampos(mensaje)==2){
             $('.preloader').hide();
           swal("¡Oh Oh","Verifica rellenar todos los campos", "error");
        return;
        }else{
        var parametros = "name="+nombre+"&email="+mail+"&phone="+phone+"&asunto="+asunto+"&message="+mensaje;
        $.ajax({
        url: 'Process/mail_contact.php',
        type: 'POST',
        data: parametros,
        })
        .done(function (datos) {
            $('.preloader').hide();
            swal("¡Contact!",datos,"warning");
            
        })
        .fail(function () {

        })
        .always(function () {

        });
        }
    }
);
});
