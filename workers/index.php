<?php
session_start();
require '../controller/Controller.php';

$c = new Controller();
$id_pel=0;
if (isset($_SESSION['user_tra']) && isset($_SESSION['cargo_id'])) {
    $id_pel= $_SESSION['pel_tra'];
    $id_tra = $_SESSION['user_tra'];
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
        <meta name="author" content="">
        <link rel="icon" type="image/x-icon" href="../img/logo/icono.png" />

        <title>Nuevo Style - Trabajador</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Nuevo Style</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
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
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar...." aria-label="Search" aria-describedby="basic-addon2">
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
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $_SESSION['nom_tra'];?></span>
                                    <?php
                                    $id = $_SESSION['user_tra'];
                                    $foto = $c->buscarPefil($id);
                                    ?>
                                    <img class="img-profile rounded-circle"  src="
                                    <?php
                                    if ($foto==null) {
                                        echo "img/undraw_profile.svg";
                                    }else{
                                        echo "../img/image_server/workers_profile/". $foto;
                                    }
                                    ?>">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar Session
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
                                                    Atención (Mes Actual)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php
                                                    $res = $c->atencionMesactual($id_tra);
                                                    if ($res=='error') {
                                                        echo 0;
                                                    }else{
                                                        echo $res;
                                                    };
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
                                                    Atención (Año Actual)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $res = $c->atencionAnoactual($id_tra);
                                                    if ($res=='error') {
                                                        echo 0;
                                                    }else{
                                                        echo $res;
                                                    }
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
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Atencion (Hoy)
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        $res = $c->atencioDiaActual($id_tra);
                                                        if ($res=='error') {
                                                            $res= 0;
                                                            echo $res;
                                                        }else{
                                                            echo $res;
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $res;?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                    Atenciones Pendientes</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $res = $c->PendientesTrabajador($id_tra);
                                                    if ($res=='error') {
                                                        echo 0;
                                                    }else{
                                                        echo $res;
                                                    }
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
                        <div class="row">
                        <div class="col">
                            <div class="card shadow ">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Listado de clientes por atender (Hoy)</h6>
                                    
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table id="datatablesSimple" class="display table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Identificador</th>
                                            <th>Nombre</th>
                                            <th>Servicio</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Estado</th>
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
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    </tbody>
                                </table>
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
                            <span>Copyright &copy; - AHD Haidresser- Nuevo Style 2021</span>
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Listo para Salir?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">Seleccione "Cerrar sesión" si esta listo para cerrar esta sesión.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-primary" href="../Process/close.php">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Modal-->
        <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mi Perfil</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                        <div class="col text-center">
                            <img width="120" height="120" src="../img/image_server/workers_profile/<?php echo $foto;?>" alt="Profile_Picture">
                        </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <label for="">Nombre Completo:</label>
                                <p>
                                    <?php echo $_SESSION['nom_tra']?>
                                </p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label for="">Edad</label>
                                <p>
                                    <?php echo $_SESSION['edad']?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label for="">Direccion</label>
                                <p>
                                    <?php echo $_SESSION['direccion']?>
                                </p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label for="">Cargo</label>
                                <p>
                                    <?php echo $_SESSION['cargo']?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label for="">Sueldo</label>
                                <p>
                                    <?php echo $_SESSION['sueldo']?>
                                </p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label for="">Correo</label>
                                <p>
                                    <?php echo $_SESSION['correo']?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label for="">Termino de contrato</label>
                                <p>
                                    <?php echo $_SESSION['term_con']?>
                                </p>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
                    </div>
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

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>



        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../manager/js/datatables-simple-demo.js"></script>

    </body>

    </html>