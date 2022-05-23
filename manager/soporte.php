<?php
session_start();
if(!isset($_SESSION['user_pel'])){
    header("Location: ../Process/gateway.php");
}elseif($_SESSION['user_pel']!=1){
    header("Location: chat.php");
}

include '../controller/Controller.php';

$c = new Controller();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/x-icon" href="../img/logo/icono.png" />
    <title>Soporte -  Nuevo Style - <?php echo  $_SESSION['rep_pel'] ?></title>
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <script src="js/funciones.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/Process/Soportes.js"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html"><img src="../img/logo/logo.png" width="125"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        
        <!-- Navbar-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">principal</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Estadisticas
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Registrado como:</div>
                    <?php echo $_SESSION['rep_pel'];?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid h-100">
                <h1 class="mt-4 text-center">Mensajeria</h1>
                    
                    <div class="row justify-content-center h-100">
                        <div class="col-md-4 col-xl-3 chat">
                            <div class="card mb-sm-3 mb-md-0 contacts_card">
                                <div class="card-header">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search..." name="" class="form-control search">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body contacts_body">
                                    <ui class="contacts">
                                        <?php
                                        $id = $_SESSION['user_pel'];
                                        $lista = $c->listarclientsupport();

                                        if ($lista==null) {
                                            echo "<li>";
                                                    echo "<button disabled style=' width: 100%; border: none; background: transparent;'>";
                                                    echo "<div class='d-flex bd-highlight'>";
                                                    echo "<div class='img_cont'>";
                                                    echo "<img src='../img/iconos/soporte.png' class='rounded-circle user_img'>";
                                                    echo "</div>";
                                                    echo "<div class='user_info'>";
                                                    echo "<span>No hay Solicitud de soportes</span>";
                                                    echo "</div>";
                                                    echo "</div>";
                                                    echo "</button>";
                                                    echo "</li>";
                                        }else{
                                            for ($i=0; $i < count($lista); $i++) { 
                                                $s = $lista[$i];
                                                    echo "<li>";
                                                    echo "<button onclick='showinfo(\"".$s->getNombre()."\",\"".$s->getCorreo()."\",\"".$s->getId()."\")' style='cursor: pointer; width: 100%; border: none; background: transparent;'>";
                                                    echo "<div class='d-flex bd-highlight'>";
                                                    echo "<div class='img_cont'>";
                                                    echo "<img src='../img/iconos/soporte.png' class='rounded-circle user_img'>";
                                                    echo "</div>";
                                                    echo "<div class='user_info'>";
                                                    echo "<span>".$s->getNombre()."</span>";
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
                                            <span>Contacto de Soporte</span>
                                            <p>Comunica con tus clientes</p>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="card-body msg_card_body" id="msg_body">
                                    
                                </div>
                                <div class="card-footer">
                                <div class="input-group " id="group_input" hidden>
                                        <div class="input-group-append">
                                            <span class="input-group-text attach_btn"><i class="fas fa-comment"></i></span>
                                        </div>
                                        <textarea name="msg" id="msg" class="form-control type_msg" placeholder="Escribe tu mensaje..."></textarea>
                                        <div class="input-group-append">
                                            <button onclick="ReplyMessage()"  class="input-group-text send_btn"><i  class="fas fa-location-arrow"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; AHD Haidresser- Nuevo Style 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a> &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    
    
</body>

</html>