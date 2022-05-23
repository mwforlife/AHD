<?php
session_start();
if(!isset($_SESSION['user_pel'])){
    header("Location: ../Process/gateway.php");
}

include '../controller/Controller.php';
$id_pel = $_SESSION['user_pel'];

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
    <title>Reportes - Nuevo Style</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html"><img src="../img/logo/logo.png" width="125"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">principal</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Principal
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
                    <h1 class="mt-4">Reportes</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Principal</a></li>
                        <li class="breadcrumb-item active">Reportes</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            En esta seccion se podrá generar reporte, imprimiendo los documentos solicitados en formato PDF.
                        </div>
                    </div>

                    <?php
                        if ($_SESSION['user_pel']==1) {
                        echo "<div class='card mb-4'>";
                        echo "<div class='card-body'>";
                        echo "<div class='row'>";
                        echo "<div class='col'>";
                        echo "<a class='btn btn-secondary' href='../report/atenciones_por_dias.php' target='_blank'>Cantidad de atenciones por diás</a>";
                        echo "</div>";
                        echo "<div class='col'>";
                        echo "<a class='btn btn-success' href='../report/ingresosmensuales.php' target='_blank'>Ingresos Mensuales</a>";
                        echo "</div>";
                        echo "<div class='col'>";
                        echo "<a href='../report/reservas_mal_hechas.php' class='btn btn-warning' target='_blank'>Listado de reservas mal hechas </a>";
                        echo "</div>";
                        echo "<div class='col'>";
                        echo "<a href='../report/atenciones_hoy.php' target='_blank' class='btn btn-danger'>Listado de atencion de hoy</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        }
                    ?>

<?php
                        if ($_SESSION['user_pel']==1) {
                        echo "<h4>Reporte por Rango de Fecha</h4>";
                        echo "<div class='card mb-4'>";
                        echo "<div class='card-body'>";
                        echo "<div class='row jus'>";
                        echo "<div class='col'>";
                        echo "<a class='btn btn-secondary' href='#' data-bs-toggle='modal' data-bs-target='#report_workers' data-bs-whatever='@mdo' >Trabajadores</a>";
                        echo "<a class='btn btn-success' href='#' data-bs-toggle='modal' data-bs-target='#report_reserve' data-bs-whatever='@mdo' >Reservas</a>";
                        echo "<a class='btn btn-warning' href='#' data-bs-toggle='modal' data-bs-target='#report_ing' data-bs-whatever='@mdo' >Ingresos </a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        }
                    ?>

                    <div class="card mb-4">

                        <div class="col-md-1">
                            <a href="../report/listado_trabajadores.php" target="_blank" class="btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Exportar</a>
                        </div>

                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Listado de Trabajadores
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                        <th>Inicio Contrato</th>
                                        <th>Termino contrato</th>
                                        <th>Salario</th>
                                        <th>Perfil</th>
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
                                    </tr>
                                </tfoot>
                                <tbody>
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
                                        echo "</tr>";
                                        }
                                    }
                                ?>
                        </tbody>
                        </table>
                </div>
        </div>

        <div class="card mb-4">

            <div class="col-md-1">
                <a href="../report/listado_clientes.php" target="_blank" class="btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Exportar</a>
            </div>

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
                    <tbody>
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

        <div class="card mb-4">

            <div class="col-md-1">
                <a href="../report/listado_reservas.php" target="_blank" class="btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Exportar</a>
            </div>

            <div class="card-header">
                <i class="fas fa-table me-1"></i> Listado de Reservas
            </div>
            <div class="card-body">
                <table id="datatablesSimple2" class="display table table-striped">
                    <thead>
                        <tr>
                            <th>Identificador</th>
                            <th>Nombre</th>
                            <th>Servicio</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            
                                            <?php
                                            if($_SESSION['user_pel']==1){
                                                echo "<th>Sucursal</th>";
                                            }
                                            ?>
                                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $lista = $c->listarreserva5();
    
                                    for ($i=0; $i <count($lista) ; $i++) { 
                                        $res = $lista[$i];
                                        echo "<tr>";
                                        echo "<td>".$res->getId_usuario()."</td>";
                                        echo "<td>".$res->getId_peluqueria()."</td>";
                                        echo "<td>".$res->getId_servicio()."</td>";
                                        echo "<td>".$res->getFecha()."</td>";
                                        echo "<td>".$res->getHora()."</td>";
                                        echo "<td>".$res->getId_estado()."</td>";
                                        if($_SESSION['user_pel']==1){
                                                echo "<td>".$res->getTrabajador()."</td>";
                                            }
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
                            <?php
                                            if($_SESSION['user_pel']==1){
                                                echo "<th>Sucursal</th>";
                                            }
                                            ?>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-success shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50" onclick="ExportasPDF()"></i> Exportar</button>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i> Cantidad de solicitudes por servivios
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-success shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50" onclick="ExportasPDF1()"></i> Exportar</button>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i> Cantidad de reservas por Sucursal
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
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
                    <a target="_blank" href="../terminos.html">Policitica de Privacidad &middot; Terminos &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
    </div>
    </div>


    <div class="modal fade" id="report_workers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rango de fecha:</h5>
                    <button type="button" class="close btn-lg btn" aria-label="Close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../report/workers_date.php" method="POST" target="_blank">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="">Fecha Inicio:</label>
                                <input type="date" name="dateini" class="form-control" required >
                            </div>

                            
                                <div class="col-md-5">
                                    <label for="">Fecha Termino:</label>
                                    <input type="date" name="dateterm" class="form-control" required>
                                </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="reset" data-dismiss="modal">Restablecer</button>
                        <button class="btn btn-success" type="submit" onclick="registrarservicio()">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="report_reserve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar rango</h5>
                    <button type="button" class="close btn-lg btn" aria-label="Close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../report/reserve_date.php" method="POST" target="_blank">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="">Fecha Inicio:</label>
                                <input type="date" name="dateini" class="form-control" required >
                            </div>

                            
                                <div class="col-md-5">
                                    <label for="">Fecha Termino:</label>
                                    <input type="date" name="dateterm" class="form-control" required>
                                </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="reset" data-dismiss="modal">Restablecer</button>
                        <button class="btn btn-success" type="submit" >Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="report_ing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar rango</h5>
                    <button type="button" class="close btn-lg btn" aria-label="Close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../report/ingresos_date.php" method="POST" target="_blank">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="">Fecha Inicio:</label>
                                <input type="date" name="dateini" class="form-control" required >
                            </div>

                            
                                <div class="col-md-5">
                                    <label for="">Fecha Termino:</label>
                                    <input type="date" name="dateterm" class="form-control" required>
                                </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="reset" data-dismiss="modal">Restablecer</button>
                        <button class="btn btn-success" type="submit" >Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="../js/Process/report.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>





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
                labels: Cadena, //["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10", "Mar 11", "Mar 12", "Mar 13"],
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
                    data: Valores, //[10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651, 31984, 38451],
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
                        ticks: {}
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 30,
                            minTickLimit: 1,
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
                labels: Cadena, //["January", "February", "March", "April", "May", "June"],
                datasets: [{
                    label: "Cantidad",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: Valores, //[4215, 5312, 6251, 7841, 9821, 14984],
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
                        ticks: {}
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