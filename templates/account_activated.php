<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activacion de Cuenta</title>
    <style>
        .container {
            width: 70%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .container img {
            width: 300px;
        }
        
        h1,
        h2,
        h3,
        h4,
        h5 {
            margin: 0;
        }

        a{
            text-decoration: none;
            color: red;
            text-shadow: 2px 2px 2px skyblue;
        }
    </style>
</head>

<body>

    <div class="container">
        <img src="../img/logo/logo.png" alt="AHD.png">
        <h1>Nuevo Style</h1>
        <h2>
            <?php
            echo $_SESSION['nombre_completo'];
            ?>
        </h2>
        <h3>Su correo a sido validado con exito</h3>
        <h4>Gracias por su preferencia</h4>
        <a href="../client/">Volver al menu</a>
    </div>

</body>

</html>