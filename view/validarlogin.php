<?php
session_start();
$val =0;
if(isset($_SESSION['user_pel'])){
    $val=1;
}else if(isset($_SESSION['id_usu'])){
    $val=1;
}else if(isset($_SESSION['user_tra']) && isset($_SESSION['cargo_id'])){
    if ($_SESSION['cargo_id']==1) {
        $val=1;
    }else{
        $val=1;
    }
}
else{
    $val=0;
    
}
echo $val;  