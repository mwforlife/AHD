<html lang="es">

<head>
	<meta charset="utf-8">
	<title>Example Title</title>
	<meta name="author" content="Wilkens Mompoint">
	<meta name="description" content="Example description">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="">
	<link rel="icon" type="image/x-icon" href=""/>
	<style>
	    .text-center{
	        text-align: center;
	    }
        img{
            margin: 0 auto;
        }
        h1,h2, h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        a{
           border: 1px solid #0561B3; 
            background-color: #238CEA; 
            color: #fff; 
            text-decoration: none; 
            font-size: 18px; 
            padding: 10px 20px; 
            border-radius: 20px;
            box-shadow: 5px 5px 5px #000;
        }
        a:hover{
            background-color: #0B823A;
        }
	</style>
</head>

<body>
	<div id="container" style="width: 400px;height: auto; margin: 0 auto; border: 6px solid #fff; border-top-color: #057B04 ; border-bottom-color: #057B04 ; border-radius: 5px; box-shadow: 20px 5px 13px 3px #DE841B ">
        
        <center><img src="{EMAIL_LOGO}" alt="{EMAIL_LOGO}" width="100" height="100"></center>
	    <h1 class="text-center">AHD - Nuevo Style</h1>
	    <h3 class="text-center">Su reserva ha sido Generada con exito</h3>
	    <hr style="width: 80%; border-color: red;">
	    <p>Hola {TO_NAME},<br/>
	    Tenemos el agrado de Comunicarle que su su reserva a sido agendada con exito.<br>
	    A la brevedad se le hará llegar un correo confirmando su reserva. muchas gracias por paciencia.<br>
	    </p>
	    <h4>Detalles de la reserva:</h4>
	    <p>
	        Fecha: {RESERVE_DATE}<br>
	        Hora: {RESERVE_HOUR}<br>
	        Servicio: {RESERVE_SERVICE}<br>
	    </p>
	</div>
</body>

</html>