<?php
session_start();
require '../controller/Controller.php';

$c = new Controller();
$id_pel=0;
$id_tra='';
if (isset($_SESSION['user_tra']) && isset($_SESSION['cargo_id'])) {
    $id_pel= $_SESSION['pel_tra'];
    if ($_SESSION['cargo_id']!=1) {
        header("Locacion: ../Process/gateway.php");
       
    }
}else{
    header("Locacion: ../Process/gateway.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Wilkens Mompoint">
    <link rel="icon" type="image/x-icon" href="../img/logo/icono.png" />


    <script src="../js/jquery.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="../js/Process/recepcionist.js"></script>
    <title><?php echo $_SESSION['nom_tra']?> - Nuevo Style</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

</head>

<body id="page-top" onload="tipo_id()">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon" >
                    <img width="160" src="../img/logo/logo.png">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Principal
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Atencion al cliente</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="#" data-toggle="modal" data-target="#reserve_modal">Reservas de horas</a>
                        <a class="collapse-item" href="#" data-toggle="modal" data-target="#reserve_regis">Registrar reserva</a>
                        <a class="collapse-item" href="#" data-toggle="modal" data-target="#atencion_modal">Atencion al Cliente</a>
                    </div>
                </div>
            </li>

           
           

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar cliente"
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nom_tra'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php
                                        echo "../img/image_server/workers_profile/". $_SESSION['fotito'];
                                    ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profile_details">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Reservas por confirmar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                    $res = $c->reservaspendientes1($id_pel);
                                                    echo $res;
                                                
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Reservas confirmadas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                    $res = $c->reservasConfirmadas1($id_pel);
                                                    echo $res;
                                                
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Clientes atendidos (hoy)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php
                                                    $res = $c->reservasatendidas1($id_pel);
                                                    echo $res;
                                                
                                                ?>
                                                
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo $res?>%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Atenciones pendientes (hoy)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                    $res = $c->AtencionesPendientes($id_pel);
                                                    echo $res;
                                                
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col">
                            <div class="card shadow ">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Cantidad de atenciones pendientes por trabajadores</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="width: 100% !important;">
                                    <table id="datatablesSimple1" class="display table table-striped">
                                <thead>
                                    <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                        <th>Cantidad de clientes por atender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $lista = $c->cantidad_clientes_atencion($id_pel);
                                    for ($i=0; $i < count($lista); $i++) { 
                                        $det = $lista[$i];
                                        echo "<tr>";
                                        echo "<td>".$det->getid()."</td>";
                                        echo "<td>".$det->getId_servicios()."</td>";
                                        echo "<td>".$det->getId_peluqueria()."</td>";
                                        echo "<td>".$det->getPrecio()."</td>";
                                        echo "</tr>";
                                    }
                                    
                                    
                                    ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                        <th>Cantidad de clientes por atender</th>
                                    </tr>
                                </tfoot>
                                <tbody >
                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Nuevo Style - AHD Hairdresser 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Listo/a para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">¿Estas Usted Seguro/a de cerrar la sesion actual?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../Process/close.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profile_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mi Perfil</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row"><div class="col text-center">

                            <img width="120" style='border-radius:50%;' height="120" src="../img/image_server/workers_profile/<?php echo $_SESSION['fotito'];?>" alt="Profile_Picture">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                        <label for="">Nombre:</label>
                        <label for=""><?php echo $_SESSION['nom_tra'];?></label>
                        </div>
                        <div class="col-md-6 col-lg-6">
                        <label for="">Edad:</label>
                        <label for=""><?php echo $_SESSION['edad'];?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                        <label for="">Region:</label>
                        <label for=""><?php echo $_SESSION['nom_reg'];?></label>
                        </div>
                        <div class="col-md-6 col-lg-6">
                        <label for="">Comuna:</label>
                        <label for=""><?php echo $_SESSION['nom_com'];?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                        <label for="">Direccion:</label>
                        <label for=""><?php echo $_SESSION['direccion'];?></label>
                        </div>
                        <div class="col-md-6 col-lg-6">
                        <label for="">Correo:</label>
                        <label for=""><?php echo $_SESSION['correo'];?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                        <label for="">Cargo:</label>
                        <label for=""><?php echo $_SESSION['cargo'];?></label>
                        </div>
                        <div class="col-md-6 col-lg-6">
                        <label for="">Sueldo:</label>
                        <label for=""><?php echo $_SESSION['sueldo'];?>$</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Reserva Modal-->
    <div class="modal fade" id="reserve_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reservas de horas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="datatablesSimple" class="display table table-striped">
                                <thead>
                                    <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Servicio</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $lista = $c->listarreserva4($id_pel);

                                    for ($i=0; $i <count($lista) ; $i++) { 
                                        $res = $lista[$i];
                                        echo "<tr>";
                                        echo "<td>".$res->getId_usuario()."</td>";
                                        echo "<td>".$res->getId_peluqueria()."</td>";
                                        echo "<td>".$res->getId_servicio()."</td>";
                                        echo "<td>".$res->getFecha()."</td>";
                                        echo "<td>".$res->getHora()."</td>";
                                        echo "<td>".$res->getId_estado()."</td>";
                                        echo "<td>";
                                        echo "<img style='cursor:pointer;' title='Confirmar' src='../img/iconos/check.svg' onclick='confirmar(".$res->getId_reserva().")'>";
                                        echo "<img style='cursor:pointer;' title='Cancelar' src='../img/iconos/uncheck.svg' onclick='cancelar(".$res->getId_reserva().")'>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Servicio</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Estado</th>
                                        <th>Acción</th> 
                                    </tr>
                                </tfoot>
                                <tbody >
                                </tbody>
                            </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Cliente Atencion-->
    <div class="modal fade" id="atencion_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atencion al cliente</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="datatablesSimple2" class="display table table-striped">
                                <thead>
                                    <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Servicio</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $lista = $c->listarreserva9($id_pel);

                                    for ($i=0; $i <count($lista) ; $i++) { 
                                        $res = $lista[$i];
                                        echo "<tr>";
                                        echo "<td>".$res->getId_usuario()."</td>";
                                        echo "<td>".$res->getId_peluqueria()."</td>";
                                        echo "<td>".$res->getId_servicio()."</td>";
                                        echo "<td>".$res->getFecha()."</td>";
                                        echo "<td>".$res->getHora()."</td>";
                                        echo "<td>".$res->getId_estado()."</td>";
                                        echo "<td>";
                                        echo "<img style='cursor:pointer;' title='Confirmar Asistencia' src='../img/iconos/check.svg' onclick='Atender(".$res->getId_reserva().")'>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Servicio</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Estado</th>
                                        <th>Acción</th> 
                                    </tr>
                                </tfoot>
                                <tbody >
                                </tbody>
                            </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    
    
     <!-- Reserva Modal-->
    <div class="modal fade" id="reserve_regis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Reservas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" id="form-reserve" name="form-reserve">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <label for="">Ingrese el Tipo de identificacion</label>
                            <select name="ind_tip" id="ind_tip" class="form-control" onchange="tipo_id()">
                                <option value="1">Rut Chileno</option>
                                <option value="2">Otros</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <label for="">Ingrese la Identificacion del cliente:</label>
                            <input type="text" id="ind_val" name="ind_val" placeholder="Ingrese su Identificacion" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Selecione el servicio</label>
                            <div id="servicio">
                                <?php
                                $lista = $c->listarservicios();

                                if (is_null($lista)) {
                                    echo "<div><h4>No hay servicios Registrado</h4></div>";
                                }else{
                                    for ($i=0; $i < count($lista) ; $i++) { 
                                        $s = $lista[$i];
                                        echo "<div class='form-check form-check-inline'>";
                                     echo "<input class='form-check-input btn-check' type='radio' name='service' id='service".$s->getId()."' value='".$s->getId()."'>";
                                     echo "<label class='form-check-label btn btn-outline-success' for='service".$s->getId()."'>".$s->getNombre()."</label>";
                                     echo "</div>"; 
                                    }
                                    
                                        
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <label for="">Seleccione la fecha</label>
                            <input type="date" name="fec_res" id="fec_res" class="form-control" onchange="listarhoras(<?php echo $id_pel;?>)">
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <label for="">Seleccione un Peluquero</label>
                            <select name="peluquero" id="peluquero" class="form-control">
                                <?php
                                
                                    $lista = $c->listarpeluqueros($id_pel);

                                    if (count($lista)==0) {
                                        echo "<option value='0'>No Hay Trabajadores Disponible</option>";
                                    }else{
                                        $_SESSION['sucursal'] = $lista;
                                    for ($i=0; $i < count($lista) ; $i++) { 
                                        $p = $lista[$i];
                                        if($p->getTipo()!="Recepcionista" && $p->getTipo()!="Auxiliar de Aseo"){
                                        echo "<option value='".$p->getId()."' style='background-image:url(../img/logo/logo.png)".$p->getFoto()."' >".$p->getNombre()." - ".$p->getTipo()."</option>";
                                        }

                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <label>Horas Disponible</label>
                            <div class="hora">
                                
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                   <button class="btn btn-warning" type="reset">Restablecer</button>
                   <button class="btn btn-success" type="submit">Registrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../manager/js/datatables-simple-demo.js"></script>
    <script src="../js/jquery.mask.js"></script>



</body>

</html>