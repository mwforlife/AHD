<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registrar Trabajadores - Nuevo Style</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.mask.js"></script>
    <script src="../js/Process/manager.js"></script>
</head>

<body onload="manageronload()" class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Registrar Trabajador</h3>
                                </div>
                                <div class="card-body">
                                    <form>
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
                                            <div class="col-md-12 col-lg-6">
                                                <label for="">Nombre:</label>
                                                <input type="text" class="form-control" id="nomtra" name="nomtra" required="">
                                            </div>
                                            <div class="col-md-12 col-lg-6">
                                                <label for="">Apellido:</label>
                                                <input type="text" class="form-control" id="apetra" name="apetra" required="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="">Fecha de Nacimiento:</label>
                                                <input type="date" class="form-control" id="edatra" name="edatra" min="18" required="">
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
                                            <div class="col col-md-12 col-lg-6">
                                                <label for="">Direccion:</label>
                                                <input type="text" class="form-control" id="dirtra" name="dirtra" required="">
                                            </div>
                                            <div class="col col-md-12 col-lg-6">
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
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted text-center">Copyright &copy; AHD Haidresser- Nuevo Style 2021</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>