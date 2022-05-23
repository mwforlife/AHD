<?php
include '../controller/Controller.php';

$c = new Controller();

session_start();
$id_usu=null;
$id_pel=null;

if (isset($_POST['id'])) {
//Id del Usuario
$id_usu = $_POST['id'];
//Id de la sucursal
$id_pel = $_SESSION['user_pel'];

$_SESSION['men_is_usu'] = $id_usu;
$_SESSION['men_is_pel'] = $id_pel;

}elseif (isset($_SESSION['men_is_usu'])  && isset($_SESSION['men_is_pel'])) {
    $id_pel = $_SESSION['men_is_pel'];
    $id_usu = $_SESSION['men_is_usu'];
}else{
    header("Location: ../manager");
    exit;
}


$lista = $c->show_client_message($id_usu,$id_pel);
if ($lista==null) {
    # code...
}else{
    for ($i=0; $i < count($lista); $i++) { 
        $m = $lista[$i];
        if ($m->getId_estado()==1) {
            echo "<div class='d-flex justify-content-start mb-4'>";
            echo "<div class='img_cont_msg'>";
            echo "<img src='../img/iconos/soporte.png' class='rounded-circle user_img_msg'>";
            echo "</div>";
            echo "<div class='msg_cotainer'>";
            echo $m->getTexto_mensaje();
                if ($m->getId_usuario()==0) {
                    echo "<span class='msg_time'>".$m->getHora().", Hoy</span>";
                }elseif ($m->getId_usuario()==1) {
                    echo "<span class='msg_time'>".$m->getHora().", ayer</span>";
                }elseif ($m->getId_usuario()>1) {
                    echo "<span class='msg_time'>".$m->getHora().", ".$m->getFecha()."</span>";
                }
            
            echo "</div>";
            echo "</div>";
        }elseif ($m->getId_estado()==2) {
            
        
    
?>

<div class="d-flex justify-content-end mb-4">
    <div class="msg_cotainer_send">
        <?php
        echo $m->getTexto_mensaje();
        ?>
        <span class="msg_time_send">
        <?php
         if ($m->getId_usuario()==0) {
            echo $m->getHora().", Hoy";
        }elseif ($m->getId_usuario()==1) {
            echo $m->getHora().", ayer";
        }elseif ($m->getId_usuario()>1) {
            echo $m->getHora().", ". $m->getFecha();
        }
        ?>    
        </span>
        </div>
        <div class="img_cont_msg">
        <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
        </div>
</div>
<?php
        }
    }

}
?>