<?php
session_start();
if(!isset($_SESSION['id_usu'])){
    header("Location: ../Process/gateway.php");
}

include '../controller/Controller.php';

$c = new Controller();
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $_SESSION['nombre_completo'];?></title>
  <link rel="icon" type="image/x-icon" href="../img/logo/icono.png" />
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/client.css">
    <meta name="theme-color" content="#7952b3">
    <link rel="stylesheet" href="../css/bootstrap-icons-1.5.0/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>



    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }


    </style>
</head>

<body onload="onload()">
    <div class="preloader" id="preloader">
        <div class="subpreloader"></div>
    </div>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Nuevo Style</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><img src="../css/bootstrap-icons-1.5.0/house.svg" width="16" height="16">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#chat"><img src="../css/bootstrap-icons-1.5.0/chat.svg" width="16" height="16">Chat</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="../css/bootstrap-icons-1.5.0/server.svg" width="16" height="16">
                                Servicios
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#registroreserva">
                                <span data-feather="shopping-cart"></span> Reservar Hora</a></li>
                               
                            </ul>
                        </li>

                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="#" type="button" data-bs-toggle="modal" data-bs-target="#mi-cuenta">
                            <span data-feather="layers"></span>

                            Mi Cuenta
                        </a>
                    </li>
                    <li class="nav-item text-nowrap">
                        <a class="nav-link" href="../Process/close.php"><img src="../css/bootstrap-icons-1.5.0/box-arrow-right.svg" width="16" height="16" >Cerrar Sesion</a>
                    </li>
                     </ul >
                </div>
            </div>
        </nav>
    </header>


    <div class="container-fluid">
        <div class="row">
          

            <main class="container col-md-9  col-lg-10 px-md-4">
                <?php
                if ($_SESSION['reporte']==0) {
                    $id = $_SESSION['id_usu'];
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "<h4 class='alert-heading'>¡Alerta!</h4>";
                    echo "<p>¡Action Imporante a Realizar!</p>";
                    echo "<hr>";
                    echo "<p>Es necesario que valides tu correo Electronico <a type='button' onclick='sendvalidationmail()' data-bs-toggle='modal' data-bs-target='#whatsapp' class='btn btn-outline-info'  href='#'>Validar Correo</a></p>";
                    echo "</div>";
                }
                
                ?>
                <!-------------------Start Mis reservas----------------------->
                <section id="mis-reservas" h>
                    <h2>Mis Reservas</h2>
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="display table table-striped table-service text-center">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Servicios</th>
                                    <th>Sucursal</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                            $id = $_SESSION['id_usu'];
                            $lista = $c->listarreserva2($id);

                            if($lista==null){
                                echo "<tr><td colspan='7'>No Tienes reservas registradas</td></tr>";
                            }else{
                                for ($i=0; $i <count($lista) ; $i++) { 
                                    $r = $lista[$i];
                                    echo "<tr>";
                                    echo "<td>".($i+1)."</td>";
                                    echo "<td>".$r->getId_servicio()."</td>";
                                    echo "<td>".$r->getid_peluqueria()."</td>";
                                    echo "<td>".$r->getFecha()."</td>";
                                    echo "<td>".$r->getHora()."</td>";
                                    echo "<td>".$r->getId_estado()."</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-danger' title='Eliminar' onclick='Eliminar(".$r->getId_reserva().")'><img src='../img/iconos/uncheck1.svg' height='30' width='30'></button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                <!-----------------End Mis Reservas-------------------->
                <!-------------------------Start Sucursales----------------------------->
                <section id="sucursales">
                    <h2>Sucursales</h2>
                    <div id="accordion">
                        
                                    
                            
                    </div>
                </section>
                <!------------------------------------------------------->

                  <!---------------Modal Chat-------------------->
                <div class="modal  fade " id="chat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl  bg-dark">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h5 class="modal-title col-md-6 text-white" id="staticBackdropLabel">AHD - Chat</h5>
                               <button type="button " class="close btn-lg btn btn-danger" aria-label="Close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                            <div class="container-fluid h-100">
                    <div class="row justify-content-center h-100">
                        <div class="col-md-4 col-xl-3 chat">
                            <div class="card mb-sm-3 mb-md-0 contacts_card">
                                <div class="card-header">
                                    <div class="input-group">
                                        <input type="text" placeholder="Buscar..." name="" class="form-control search">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                    <h4 style="color: white;">Sucursales</h4>
                                        
                                    </div>
                                </div>
                                <div class="card-body contacts_body">
                                    <ui class="contacts">
                                        <?php
                                        $lista = $c->listarsucursales();
                                        
                                        for ($i=0; $i < count($lista); $i++) { 
                                            $p = $lista[$i];
                                            if ($p->getId()!=1) {
                                                echo "<li>";
                                                echo "<button onclick='showinfo(".$p->getId().",\"".$p->getId_com()."\")' style='cursor: pointer; width: 100%; border: none; background: transparent;'>";
                                                echo "<div class='d-flex bd-highlight'>";
                                                echo "<div class='img_cont'>";
                                                echo "<img src='../img/iconos/soporte.png' class='rounded-circle user_img'>";
                                                echo "<span class='online_icon'></span>";
                                                echo "</div>";
                                                echo "<div class='user_info'>";
                                                echo "<span>".$p->getId_com()."</span>";
                                                echo "<p>Esta en linea</p>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</button>";
                                                echo "</li>";
                                                
                                            }
                                        }
                                        
                                        ?>
                                    </ui>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                        </div>
                        <div class="col-md-8 col-xl-6 chat">
                            <div class="card">
                                <div class="card-header msg_head">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="../img/iconos/soporte.png" class="rounded-circle user_img">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info" id="info_user">
                                            <span>Mantente Contectado</span>
                                            <p>En tiempo real</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body msg_card_body" id="msg_body">
                                        <!--Contenido de mensajes-->
                                    

                                    
                                </div>
                                <div class="card-footer">
                                    <div class="input-group " id="group_input" hidden>
                                        <div class="input-group-append">
                                            <span class="input-group-text attach_btn"><i class="fas fa-comment"></i></span>
                                        </div>
                                        <textarea name="msg" id="msg" class="form-control type_msg" placeholder="Escribe tu mensaje..."></textarea>
                                        <div class="input-group-append">
                                            <button onclick="send_message()"  class="input-group-text send_btn"><i  class="fas fa-location-arrow"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!------------------------------------------------------------------------->



                <!---------------Modal Reservas-------------------->
                <div class="modal fade " id="reserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title col-md-6" id="staticBackdropLabel">AHD - Lista de Reservas</h5>
                                <button type="button" class="close btn-lg btn" aria-label="Close" data-bs-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body justify-content-center">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-lg-11 form-signin">
                                            <div class="row">
                                                <div class="col">
                                                    <table class="table table-dark table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Peluqueria</th>
                                                                <th>Servicio</th>
                                                                <th>Fecha</th>
                                                                <th>Hora</th>
                                                                <th>Estado</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="reserva-content">
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Juan Perez</td>
                                                                <td>Corte de pelo</td>
                                                                <td>12-08-2021</td>
                                                                <td>12:30</td>
                                                                <td>
                                                                    <button class="btn btn-warning"><img src="../img/iconos/pen.png" height="30" width="30"></button>
                                                                    <button class="btn btn-danger"><img src="../img/iconos/delete.png" height="30" width="30"></button>
                                                                    <button class="btn btn-success"><img src="../img/iconos/confirm.png" height="30" width="30"></button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary">Nueva reserva</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!---------------Nueva Registro-------------------->
                <div class="modal fade " id="registroreserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title col-md-6" id="staticBackdropLabel">AHD - Registro de Reservas</h5>
                                <button type="button" class="close btn-lg btn" aria-label="Close" data-bs-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body justify-content-center">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-lg-11 form-signin">
                                            <form name="form-reserve" id="form-reserve" method="post" action="../Process/view/reservahora.php">
                                                <div class="row">
                                                    <div class="col">
                                                        <label>Seleccione su Servicio:</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col" id="service-list">

                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label>Seleccione el Sucursal:</label>
                                                        <select onchange="buscarpeluquero()" class="form-control sucursa" id="sucur" name="txtsucur">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Seleccione la fecha</label>
                                                        <input type="date" name="fec_res" id="fec_res" class="form-control" onchange="listar_hora()">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Horas Disponible</label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col hora">



                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Seleccione un Peluquero</label>
                                                        <select name="peluquero" id="peluquero" class="form-control peluquero">

                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-warning">Restablecer</button>
                                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-------------------------------------------------->
                <!-------------------------------------------------->


                <!---------------Modal Cuenta Cliente-------------------->
                <div class="modal fade " id="mi-cuenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title col-md-6" id="staticBackdropLabel"><?php echo $_SESSION['nombre_completo'];?> - Cuenta</h5>
                                <button type="button" class="close btn-lg btn" aria-label="Close" data-bs-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body justify-content-center">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-lg-11 form-signin">
                                            <div class="mi-cuenta">
                                              
                                            </div>
                                        <form id="mod-con">
                                            <div class="cont-mod" hidden="">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">Nueva Contraseña</label>
                                                    <input class="form-control" placeholder="Ingrese su nueva contraseña" type="password" id="conmod1">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">Repetir Contraseña</label>
                                                    <input type="password" class="form-control" placeholder="Repite la contraseña" id="conmod2">
                                                </div>
                                            </div>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" onclick="eliminarcuenta()">Eliminar Cuenta</button>
                                                <button type="button" onclick="modificar_con()" class="btn btn-primary">Modificar Contraseña</button>
                                                <button type="button" onclick="guardar()" class="btn btn-success">Guardar Contraseña</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <!--------------Modal Validar Correo Electronico---------->                         
                <div class="modal fade " id="whatsapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title col-md-6" id="staticBackdropLabel"><?php echo $_SESSION['nombre_completo'];?> - Validar Correo Electronico</h5>
                                <button type="button" class="close btn-lg btn" aria-label="Close" data-bs-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body justify-content-center">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-lg-11 form-signin">
                                            <div class="mi-whatsapp">
                                              <div class="row justify-content-center">
                                                  <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6 IngresarCodigo">
                                                      <label for="">Correo Electronico: </label>
                                                      <label id="cor"><span><?php echo $_SESSION['cor_usu']?></span></label>
                                                      <label for="">Hemos enviado un correo para validar tu email, Verifica tu correo por favor!</label>
                                                      <label for="">¿No es tu correo electronico?</label>
                                                      <input type="email" name="correo" class="form-control" id="correo" placeholder="Ingrese un nuevo Correo electronico"  required="">
                                                      <label>Ejemplo:nombre@gmail.com</label><br>
                                                      <button onclick="registrarcorreo()" class="btn btn-success btn-lg">Registrar</button>
                                                  </div>

                                                   <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6 validarCodigo">
                                                      <label for="">Ingrese El Codigo</label>
                                                      <input type="number" name="phone-number" class="form-control" id="phone-number" placeholder="Ingrese el codigo" min="100000" maxlength="6" max="999999" required="">
                                                      <label>Ejemplo: 123456</label><br>
                                                      <button onclick="ValidarCodigo(1)" class="btn btn-success btn-lg">Validar</button>
                                                  </div>
                                              </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>












            </main>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="../js/Process/client.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../manager/js/datatables-simple-demo.js"></script>
    <script type="text/javascript">
// Initialize our function when the document is ready for events.
jQuery(document).ready(function(){
    // Listen for the input event.
    jQuery("#phone-number").on('input', function (evt) {
        // Allow only numbers.
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
});
</script> 
</body>

</html>
