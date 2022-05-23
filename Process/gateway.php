<?php
session_start();
if(isset($_SESSION['user_pel'])){
    header("Location: ../manager");
}else if(isset($_SESSION['id_usu'])){
    header("Location: ../client");
}else if(isset($_SESSION['user_tra']) && isset($_SESSION['cargo_id'])){
    if ($_SESSION['cargo_id']==1) {
    header("Location: ../Recepcionist");   
    }else{
    header("Location: ../workers");
    }
}
else{
    
    header("Location: ../index.html");
}

