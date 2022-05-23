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
        h1{
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
        
        <center><a href="{SITE_ADDR}"><img src="{EMAIL_LOGO}" width="100" height="100"></a></center>
	    <h1 class="text-center">AHD - Nuevo Style</h1>
	    <h3 class="text-center">Bienvenido a nuestra comunidad</h3>
	    <hr style="width: 80%; border-color: red;">
	    <p>Hola {TO_NAME},<br/>
	    Tenemos el agrado de darle la bienvenida a nuestra pagina web.<br>
	    Para poder disfrutar de todas las funciones que ofrece el sistema puedes activar tu cuenta haciendo clic en el boton que esta en el apartado inferio del mensaje.<br>
	    Gracias por registrarte con nosotros.
	    </p>
	    <p style="display: flex; justify-content: center; margin-top: 10px;">
	        <center>
					<a href="{CUSTOM_URL}" target="_blank">Activa tu Cuenta</a>
            </center>
        </p>
	</div>
</body>

</html>