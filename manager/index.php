<?php
session_start();
if(!isset($_SESSION['user_pel'])){
    header("Location: ../Process/gateway.php");
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
    <link rel="icon" type="image/x-icon" href="../img/logo/icono.png" />
    <meta name="author" content="Wilkens Mompoint - Bastian Riquelme - Francisco Orellana" />
    <title>Nuevo style - <?php echo  $_SESSION['rep_pel'] ?></title>
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.mask.js"></script>
    
    <!-------DATATABLES--------
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />


    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="../js/Process/manager.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    




</head>

<body onload="manageronload()" class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">
            <img src="../img/logo/logo.png" width="125">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                   
                    <li><a class="dropdown-item" href="../Process/close.php">Cerrar Sesion</a></li>
                </ul>
            </li>
        </ul>
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
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Soporte
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <?php
                                if ($_SESSION['user_pel']==1) {
                                    echo "
                                    <a class='nav-link' href='soporte.php'>Soporte</a>";
                                }else{
                                    echo "<a class='nav-link' href='chat.php' >Chat</a>";
                                }
                                ?>    
                            
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Funciones
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Registros
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#service_register" data-bs-whatever="@mdo">Registro de Servicios</a>
                                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#reg-trabajadores" data-bs-whatever="@mdo">Registro de Trabajadores</a>
                                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal-sucursal" data-bs-whatever="@mdo">Registro de Sucursal</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Complementos</div>
                        <a class="nav-link" target="_blank" href="reportes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Reporte
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
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Estadisticas</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <p>Reservas Confimadas<br/>
                                    <?php
                                    $c = new controller();
                                    
                                    if ($_SESSION['user_pel']==1) {
                                        $res = $c->reservasConfirmadas();
                                        echo $res;
                                    }else{
                                        $res = $c->reservasConfirmadas1($_SESSION['user_pel']);
                                        echo $res;
                                    }
                                    ?>
                                    </p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Ver Detalles</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <p>Reservas Pendientes<br/>
                                    <?php
                                    $c = new controller();
                                    
                                    if ($_SESSION['user_pel']==1) {
                                        $res = $c->reservaspendientes();
                                        echo $res;
                                    }else{
                                        $res = $c->reservaspendientes1($_SESSION['user_pel']);
                                        echo $res;
                                    }
                                    ?>
                                    </p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Ver Detalles</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <p>Numeros de Atenciones<br/>
                                    <?php
                                    $c = new controller();
                                    
                                    if ($_SESSION['user_pel']==1) {
                                        $res = $c->reservasatendidas();
                                        echo $res;
                                    }else{
                                        $res = $c->reservasatendidas1($_SESSION['user_pel']);
                                        echo $res;
                                    }
                                    ?>
                                    </p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Ver Detalles</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <p>Reservas Mal Hechas<br/>
                                    <?php
                                    $c = new controller();
                                    
                                    if ($_SESSION['user_pel']==1) {
                                        $res = $c->reservasMalHechas();
                                        echo $res;
                                    }else{
                                        $res = $c->reservasMalHechas1($_SESSION['user_pel']);
                                        echo $res;
                                    }
                                    ?>
                                    </p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Ver Detalles</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i> Cantidad de solicitudes por servivios
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i> Cantidad de reservas por fecha
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Listado de Trabajadores
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="display table table-striped">
                                <thead>
                                    <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                        <th>Inicio Contrato</th>
                                        <th>Termino contrato</th>
                                        <th>Salario</th>
                                        <th>Perfil</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                        <th>Inicio Contrato</th>
                                        <th>Termino contrato</th>
                                        <th>Salario</th>
                                        <th>Perfil</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody >
                                <?php
                                     $id = $_SESSION['user_pel'];

                                    $lista = $c->listartrabajadores($id);

                                    if($lista==null){
                                        echo "<tr><td colspan='7' class='text-center'>No hay trabajadores registrados</td></tr>";
                                    }else{
                                        for ($i=0; $i <count($lista) ; $i++) { 
                                        $t = $lista[$i];
                                        echo "<tr>";
                                        echo "<td>".$t->getId()."</td>";
                                        echo "<td>".$t->getNombre()." ".$t->getApellido()."</td>";
                                        echo "<td>".$t->getTipo()."</td>";
                                        echo "<td>".$t->getFecnac()."</td>";
                                        echo "<td>".$t->getDireccion()."</td>";
                                        echo "<td>".$t->getCreated()."</td>";
                                        echo "<td><img class='profile_picture' src='../img/image_server/workers_profile/".$t->getFoto()."'</td>";
                                        echo "<td style='text-align:center;'><button style='border: none; background:none;' onclick='eliminartrabajador(\"".$t->getId()."\")'><img src='../img/iconos/uncheck.svg' height='30' width='30'></button>";
                                        echo "</tr>";
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Listado de Clientes
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple1" class="display table table-striped">
                                <thead>
                                    <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Sexo</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Sexo</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                    </tr>
                                </tfoot>
                                <tbody >
                                    <?php
                                     $lista = $c->ListarClientes();

                                    if (is_null($lista)) {
                                        echo "<tr><td>No hay clientes Registrados</td></tr>";	
                                    }else{
                                    for ($i=0; $i <count($lista) ; $i++) { 
                                        $u = $lista[$i];
                                        echo "<tr>";
                                        echo "<td>".$u->getId_usuario()."</td>";
                                        echo "<td>".$u->getNombre()."</td>";
                                        echo "<td>".$u->getApellido()."</td>";
                                        echo "<td>".$u->getFec_nac()."</td>";
                                        echo "<td>".$u->getSexo()."</td>";
                                        echo "<td>".$u->getTelefono()."</td>";
                                        echo "<td>".$u->getCorreo()."</td>";
                                    echo "</tr>";
                                    }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-------------------------Start Sucursales----------------------------->
                    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-file-image-0 me-1"></i> Listado de Sucursales
                            </div>
                            <div class="card-body sucursales">  
                                        <h2>Sucursales</h2>
                                        <div id="accordion">
                                            
                                        </div>
                            </div>
                    </div>
                                    <!------------------------------------------------------->
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






<!-------------------Modal de registro de Sucursal---------------------->
<!-- Modal -->
<div class="modal fade" id="modal-sucursal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Sucursal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <form id="sed-regis" name="sed-regis">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <label for="">Nombre de Usuario:</label>
                                        <input type="text" class="form-control" id="usupel" name="usupel" required="">
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <label for="">Representante:</label>
                                        <input type="text" class="form-control" id="reppel" name="reppel" required="">
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12 col-lg-6 ">
                                            <label>Region:</label><br />
                                            <select autocomplete="on" class="form-control region" name="region" id="region" required onchange="searchcomuna()">
                                            <option value="0" disabled>Seleccione una region</option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-12 col-lg-6 com">
                                            <label>Comuna:</label><br />
                                            <select autocomplete="on" class="form-control comuna" name="comuna">
                                            <option value="0">Seleccione una Comuna</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="">Direccion:</label>
                                        <input type="text" class="form-control" id="dirpel" name="dirpel" required="">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                
                                    <button type="reset" class="btn btn-danger">Restablecer</button>
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </div>
                </form>
      </div>
    </div>
  </div>
</div>

<!---------------Modal Registro trabajadores-------------------->
<div class="modal fade " id="reg-trabajadores" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-md-6" id="staticBackdropLabel">AHD - Registro de Trabajadores</h5>
                    <button type="button" class="close btn-lg btn" aria-label="Close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body justify-content-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-11 form-signin">
                                <form id="tra-regis" name="tra-regis" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6">
                                            <label>Tipo de indentificacion:</label><br />
                                            <select class="form-control" id="tip_id" onchange="tipo_id()">
                                                <option value="1">Rut Chileno</option>
                                                <option value="2">Otros</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-lg-6">
                                            <label>Indentificador:</label><br />
                                            <input class="rut form-control" type="text" name="txt_ind" id="txt_ind" placeholder="Rut: 11.111.111-1 / 11111111-1" />
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Nombre:</label>
                                        <input type="text" class="form-control" id="nomtra" name="nomtra" required="">
                                    </div>
                                    <div class="col">
                                        <label for="">Apellido:</label>
                                        <input type="text" class="form-control" id="apetra" name="apetra" required="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Fecha de nacimiento:</label>
                                        <input type="date" class="form-control" id="edatra" name="edatra"  required="">
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12 col-lg-6 ">
                                            <label>Region:</label><br />
                                            <select autocomplete="on" class="form-control region" name="region" id="region2" required onchange="searchcomuna2()">
                                            <option value="0" disabled>Seleccione una region</option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-12 col-lg-6 com">
                                            <label>Comuna:</label><br />
                                            <select autocomplete="on" class="form-control comuna2" id="comuna2" name="comuna">
                                            <option value="0">Seleccione una Comuna</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Direccion:</label>
                                        <input type="text" class="form-control" id="dirtra" name="dirtra" required="">
                                    </div>
                                    <div class="col">
                                        <label for="">Correo:</label>
                                        <input type="email" class="form-control" id="cortra" name="cortra" required="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Telefono:</label>
                                        <input type="number" class="form-control" id="teltra" name="teltra" min="911111111" maxlength="9" max="999999999" required="">
                                    </div>
                                </div>
                                 <?php
                                if ($_SESSION['user_pel']==1) {
                                    echo "<div class='row'>";
                                    echo "<div class='col-md-12 col-lg-12 com'>";
                                    echo "<label>Peluqueria:</label><br />";
                                    echo "<select autocomplete='on' class='form-control peluqueria' name='peluqueria' id='peluqueria2'>";
                                    echo "<option value='0'>Seleccione Peluqueria</option>
                                            </select>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                ?> 
                                <div class="row">
                                        <div class="col-md-12 col-lg-6 com">
                                            <label>Cargo:</label><br />
                                            <select autocomplete="on" class="form-control cargo" name="cargo" id="cargo">
                                            <option value="0">Seleccione Cargo</option>
                                            </select>
                                        </div>
                                    <div class="col-md-12 col-lg-6">
                                        <label for="">Sueldo:</label>
                                        <input type="number" class="form-control" id="suetra" name="suetra" min="325000" required="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Foto de Perfil</label>
                                        <input accept="image/png,image/jpeg,image/jpg" type="file" class="form-control" name="foto" id="foto" size="20" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <label for="">Inicio Contrato</label>
                                        <input type="date" id="ini-con" name="ini-con" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <label for="">Termino Contrato</label>
                                        <input type="date" id="term-con" name="term-con" class="form-control" required>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-danger">Restablecer</button>
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

    <div class="modal fade" id="service_register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Servicios</h5>
                    <button type="button" class="close btn-lg btn" aria-label="Close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="">Servicio:</label>
                                <input type="text" name="txtser" id="txtser" class="form-control" placeholder="Ingrese el nombre del servicio">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="">Precio:</label>
                                    <input type="number" name="txtpre" id="txtpre" class="form-control" placeholder="Ingrese el precio">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="reset" data-dismiss="modal">Restablecer</button>
                        <button class="btn btn-success" type="button" onclick="registrarservicio()">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!--<script src="assets/demo/chart-area-demo.js"></script>-->
    <!--<script src="assets/demo/chart-bar-demo.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js">
    </script>





<!------Line Chart---------->
<script>
            //PHP Function
            //Funcion para Extraer los datos desde la base de datos
            <?php
                //Definiendo Variables
                $cadena = array();
                $valores= array();
                $lista = array();

                //Extraendo Informacion desde la Base de datos
                if ($id==1) {
                    $lista = $c->estadisticas();
                }else{
                    $lista = $c->estadisticas1($id);
                }

                //Extraendo datos dentro de la lista
                //Creando los Subarray
                for ($i=0; $i < count($lista); $i++) { 
                    $s = $lista[$i];
                    $cadena[] = $s->getNombre();
                    $valores[] = $s->getId();
                }
            ?>
            //JSFunctions
                //Creando las Variables para extraer los Array desde PHP
                var Cadena = <?php echo json_encode($cadena);?>;
                var Valores = <?php echo json_encode($valores);?>;


            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Area Chart Example
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: Cadena,//["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10", "Mar 11", "Mar 12", "Mar 13"],
                datasets: [{
                label: "Cantidad",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: Valores,//[10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651, 31984, 38451],
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'number_format'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 30,
                    minTickLimit:1,
                    maxTicksLimit: 30
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, 0.125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });

</script>
<!------------------------->




<!------------BarChart----------------->
<script>

    <?php
    //Recuperando listado de peluquerias
    $lista = $c->listarsucursales();

    //Creando las variables
    $cadena = array();
    $valores = array();

    for ($i=0; $i < count($lista); $i++) { 
        //Sacar peluqueria dentro del array para buscar su valor
    $p = $lista[$i];
    if($p->getId()!=1){
        //Buscar cantidad de reservas
        $lista = $c->estadisticas3($p->getId());    
    }else{
        $lista = $c->estadisticas4();
    }
    //Extraendo datos dentro de la lista
    //Creando los Subarray
    for ($i=0; $i < count($lista); $i++) { 
        $s = $lista[$i];
        $cadena[] = $s->getNombre();
        $valores[] = $s->getId();
    }
    }

    ?>

        //Recuperando valores desde PHP<
        var Cadena = <?php echo json_encode($cadena);?>;    
        var Valores = <?php echo json_encode($valores);?>;


    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: Cadena,//["January", "February", "March", "April", "May", "June"],
        datasets: [{
        label: "Cantidad",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: Valores,//[4215, 5312, 6251, 7841, 9821, 14984],
        }],
    },
    options: {
        scales: {
        xAxes: [{
            time: {
            unit: 'number_format'
            },
            gridLines: {
            display: false
            },
            ticks: {
            }
        }],
        yAxes: [{
            ticks: {
            min: 0,
            max: 30,
            maxTicksLimit: 30
            },
            gridLines: {
            display: true
            }
        }],
        },
        legend: {
        display: false
        }
    }
    });
</script>
<!--------------------------->






</body>

</html>