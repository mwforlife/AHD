<?php
include '../controller/Controller.php';

$c = new Controller();

$id = $_POST['id'];

$s = $c->listarclientsupport1($id);

if ($s==null) {
    
}else{ 
        if ($s->getEstado()==1) {
            echo "<div class='d-flex justify-content-start mb-4'>";
            echo "<div class='img_cont_msg'>";
            echo "<img src='../img/iconos/soporte.png' class='rounded-circle user_img_msg'>";
            echo "</div>";
            echo "<div class='msg_cotainer'>";
            echo $s->getMensaje();
            echo "<span class='msg_time'>".$s->getHora().", ".$s->getFecha()."</span>";
                
            
            echo "</div>";
            echo "</div>";
        }elseif ($s->getEstado()==2) {
            
        
    
?>

<div class="d-flex justify-content-end mb-4">
    <div class="msg_cotainer_send">
        <?php
        echo $s->getMensaje();
        ?>
        <span class="msg_time_send">
        <?php
            echo $s->getHora().", ". $s->getFecha();
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

