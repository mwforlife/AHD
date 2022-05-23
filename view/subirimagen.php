<?php  
if (isset($_FILES["foto"]) && isset($_POST['id']) ) {
      //Recuperando datos de la imagen
      $nombre_imagen = $_FILES['foto']['name'];
      $tipo_imagen = $_FILES['foto']['type'];
      $tamanio_imagen = $_FILES['foto']['size'];
  
      //Ruta de destino para guardar imagen en el servidor
      $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/img/image_server/workers_profile/';
  
      //Guardar la imagen en la carpeta de destino
      move_uploaded_file($_FILES['foto']['tmp_name'],$carpeta_destino.$nombre_imagen);
  
      echo $nombre_imagen;
}