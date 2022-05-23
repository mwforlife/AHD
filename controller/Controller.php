<?php
//----Class Required----/
//-----Main Content
include '../model/Usuarios.php';
include '../model/Regiones.php';
include '../model/Comunas.php';
include '../model/Peluquerias.php';
include '../model/Soportes.php';

//------Manager Content
include '../model/Trabajadores.php';
include '../model/Tipo_Trabajador.php';
include '../model/Detalles_Servicios.php';
include '../model/Detalles_trabajadores.php';
include '../model/Horario.php';
include '../model/Mensaje.php';
include '../model/Sexos.php';
include '../model/Telefonos.php';
/*--------Client Content--------------*/
include '../model/Servicios.php';
include '../model/Reserva.php';
//-----Class Definition---//
class Controller{
    //Global Variable
    private $mi;


    //Database Conection Function
    private function conection(){
      $this->mi= new mysqli("156.67.72.1","u475997436_ahd","21Chichi","u475997436_ahd");
      //$this->mi = new mysqli("127.0.0.1", "root", "", "ahd_database");
        if ($this->mi->connect_errno) {
            die("Database Conection Unsuccessfuly");
        }
    }

    //Database Desconection Function

    //Database Desconection Function
    private function desconection(){
        $this->mi->close();
    }

    //Main Functions
    //Department List ----- Listar Regiones
    public function ListarRegiones(){
        $this->conection();
        $sql ="select * from regiones order by id_reg ASC;";
        $lista = array();
        $consulta = $this->mi->query($sql);
        while($rs = mysqli_fetch_array( $consulta)){
          $id = $rs['id_reg'];
           $nom = utf8_encode($rs['nom_reg']);
           $r = new Regiones($id,$nom);
           $lista[] = $r;
        }
        $this->desconection();
        return $lista;
     }

    //City Search --- Buscar Comunas
    public function ListarComunas($cod){
        $this->conection();
        $sql ="select * from comunas where id_reg=$cod order by nom_com ASC;";
        $lista = array();
        $consulta = $this->mi->query($sql);
        while($rs = mysqli_fetch_array( $consulta)){
          $id = $rs['id_com'];
           $nom = utf8_encode($rs['nom_com']);
            $id_reg= $rs['id_reg'];
           $r = new Comunas($id,$nom,$id_reg);
           $lista[] = $r;
        }
        $this->desconection();
        return $lista;
    }

    public function BuscarComuna($cod){
      $this->conection();
      $sql ="select nom_com from comunas where id_com=$cod;";
      $consulta = $this->mi->query($sql);
      if($rs = mysqli_fetch_array( $consulta)){
         $nom = utf8_encode($rs['nom_com']);
         $this->desconection();
         return $nom;
      }
      $this->desconection();
      return null;
  }

    //Client Register --- Registro de Clientes
    public function registrarusuario(Usuarios $u){
        $this->conection();
        $id = $u->getId_usuario();
        $nombre = $u->getNombre();
        $apellido = $u->getApellido();
        $login = $u->getLogin();
        $password = $u->getPassword();
        $edad = $u->getFec_nac();
        $sexo = $u->getSexo();
        $telefono = $u->getTelefono();
       $id_reg = $u->getId_reg();
         $id_com = $u->getId_com();
         $dir = $u->getDireccion();
        $correo = $u->getCorreo();
        $token = $u->getToken();
        $reporte = $u->getReporte();
        $sql = "select count(*) from usuarios where id_usu='".$id."' or log_usu='".$login."' or cor_usu='".$correo."';";
        $consulta = $this->mi->query($sql);
        if($rs = mysqli_fetch_array($consulta)){
           if($rs['count(*)']==1){
              $this->desconection();
              return 6;
           }else{
              $this->desconection();
              $this->conection();
              $sql = "insert into usuarios values ('".$id."','".$nombre."','".$apellido."','".$login."','".$password."','".$edad."','".$sexo."','".$telefono."','".$id_reg."','".$id_com."','".$dir."','".$correo."','".$token."','".$reporte."',now(),null);";
              $consulta = $this->mi->query($sql);
              $this->desconection();
              return json_encode($consulta);
           }
        }    
     }

    //Hairdresser Register --- Registro Peluquerias
    public function registropeluquerias(Peluquerias $p){
        $this->conection();
        $nombre = $p->getNombre();
        $login = $p->getLogin();
        $password = $p->getPassword();
        $representante = $p->getRepresentante();
       $reg = $p->getId_reg();
       $com = $p->getId_com();
        $direccion = $p->getDireccion();
        $correo = $p->getCorreo();
        $sql = "select count(*) from peluquerias where log_pel='".$login."';";
        $consulta = $this->mi->query($sql);
        if($rs = mysqli_fetch_array( $consulta)){
           if($rs['count(*)']==1){
           $this->desconection();
           return 2;
           }else{
              $this->desconection();
              $this->conection();
              $sql = "insert into peluquerias values(null,'".$nombre."','".$login."',sha1('".$password."'),'".$representante."',".$reg.",".$com.",'".$direccion."','".$correo."',now(),1,null);";
              $consulta = $this->mi->query($sql);
              $this->desconection();
              return json_encode($consulta);
           }
        }
        
     }

     /*Function buscar foto*/
     public function buscarPefil($id){
      $this->conection();
      $sql = "select foto from trabajadores where id_tra='$id';";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $foto = $rs['foto'];
         $this->desconection();
         return $foto;
      }
      $this->desconection();
      return null;
     }

      //-----Function comprobar usuario-----//
      public function comprobarusuario($usu, $pas){
         $this->conection();
         $sql = "select count(*) as 'name' from usuarios where log_usu='" .$usu ."' and pas_usu='".$pas."' and reporte>=5;";
         $consulta = $this->mi->query($sql);
         if ($rs = mysqli_fetch_array($consulta)) {
            if ($rs["name"]==1) {
               $this->desconection();
               return "Paso";
            }else{
               $this->desconection();
               return "Dale";
            }
         }
         return "Dale";
      }
      //-------Function Modificar Ultimo Inicio de sesion
      public function modificar_ult_vis($id){
         $this->conection();
         $sql = "update usuarios set created=now() where id_usu='$id'";
         $this->mi->query($sql);
         $this->desconection();
      }
    
    //Client Login ---- Inicio de Sesion Clientes
    public function Login_Usuario($login,$password){
        $res="";
        $this->conection();
        session_start();

        $login = $this->mi->real_escape_string($login);
        $password = $this->mi->real_escape_string($password);

        $sql = "select * from usuarios where log_usu='$login' and pas_usu='$password' and reporte<5";
        $consulta = $this->mi->query($sql);
        if($rs = mysqli_fetch_array( $consulta)){
           $_SESSION['nombre_completo'] = $rs['nom_usu']." ".$rs['ape_usu'];
           $_SESSION['id_usu'] = $rs['id_usu'];
           $_SESSION['cor_usu'] = $rs['cor_usu'];
           $_SESSION['reporte'] = $rs['reporte'];
           $_SESSION['token'] = $rs['token'];
           $res=1;
        }
        $this->desconection();
        if ($res==1) {
           # code...
           $this->modificar_ult_vis($_SESSION['id_usu']);
        }
        return $res;
     }


     //Hairdresser Login ---- Inicio de Sesion Peluquerias
     public function Login_Peluqueria($login,$password){
        $res=0;
        $this->conection();

        $login = $this->mi->real_escape_string($login);
        $password = $this->mi->real_escape_string($password);

        $sql = "select id_pel,nom_pel,cor_pel,log_pel,pas_pel,rep_pel,nom_reg,nom_com,direccion from peluquerias,regiones,comunas where peluquerias.id_pel=regiones.id_reg and peluquerias.id_com=comunas.id_com and log_pel='$login' and pas_pel='$password';";
        $consulta = $this->mi->query($sql);
        if($rs = mysqli_fetch_array( $consulta)){
           session_start();
           $_SESSION['nombre_peluqueria'] = $rs['nom_pel'];
           $_SESSION['correo']=$rs['cor_pel'];
           $_SESSION['nom_usu'] = $rs['log_pel'];
           $_SESSION['user_pel'] = $rs['id_pel'];
           $_SESSION['direccion'] = $rs['direccion'];
            $_SESSION['nom_reg'] = utf8_encode($rs['nom_reg']);
            $_SESSION['nom_com'] = utf8_encode($rs['nom_com']);
            $_SESSION['rep_pel'] = $rs['rep_pel'];
           $res=1;
        }
        $this->desconection();
        return $res;
     }

     //Workers Login --- Inicio de Sesion Trabajadores
     public function Login_Trabajador($login,$password){
        $res=0;
        $this->conection();
        $login = $this->mi->real_escape_string($login);
        $password = $this->mi->real_escape_string($password);

        $sql = "select nub_trabajadores.id_tra,foto as perfil,nom_tra,id_pel,ape_tra,fec_nac,nom_reg,nom_com,direccion,sue_tra,cor_tra,term_con,timestampdiff(year,fec_nac,curdate()) as edad,trabajadores.id_tip, nom_tip from nub_trabajadores, trabajadores,regiones,comunas, tipo_trabajador where nub_trabajadores.id_tra=trabajadores.id_tra and trabajadores.id_reg=regiones.id_reg and trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_com=comunas.id_com and trabajadores.id_tip!=1 and nom_usu='$login' and pas_usu='$password';";
        $consulta = $this->mi->query($sql);
        if($rs = mysqli_fetch_array( $consulta)){
           session_start();
           $_SESSION['nom_tra'] = $rs['nom_tra'] . " ". $rs['ape_tra'];
           $_SESSION['pel_tra'] = $rs['id_pel'];
           $_SESSION['user_tra'] = $rs['id_tra'];
           $_SESSION['direccion'] = $rs['direccion'];
            $_SESSION['nom_reg'] = utf8_encode($rs['nom_reg']);
            $_SESSION['nom_com'] = utf8_encode($rs['nom_com']);
            $_SESSION['cargo_id'] = $rs['id_tip'];
            $_SESSION['cargo'] = $rs['nom_tip'];
            $_SESSION['edad'] = $rs['edad'];
            $_SESSION['sueldo'] = $rs['sue_tra'];
            $_SESSION['correo'] = $rs['cor_tra'];
            $_SESSION['term_con'] = $rs['term_con'];
            $_SESSION['fotito'] = $rs['perfil'];
           $res=1;
        }
        $this->desconection();
        return $res;
     }


     //Receptionist Login --- Inicio de Sesion Recepcionista
     public function Login_Recepcionista($login,$password){
        $res=0;
        $this->conection();
        $login = $this->mi->real_escape_string($login);
        $password = $this->mi->real_escape_string($password);

        $sql = "select nub_trabajadores.id_tra,foto as perfil ,nom_tra,id_pel,ape_tra,fec_nac,nom_reg,nom_com,direccion,sue_tra,cor_tra,term_con,timestampdiff(year,fec_nac,curdate()) as edad,trabajadores.id_tip, nom_tip from nub_trabajadores, trabajadores,regiones,comunas, tipo_trabajador where nub_trabajadores.id_tra=trabajadores.id_tra and trabajadores.id_reg=regiones.id_reg and trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_com=comunas.id_com and trabajadores.id_tip=1 and nom_usu='$login' and pas_usu='$password';";
        $consulta = $this->mi->query($sql);
        if($rs = mysqli_fetch_array( $consulta)){
           session_start();
           $_SESSION['nom_tra'] = $rs['nom_tra'] . " ". $rs['ape_tra'];
           $_SESSION['pel_tra'] = $rs['id_pel'];
           $_SESSION['user_tra'] = $rs['id_tra'];
           $_SESSION['direccion'] = $rs['direccion'];
            $_SESSION['nom_reg'] = utf8_encode($rs['nom_reg']);
            $_SESSION['nom_com'] = utf8_encode($rs['nom_com']);
            $_SESSION['cargo_id'] = $rs['id_tip'];
            $_SESSION['cargo'] = $rs['nom_tip'];
            $_SESSION['term_con'] = $rs['term_con'];
            $_SESSION['fotito'] = $rs['perfil'];
            $_SESSION['edad'] = $rs['edad'];
            $_SESSION['sueldo'] = $rs['sue_tra'];
            $_SESSION['correo'] = $rs['cor_tra'];
           $res=1;
        }
        $this->desconection();
        return $res;
     }

     //------Funcion para registrar Soporte
     public function Message_Support_Register(Soportes $s){
        $res =0;
        $this->conection();

        $nombre =$s->getNombre();
        $correo = $s->getCorreo();
        $telefono = $s->getTelefono();
        $asunto = $s->getAsunto();
        $mensaje = $s->getMensaje();
         $estado = $s->getEstado();
        $sql = "insert into soportes values(null,'".$nombre."','".$correo."','".$telefono."','".$asunto."','".$mensaje."',now(),curdate(),".$estado.");";

        $consulta = $this->mi->query($sql);
        $this->desconection();
        return $consulta;

     }























     /*------------------Manager Catalog------------------- */
     //Listar Trabajadores
     //Listar Trabajadores
     public function listartrabajadores($id1){
      $this->conection();
      $sql = "select nub_trabajadores.id_tra,foto,nom_tra,ape_tra,fec_nac,nom_usu,pas_usu,nom_reg,nom_com,direccion,nom_tip, ini_con, term_con, ult_vis, sue_tra,created from trabajadores,nub_trabajadores,tipo_trabajador,regiones,comunas where trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_tra=nub_trabajadores.id_tra and regiones.id_reg=trabajadores.id_reg and comunas.id_com=trabajadores.id_com and id_pel=".$id1.";";
      if ($id1==1) {
         $sql = "select nub_trabajadores.id_tra,foto,nom_tra,ape_tra,fec_nac,nom_usu,pas_usu,nom_reg,nom_com,direccion,nom_tip, ini_con, term_con,sue_tra,ult_vis, created from trabajadores,nub_trabajadores,tipo_trabajador,regiones,comunas where trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_tra=nub_trabajadores.id_tra and regiones.id_reg=trabajadores.id_reg and comunas.id_com=trabajadores.id_com ;";
      }
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id = $rs['id_tra'];
         $nombre = $rs['nom_tra'];
         $apellido = $rs['ape_tra'];
         $edad = $rs['ini_con'];
         $reg = utf8_encode($rs['nom_reg']);
         $com = utf8_encode($rs['nom_com']);
         $dir = $rs['term_con'];
         $tipo = $rs['nom_tip'];
         $ult_vis = $rs['ult_vis'];
         $created = $rs['sue_tra'];
         $foto = $rs['foto'];
         $tra = new Trabajadores($id, $nombre, $apellido, $edad,$reg,$com,$dir, $tipo,$foto,$ult_vis,$created);
         $lista[] = $tra;
      }
      $this->desconection();
      return $lista;
         
   }


    //--------------------Listar Sucursales---------------//
    public function listarsucursales(){
      $this->conection();
      $sql = "select id_pel, nom_pel,log_pel,pas_pel,rep_pel,nom_reg,nom_com,direccion,cor_pel,ult_vis,estado,created from peluquerias,regiones,comunas where peluquerias.id_com=comunas.id_com and comunas.id_reg=regiones.id_reg and estado=1;";
      if (isset($_SESSION['user_pel'])) {
         $sql = "select id_pel, nom_pel,log_pel,pas_pel,rep_pel,nom_reg,nom_com,direccion,cor_pel,ult_vis,estado,created from peluquerias,regiones,comunas where peluquerias.id_com=comunas.id_com and comunas.id_reg=regiones.id_reg;";
      }
      $consulta = $this->mi->query($sql);
      $lista = array();
      while ($rs = mysqli_fetch_array($consulta)) {
         $id = $rs['id_pel'];
         $nom_pel = $rs['nom_pel'];
         $log_pel= $rs['log_pel'];
         $pas_pel = $rs['pas_pel'];
         $rep_pel = $rs['rep_pel'];
         $nom_reg = utf8_encode($rs['nom_reg']);
         $nom_com = utf8_encode($rs['nom_com']);
         $dir = $rs['direccion'];
         $cor_pel = $rs['cor_pel'];
         $ult_vis = $rs['ult_vis'];
         $estado = $rs['estado'];
         $created = $rs['created'];

         $p = new Peluquerias($id,$nom_pel,$log_pel,$pas_pel,$rep_pel,$nom_reg,$nom_com,$dir,$cor_pel,$ult_vis,$estado,$created);
         $lista[] = $p;    
     }
   $this->desconection();
   return $lista;
   }

   //Funcion Reservas pendientes
   public function reservaspendientes(){
      $this->conection();
      $sql = "select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est and reservas.id_est=1;";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['nom_est'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

    //Funcion Reservas Confirmadas
    public function reservasConfirmadas(){
      $this->conection();
      $sql = "select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est and reservas.id_est=3;";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['nom_est'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

    //Funcion Reservas Mal Hechas
    public function reservasMalHechas(){
      $this->conection();
      $sql = "select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est and reservas.id_est=4;";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['nom_est'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

    //Funcion Reservas Atendidas
    public function reservasatendidas(){
      $this->conection();
      $sql = "select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est  and  reservas.id_est=5;";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['nom_est'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

   //Funcion Reservas pendientes
   public function reservaspendientes1($id){
      $this->conection();
      $sql = "select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est and reservas.id_est=1 and id_pel=$id; ";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['nom_est'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

   //Funcion Reservas Confirmadas1
   public function reservasConfirmadas1($id){
      $this->conection();
      $sql = "select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est and reservas.id_est=3 and id_pel=$id;";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['nom_est'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

   //Funcion Atencion Pendientes
   public function AtencionesPendientes($id){
      $this->conection();
      $sql = "select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est and reservas.id_est=3 and id_pel=$id  and fec_res=curdate();";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['nom_est'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

    //Funcion Reservas Mal Hechas1
    public function reservasMalHechas1($id){
      $this->conection();
      $sql = "select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est and reservas.id_est=4 and id_pel=$id  and fec_res=curdate();";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['nom_est'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

    //Funcion Reservas Atendidas
    public function reservasatendidas1($id){
      $this->conection();
      $sql = "select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est and reservas.id_est=5 and id_pel=$id  and fec_res=curdate();";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['nom_est'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

   //-----------------Listar Cargo----------------------//
   public function listarcargos(){
      $this->conection();
      $sql = "select * from tipo_trabajador";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while ($rs = mysqli_fetch_array($consulta)) {
         $id = $rs['id_tip'];
         $tipo = $rs['nom_tip'];
         $hor = new Tipo_Trabajador($id, $tipo);
         $lista[] = $hor;
      }
      $this->desconection();
      return $lista;

   }

   //--------------Registrar Servicios-----------------//
   function registrarservicio($ser,$pre){
      $this->conection();
      $sql = "insert into servicios values(null,'$ser',$pre);";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      return json_encode($consulta);
   }

   //---------------Listar Servicios--------------------//
   public function listarservicios(){
      $this->conection();
      $sql = "select * from servicios order by nom_ser ASC;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id = $rs['id_ser'];
         $nom = $rs['nom_ser'];
         $precio = $rs['precio'];
         $ser = new Servicios($id,$nom,$precio);
         $lista[] = $ser;
      }
      $this->desconection();
      return $lista;
   }

   //funcion Busqueda de Usuario
   public function BuscarUsuario($id){
      $res="";
      $this->conection();
      $sql = "select * from usuarios where id_usu='$id'";
      $consulta = $this->mi->query($sql);
      $u=null;
      if($rs = mysqli_fetch_array($consulta)){
      $id_usuario = $rs['id_usu'];
      $nombre = $rs['nom_usu'];
      $apellido = $rs['ape_usu'];
      $login = $rs['log_usu'];
      $password = $rs['pas_usu'];
      $edad = $rs['fec_nac'];
      $sexo = $rs['id_sex'];
      $telefono = $rs['tel_usu'];
      $reg=$rs['id_reg'];
      $com=$rs['id_com'];
      $dir=$rs['direccion'];
      $correo = $rs['cor_usu'];
      $reporte = $rs['reporte'];
      $token = $rs['token'];
      $created = $rs['created'];
      $u = new Usuarios($id_usuario, $nombre, $apellido, $login, $password, $edad, $sexo, $telefono,$reg,$com,$dir, $correo,$token,$reporte,$created);
      }
      $this->desconection();
      return $u;
   }

     //Modificar Peluqueria
     public function modificarpeluqueria(Peluquerias $p){
      $this->conection();
      $sql = "update peluquerias set nom_pel='".$p->getNombre()."',log_pel='".$p->getLogin()."', rep_pel='".$p->getRepresentante()."',dir_pel='".$p->getDireccion()."',cor_pel='".$p->getCorreo()."' where id_pel=".$p->getId().";";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      return $consulta;
   }

     /*************Deshabilitar Sucursal********************* */
     public function eliminarsucursal($id){
      /*
      $this->conection();
      $sql = "delete from mensajes where id_pel='".$id."';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      $this->conection();
      $sql = "delete from reservas where id_pel='".$id."';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      $this->conection();
      $sql = "delete from soportes where id_pel='".$id."';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      $this->conection();
      $sql = "delete from nub_trabajadores where id_pel='".$id."';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      */
      $this->conection();
      $sql = "update peluquerias set estado=2 where id_pel='".$id."';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
   }

      /*************Habilitar Sucursal********************* */
      public function Habilitarsucursal($id){
         /*
         $this->conection();
         $sql = "delete from mensajes where id_pel='".$id."';";
         $consulta = $this->mi->query($sql);
         $this->desconection();
         $this->conection();
         $sql = "delete from reservas where id_pel='".$id."';";
         $consulta = $this->mi->query($sql);
         $this->desconection();
         $this->conection();
         $sql = "delete from soportes where id_pel='".$id."';";
         $consulta = $this->mi->query($sql);
         $this->desconection();
         $this->conection();
         $sql = "delete from nub_trabajadores where id_pel='".$id."';";
         $consulta = $this->mi->query($sql);
         $this->desconection();
         */
         $this->conection();
         $sql = "update peluquerias set estado=1 where id_pel='".$id."';";
         $consulta = $this->mi->query($sql);
         $this->desconection();
      }

   //---------------funcion Listado de Usuario
   public function ListarClientes(){
      $this->conection();
      $sql = "select id_usu,nom_usu,ape_usu,log_usu,pas_usu,fec_nac,nom_sex,nom_reg,nom_com, direccion, cor_usu,tel_usu,token,reporte,created from usuarios,sexos,regiones, comunas where usuarios.id_sex=sexos.id_sex and usuarios.id_reg=regiones.id_reg and usuarios.id_com=comunas.id_com order by nom_usu ASC;";
      $consulta = $this->mi->query($sql);
      $u=null;
       $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
      $id_usuario = $rs['id_usu'];
      $nombre = $rs['nom_usu'];
      $apellido = $rs['ape_usu'];
      $login = $rs['log_usu'];
      $password = $rs['pas_usu'];
      $edad = $rs['fec_nac'];
      $sexo = $rs['nom_sex'];
      $telefono = $rs['tel_usu'];
      $region = utf8_encode($rs['nom_reg']);
      $comuna = utf8_encode($rs['nom_com']);
      $direccion = $rs['direccion'];
      $correo = $rs['cor_usu'];
      $token = $rs['token'];
      $reporte = $rs['reporte'];
      $created = $rs['created'];
      $u = new Usuarios($id_usuario, $nombre, $apellido, $login, $password, $edad, $sexo, $telefono,$region,$comuna,$direccion, $correo,$token,$reporte,$created);
      $lista[] = $u;
      }
      $this->desconection();
      return $lista;
   }

   //****************************************************************
   public function registrartrabajadores(Trabajadores $t, Detalles_trabajadores $dt){
      $this->conection();
      $id = $t->getId();
      $nom = $t->getNombre();
      $ape = $t->getApellido();
      $eda = $t->getFecnac();
      $reg = $t->getId_reg();
      $com = $t->getId_com();
      $dir = $t->getDireccion();
      $tip = $t->getTipo();
      $foto = $t->getFoto();
      $ult_vis = $t->getUlt_vis();
      $created = $t->getCreated();
      
      $pel = $dt->getId_peluqueria();
      $usu = $dt->getUsuario();
      $con = $dt->getContrasena();
      $sue = $dt->getSueldo();
      $cor = $dt->getCorreo();
      $tel = $dt->getTelefono();
      $ini_con = $dt->getIni_con();
      $term_con = $dt->getIni_term();
      $sql = "select count(*) from trabajadores where id_tra='".$id."';";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         if ($rs['count(*)']==0) {
            $this->desconection();
            $this->conection();
            $sql = "insert into trabajadores values('".$id."','".$nom."','".$ape."','".$eda."',".$reg.",".$com.",'".$dir."',".$tip.",now(),null,'$foto');";
            $consulta = $this->mi->query($sql);
            $this->desconection();
            $this->conection();
            $sql = "insert into nub_trabajadores values(null,".$pel.",'".$id."','".$usu."',sha1('".$con."'),".$sue.",'".$cor."','".$tel."','".$ini_con."','".$term_con."');";
            $consulta = $this->mi->query($sql);
            $this->desconection();
            return 1;
         }else if($rs['count(*)']==1){
            $this->conection();
            $sql = "select count(*) from nub_trabajadores where id_tra='".$id."';";
            $consulta = $this->mi->query($sql);
            if ($rs = mysqli_fetch_array($consulta)) {
               if ($rs['count(*)']==0) {
                  $this->desconection();
                  $this->conection();
                   $sql = "insert into nub_trabajadores values(null,".$pel.",'".$id."','".$usu."',sha1('".$con."'),".$sue.",'".$cor."','".$tel."','".$ini_con."','".$term_con."');";
                  $consulta = $this->mi->query($sql);
                  $this->desconection();
                  return json_encode($consulta);
               }else if($rs['count(*)']==1){
                  $this->desconection();
                  return 2;
               }
            }
            $this->desconection();
            return 4;
         }
      }
      $this->desconection();
      return 4;
   }

   function listarclientsupport(){
      $this->conection();
      $sql = "select id_sop,nombre,correo,telefono,asunto,mensaje,Date_format(hora,'%H:%i') as hora, fecha,id_est from soportes where id_est=1;";
      $lista = array();
      $consulta = $this->mi->query($sql);
      while($rs = mysqli_fetch_array($consulta)){
         $id = $rs['id_sop'];
         $nombre = $rs['nombre'];
         $correo = $rs['correo'];
         $telefono = $rs['telefono'];
         $asunto = $rs['asunto'];
         $mensaje = $rs['mensaje'];
         $hora = $rs['hora'];
         $fecha = $rs['fecha'];
         $estado = $rs['id_est'];

         $s = new Soportes($id,$nombre,$correo,$telefono,$asunto,$mensaje,$hora,$fecha,$estado);
         $lista[] = $s;
      }
      $this->desconection();
      return $lista;
   }

   function listarclientsupport1($id){
      $this->conection();
      $sql = "select id_sop,nombre,correo,telefono,asunto,mensaje,Date_format(hora,'%H:%i') as hora, fecha,id_est from soportes where id_sop=$id and id_est=1;";
      $consulta = $this->mi->query($sql);
      if($rs = mysqli_fetch_array($consulta)){
         $id = $rs['id_sop'];
         $nombre = $rs['nombre'];
         $correo = $rs['correo'];
         $telefono = $rs['telefono'];
         $asunto = $rs['asunto'];
         $mensaje = $rs['mensaje'];
         $hora = $rs['hora'];
         $fecha = $rs['fecha'];
         $estado = $rs['id_est'];

         $s = new Soportes($id,$nombre,$correo,$telefono,$asunto,$mensaje,$hora,$fecha,$estado);
         return $s;
      }
      $this->desconection();
      return null;
   }

   function SupportClient($id){
      $this->conection();
      $sql = "update soportes set id_est=2 where id_sop=$id";
      $this->mi->query($sql);
      $this->desconection();
   }


















   //Function for Statistics-------------------
   //Funcion para sacar estadisticas
   public function estadisticas(){
      $this->conection();
      $sql = "select servicios.nom_ser, COUNT(reservas.id_res) AS 'cantidad' FROM reservas,servicios where reservas.id_ser = servicios.id_ser  GROUP BY servicios.nom_ser ORDER BY 'cantidad' DESC";
      $lista = array();
      $consulta = $this->mi->query($sql);
      while ($rs = mysqli_fetch_array($consulta)) {
         $can = $rs["cantidad"];
         $nom = $rs["nom_ser"];
         $s = new Sexos($can,$nom);
         $lista[] = $s;
      }
      $this->desconection();
      return $lista;
   }

   //Function para sacar estadisticas
   public function estadisticas1($id){
      $this->conection();
      $sql = "select servicios.nom_ser, COUNT(reservas.id_res) AS 'cantidad' FROM reservas,servicios where reservas.id_ser = servicios.id_ser  and id_pel=$id  GROUP BY servicios.nom_ser ORDER BY 'cantidad' DESC";
      $lista = array();
      $consulta = $this->mi->query($sql);
      while ($rs = mysqli_fetch_array($consulta)) {
         $can = $rs["cantidad"];
         $nom = $rs["nom_ser"];
         $s = new Sexos($can,$nom);
         $lista[] = $s;
      }
      $this->desconection();
      return $lista;
   }

   //Funcion para sacar estadisticas por peluquerias
   public function estadisticas3($id){
      $this->conection();
      $sql = "select distinct Date_format(fec_res,'%d %M %Y') as fecha , count(*) as cantidad from reservas where id_pel=$id group by fec_res ;";
      $lista = array();
      $consulta = $this->mi->query($sql);
      while ($rs = mysqli_fetch_array($consulta)) {
         $can = $rs["cantidad"];
         $nom = $rs["fecha"];
         $s = new Sexos($can,$nom);
         $lista[] = $s;
      }
      $this->desconection();
      return $lista;
   }

   public function estadisticas4(){
      $this->conection();
      $sql = "select distinct Date_format(fec_res,'%d %M %Y') as fecha , count(*) as cantidad from reservas group by fec_res ;";
      $lista = array();
      $consulta = $this->mi->query($sql);
      while ($rs = mysqli_fetch_array($consulta)) {
         $can = $rs["cantidad"];
         $nom = $rs["fecha"];
         $s = new Sexos($can,$nom);
         $lista[] = $s;
      }
      $this->desconection();
      return $lista;
   }

   /*Para sacar cantidad de clientes a atender por peluquero*/
   public function cantidad_clientes_atencion($id){
      $this->conection();
      $sql= "select distinct reservas.id_tra, nom_tra, ape_tra, nom_tip, count(id_res) as cantidad from reservas, trabajadores, tipo_trabajador where reservas.id_tra=trabajadores.id_tra and tipo_trabajador.id_tip=trabajadores.id_tip and reservas.id_est=3 and id_pel=$id group by trabajadores.id_tra;";
      $lista = array();
      $consulta = $this->mi->query($sql);
      while ($rs = mysqli_fetch_array($consulta)) {
         $id = $rs['id_tra'];
         $nombre = $rs['nom_tra']." ".$rs['ape_tra'];
         $tip = $rs['nom_tip'];
         $cant = $rs['cantidad'];
         $det = new Detalles_Servicios($id,$nombre,$tip,$cant);
         $lista[] = $det;
      }
      $this->desconection();
      return $lista;
   }






   //Function For Chat ***** Funcion para mensajeria
   //Catalog Client
   //Function MostrarContenido
    public function showinfo($id,$id1){
      $this->conection();
      $sql = "select id_men,nom_usu,ape_usu,nom_com,text_men,count(*),hora_men,fecha_men from mensajes,usuarios,peluquerias,comunas where mensajes.id_usu=usuarios.id_usu and mensajes.id_pel=peluquerias.id_pel and peluquerias.id_com=comunas.id_com and mensajes.id_usu='$id1' and mensajes.id_pel=$id;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_men = $rs['id_men'];
         $nom_usu = $rs['nom_usu'] . " ".$rs['ape_usu'];
         $com_pel = $rs['nom_com'];
         $texto = $rs['text_men'];
         $cantidad = $rs['count(*)'];
         $hora = $rs['hora_men'];
         $fecha = $rs['fecha_men'];
         $m = new mensaje(1,1,1,$texto,$cantidad,$hora,$fecha);
         $lista[] = $m;
      }
      $this->desconection();
      return $lista;
   }


   public function cant_message($id_usu,$id_pel){
      $this->conection();
      $sql ="select count(*) as cantidad from mensajes where id_pel=$id_pel and id_usu='$id_usu';";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return null;
   }


   public function show_client_message($id_usu,$id_pel){
      $this->conection();
      $sql = "select id_men, datediff(curdate(),fecha_men) as times,id_pel,text_men,id_est,Date_format(hora_men,'%H:%i') as hora,fecha_men from mensajes where id_usu='$id_usu' and id_pel=$id_pel;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while ($rs = mysqli_fetch_array($consulta)) {
         $id_men = $rs["id_men"];
         $time = $rs["times"];
         $pel = $rs["id_pel"];
         $mensaje = $rs["text_men"];
         $estado = $rs["id_est"];
         $hora = $rs["hora"];
         $fecha = $rs["fecha_men"];
         $m = new Mensaje($id_men,$time,$pel,$mensaje,$estado,$hora,$fecha);
         $lista[] = $m;
      }
      $this->desconection();
      return $lista;
   }

   public function send_client_message(Mensaje $men){
      $this->conection();
      $sql = "insert into mensajes values(null,'".$men->getId_usuario()."',".$men->getId_peluqueria().",'".$men->getTexto_mensaje()."',".$men->getId_estado().",now(),curdate())";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      return $consulta;
   }

   public function listarmensaje($id,$id1){
      $this->conection();
      $sql = "select id_men,nom_usu,ape_usu,nom_com,text_men,hora_men,fecha_men from mensajes,usuarios,peluquerias,comunas where mensajes.id_usu=usuarios.id_usu and mensajes.id_pel=peluquerias.id_pel and peluquerias.id_com=comunas.id_com and mensajes.id_usu='$id1' and mensajes.id_pel=$id;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_men = $rs['id_men'];
         $nom_usu = $rs['nom_usu'] . " ".$rs['ape_usu'];
         $com_pel = $rs['nom_com'];
         $texto = $rs['text_men'];
         $cantidad = $rs['id_est'];
         $hora = $rs['hora_men'];
         $fecha = $rs['fecha_men'];
         $m = new mensaje(1,1,1,$texto,$cantidad,$hora,$fecha);
         $lista[] = $m;
      }
      $this->desconection();
      return $lista;
   }



   //Catalago hairdresser
   public function listarusu($id){
      $this->conection();
      $sql = " select distinct(nom_usu) ,ape_usu,mensajes.id_usu from mensajes,usuarios where usuarios.id_usu=mensajes.id_usu and id_pel=$id;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $nom = $rs['nom_usu'];
         $ape = $rs['ape_usu'];
         $id_usu = $rs['id_usu'];
         $u = new Usuarios($id_usu, $nom, $ape,"","",0, 0, "","", 0,0,0,0,0,0);
         $lista[] = $u;
      }
      $this->desconection();
      return $lista;
   }
   
   


























   /*-------------------Client Catalog--------------------------------- */
   //-------------------------------Listar Trabajadores
   public function listarpeluqueros($id1){
      $this->conection();
      $sql = "select nub_trabajadores.id_tra,nom_tra,foto,ape_tra,fec_nac,nom_reg,nom_com,direccion,nom_tip,ini_con,term_con, sue_tra from trabajadores,nub_trabajadores,tipo_trabajador,regiones,comunas where trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_tra=nub_trabajadores.id_tra and trabajadores.id_reg=regiones.id_reg and trabajadores.id_com=comunas.id_com and id_pel=".$id1.";";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id = $rs['id_tra'];
         $nombre = $rs['nom_tra'];
         $apellido = $rs['ape_tra'];
         $edad = $rs['fec_nac'];
          $reg = $rs['nom_reg'];
          $com = $rs['nom_com'];
          $dir = $rs['direccion'];
         $tipo = $rs['nom_tip'];
         $ini_con = $rs['ini_con'];
         $term_con = $rs['term_con'];
         $sue_tra = $rs['sue_tra'];
         $foto = $rs['foto'];
         $tra = new Trabajadores($id, $nombre, $apellido,$edad,$reg,$com,$dir, $tipo,$foto,$ini_con,$term_con);
         $lista[] = $tra;
      }
      $this->desconection();
      return $lista;
         
   }


   //--------------------Listar las reservas de un cliente
   public function listarreserva2($usu){
      $this->conection();
      $sql = "select nom_pel,nom_com, id_res,nom_est,usuarios.nom_usu,nom_ser,hora,fec_res,nom_tra,ape_tra from reservas,usuarios,peluquerias,comunas,servicios,tabla_horario,trabajadores,estado_reservas where usuarios.id_usu=reservas.id_usu and reservas.id_ser=servicios.id_ser and peluquerias.id_pel=reservas.id_pel and reservas.id_ta=tabla_horario.id_ta and trabajadores.id_tra=reservas.id_tra and estado_reservas.id_est=reservas.id_est and comunas.id_com=peluquerias.id_com and fec_res>=curdate() and reservas.id_usu='$usu' and (reservas.id_est=1 or reservas.id_est=2 or reservas.id_est=3) order by reservas.id_est asc;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_reserva = $rs['id_res'];
         $id_servicio = $rs['nom_ser'];
         $id_peluqueria = $rs['nom_pel']." ".$rs['nom_com'];
         $id_estado = $rs['nom_est'];
         $id_usuario = $rs['nom_usu'];
         $hora = $rs['hora'];
         $fecha = $rs['fec_res'];
         $tra = $rs['nom_tra']." ".$rs['ape_tra'];
         $r = new Reserva($id_reserva, $id_peluqueria, $id_estado, $id_servicio, $id_usuario, $hora, $fecha,$tra);
         $lista[] = $r;
      }
      $this->desconection();
      return $lista;
   }

   //-----------------Listar todas las reservas de una fecha
   public function listarreserva3($id,$fecha){
      $this->conection();
      $sql = "select nom_pel, id_res,id_est,nom_usu,nom_ser,reservas.id_ta,hora,fec_res,id_tra from reservas,usuarios,peluquerias,servicios,tabla_horario where usuarios.id_usu=reservas.id_usu and reservas.id_ser=servicios.id_ser and peluquerias.id_pel=reservas.id_pel and reservas.id_ta=tabla_horario.id_ta and reservas.id_pel=$id and fec_res='$fecha'";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_reserva = $rs['id_res'];
         $id_servicio = $rs['nom_ser'];
         $id_peluqueria = $rs['nom_pel'];
         $id_estado = $rs['id_est'];
         $id_usuario = $rs['nom_usu'];
         $hora = $rs['id_ta'];
         $fecha = $rs['fec_res'];
         $tra = $rs['id_tra'];
         $r = new Reserva($id_reserva, $id_peluqueria, $id_estado, $id_servicio, $id_usuario, $hora, $fecha,$tra);
         $lista[] = $r;
      }
      $this->desconection();
      return $lista;
   }

   //-----------------Listar todas las reservas de hoy
   public function listarreserva4($id){
      $this->conection();
      $sql = "select nom_pel, id_res,nom_est,reservas.id_usu,nom_usu,ape_usu,nom_ser,reservas.id_ta,hora,fec_res,id_tra from reservas,usuarios,peluquerias,servicios,tabla_horario,estado_reservas where estado_reservas.id_est=reservas.id_est and usuarios.id_usu=reservas.id_usu and reservas.id_ser=servicios.id_ser and peluquerias.id_pel=reservas.id_pel and reservas.id_ta=tabla_horario.id_ta and reservas.id_pel=$id and reservas.id_est=1 and fec_res>=curdate();";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_reserva = $rs['id_res'];
         $id_servicio = $rs['nom_ser'];
         $id_peluqueria = $rs['nom_usu']." ".$rs['ape_usu'];
         $id_estado = $rs['nom_est'];
         $id_usuario = $rs['id_usu'];
         $hora = $rs['hora'];
         $fecha = $rs['fec_res'];
         $tra = $rs['id_tra'];
         $r = new Reserva($id_reserva, $id_peluqueria, $id_estado, $id_servicio, $id_usuario, $hora, $fecha,$tra);
         $lista[] = $r;
      }
      $this->desconection();
      return $lista;
   }

   //-----------------Listar todas las reservas de hoy
   public function listarreserva9($id){
      $this->conection();
      $sql = "select nom_pel, id_res,nom_est,reservas.id_usu,nom_usu,ape_usu,nom_ser,reservas.id_ta,hora,fec_res,id_tra from reservas,usuarios,peluquerias,servicios,tabla_horario,estado_reservas where estado_reservas.id_est=reservas.id_est and usuarios.id_usu=reservas.id_usu and reservas.id_ser=servicios.id_ser and peluquerias.id_pel=reservas.id_pel and reservas.id_ta=tabla_horario.id_ta and reservas.id_pel=$id and reservas.id_est=3 and fec_res>=curdate() ;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_reserva = $rs['id_res'];
         $id_servicio = $rs['nom_ser'];
         $id_peluqueria = $rs['nom_usu']." ".$rs['ape_usu'];
         $id_estado = $rs['nom_est'];
         $id_usuario = $rs['id_usu'];
         $hora = $rs['hora'];
         $fecha = $rs['fec_res'];
         $tra = $rs['id_tra'];
         $r = new Reserva($id_reserva, $id_peluqueria, $id_estado, $id_servicio, $id_usuario, $hora, $fecha,$tra);
         $lista[] = $r;
      }
      $this->desconection();
      return $lista;
   }
   //-----------------Listar todas las reservas de hoy
   public function listarreserva5(){
      $this->conection();
      $sql = "select nom_pel, id_res,nom_est,reservas.id_usu,nom_usu,ape_usu,nom_ser,reservas.id_ta,hora,fec_res,nom_pel from reservas,usuarios,peluquerias,servicios,tabla_horario,estado_reservas where estado_reservas.id_est=reservas.id_est and usuarios.id_usu=reservas.id_usu and reservas.id_ser=servicios.id_ser and peluquerias.id_pel=reservas.id_pel and reservas.id_ta=tabla_horario.id_ta  and reservas.id_est!=4 and reservas.id_est!=5 and fec_res>=curdate() order by fec_res desc ;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_reserva = $rs['id_res'];
         $id_servicio = $rs['nom_ser'];
         $id_peluqueria = $rs['nom_usu']." ".$rs['ape_usu'];
         $id_estado = $rs['nom_est'];
         $id_usuario = $rs['id_usu'];
         $hora = $rs['hora'];
         $fecha = $rs['fec_res'];
         $tra = $rs['nom_pel'];
         $r = new Reserva($id_reserva, $id_peluqueria, $id_estado, $id_servicio, $id_usuario, $hora, $fecha,$tra);
         $lista[] = $r;
      }
      $this->desconection();
      return $lista;
   }

   public function listarreserva6(){
      $this->conection();
      $sql = "select nom_pel, id_res,nom_est,reservas.id_usu,nom_usu,ape_usu,nom_ser,reservas.id_ta,hora,fec_res,nom_pel from reservas,usuarios,peluquerias,servicios,tabla_horario,estado_reservas where estado_reservas.id_est=reservas.id_est and usuarios.id_usu=reservas.id_usu and reservas.id_ser=servicios.id_ser and peluquerias.id_pel=reservas.id_pel and reservas.id_ta=tabla_horario.id_ta  and reservas.id_est=4 ;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_reserva = $rs['id_res'];
         $id_servicio = $rs['nom_ser'];
         $id_peluqueria = $rs['nom_usu']." ".$rs['ape_usu'];
         $id_estado = $rs['nom_est'];
         $id_usuario = $rs['id_usu'];
         $hora = $rs['hora'];
         $fecha = $rs['fec_res'];
         $tra = $rs['nom_pel'];
         $r = new Reserva($id_reserva, $id_peluqueria, $id_estado, $id_servicio, $id_usuario, $hora, $fecha,$tra);
         $lista[] = $r;
      }
      $this->desconection();
      return $lista;
   }

   public function listarreserva7(){
      $this->conection();
      $sql = "select nom_pel, id_res,nom_est,reservas.id_usu,nom_usu,ape_usu,nom_ser,reservas.id_ta,hora,fec_res,nom_pel from reservas,usuarios,peluquerias,servicios,tabla_horario,estado_reservas where estado_reservas.id_est=reservas.id_est and usuarios.id_usu=reservas.id_usu and reservas.id_ser=servicios.id_ser and peluquerias.id_pel=reservas.id_pel and reservas.id_ta=tabla_horario.id_ta  and reservas.id_est=3 and fec_res=curdate() ;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_reserva = $rs['id_res'];
         $id_servicio = $rs['nom_ser'];
         $id_peluqueria = $rs['nom_usu']." ".$rs['ape_usu'];
         $id_estado = $rs['nom_est'];
         $id_usuario = $rs['id_usu'];
         $hora = $rs['hora'];
         $fecha = $rs['fec_res'];
         $tra = $rs['nom_pel'];
         $r = new Reserva($id_reserva, $id_peluqueria, $id_estado, $id_servicio, $id_usuario, $hora, $fecha,$tra);
         $lista[] = $r;
      }
      $this->desconection();
      return $lista;
   }


   //-------------------------Listar Horas
   public function listarhoras(){
      $this->conection();
      $sql = "select * from tabla_horario";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while ($rs = mysqli_fetch_array($consulta)) {
         $id1 = $rs['id_ta'];
         $hora = $rs['hora'];
         $hor = new Sexos($id1,$hora);
         $lista[] = $hor;
      }
      $this->desconection();
      return $lista;

   }

   public function ingresosmensuales(){
      $this->conection();
      $sql = "select distinct Date_format(fec_res,'%M %Y') as mes, sum(precio) as cantidad from reservas,servicios where reservas.id_ser=servicios.id_ser group by Date_format(fec_res,'%M %Y') ;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while ($rs = mysqli_fetch_array($consulta)) {
         $id1 = $rs['cantidad'];
         $hora = $rs['mes'];
         $hor = new Sexos($id1,$hora);
         $lista[] = $hor;
      }
      $this->desconection();
      return $lista;
   }
     
      //Modificar Contraseña
      public function modificarcontrasena($pas,$usu){
         $this->conection();
         $sql = "update usuarios set pas_usu=sha1('$pas') where id_usu='$usu'";
         $consulta = $this->mi->query($sql);
         $this->desconection();
     }

     /*------------Eliminar Cuenta----------------------- */
     public function eliminarcuenta($id){
      $this->conection();
      $sql = "delete from mensajes where id_usu='".$id."';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      $this->conection();
      $sql = "delete from reservas where id_usu='".$id."';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      $this->conection();
      $sql = "delete from soportes where id_usu='".$id."';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      $this->conection();
      $sql = "delete from usuarios where id_usu='".$id."';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
   }

    //Function registrareserva
    public function registrarreserva(Reserva $re){
      $this->conection();
      $id_reserva =0;
      $id_usuario = $re->getId_usuario();
      $id_peluqueria = $re->getId_peluqueria();
      $id_estado = 1;
      $id_servicio = $re->getId_servicio();
      $hora = $re->getHora();
      $fecha = $re->getFecha();
      $trabajador = $re->getTrabajador();
      $sql = "select count(*) from reservas where id_ta='$hora' and fec_res='$fecha'";
      $consulta = $this->mi->query($sql);
      if($rs = mysqli_fetch_array($consulta)){
         if($rs['count(*)']==1){
         $this->desconection();
         return "Error";
         }else{
         $this->desconection();
         $this->conection();
         $sql = "insert into reservas values(null,'$id_peluqueria','$id_estado','$id_servicio','$id_usuario','$hora','$fecha','$trabajador');";
         $consulta = $this->mi->query($sql);
         $this->desconection();
         return $consulta;
         }
      }
   }

   function validateaccount($token){
      $this->conection();
      $sql = "update usuarios set reporte=1 where token='$token'";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      session_start();
      $_SESSION['reporte'] =1;
   }

      function modificarcorreo($id,$correo,$token){
         $this->conection();
         $sql = "update usuarios set cor_usu='$correo', token='$token' where id_usu='$id'";
         $consulta = $this->mi->query($sql);
         $this->desconection();
         session_start();
         $_SESSION['cor_usu'] =$correo;
         $_SESSION['token'] = $token;
   }

   function eliminarreserva($id){
      $this->conection();
      $sql = "update reservas set id_est=4 where id_res=$id;";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      return json_encode($consulta);
   }

 

         
   /*Recepcionist Catalog */
   function ConfirmarReserva($id){
            $this->conection();
            $sql = "update reservas set id_est=3 where id_res=$id";
            $consulta = $this->mi->query($sql);
            $this->desconection();
            return json_encode($consulta);
         
   }

     /*Recepcionist Catalog */
     function Eliminartrabajador($id){
      $this->conection();
      $sql = "delete from nub_trabajadores where id_tra='$id';";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      return json_encode($consulta);
   
}

   /*Recepcionist Catalog */
   function AtencionCliente($id){
      $this->conection();
      $sql = "update reservas set id_est=5 where id_res=$id";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      return json_encode($consulta);
   
}

   /*Recepcionist Catalog */
   function CancelarReserva($id){
      $this->conection();
      $sql = "update reservas set id_est=2 where id_res=$id";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      return json_encode($consulta);
   
   }
   /*Recepcionist Catalog */
   function CancelarHoraCliente($id){
      $this->conection();
      $sql = "update reservas set id_est=4 where id_res=$id";
      $consulta = $this->mi->query($sql);
      $this->desconection();
      return json_encode($consulta);
   
   }
   
   
   //-------Workers Catalog--------------------
   function atencionMesactual($id_tra){
      $this->conection();
      $sql = "select distinct Date_format(fec_res,'%M %Y') as mes, count(*) as cantidad from reservas where Date_format(fec_res,'%M %Y')=Date_format(curdate(),'%M %Y') and id_est=5 and id_tra='$id_tra' group by fec_res  ;";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['mes'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

   function atencionAnoactual($id_tra){
      $this->conection();
      $sql = "select distinct Date_format(fec_res,'%Y') as mes, count(*) as cantidad from reservas where Date_format(fec_res,'%Y')=Date_format(curdate(),'%Y') and id_est=5 and id_tra='$id_tra'  group by fec_res ;";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['mes'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

   function atencioDiaActual($id_tra){
      $this->conection();
      $sql = "select distinct fec_res as fecha, count(*) as cantidad from reservas where fec_res=curdate() and id_est=5 and id_tra='$id_tra' group by fec_res ;";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $nom_est = $rs['fecha'];
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }

   function PendientesTrabajador($id_tra){
      $this->conection();
      $sql = "select count(*) as cantidad from reservas where id_est=1 and id_tra='$id_tra' and fec_res>=curdate();";
      $consulta = $this->mi->query($sql);
      if ($rs = mysqli_fetch_array($consulta)) {
         $cantidad = $rs['cantidad'];
         $this->desconection();
         return $cantidad;
      }
      $this->desconection();
      return "error";
   }


//buscar trabajadores por fecha
   public function listartrabajadores1($id1,$fecha,$fecha1){
      $this->conection();
      $sql = "select nub_trabajadores.id_tra,foto,nom_tra,ape_tra,fec_nac,nom_usu,pas_usu,nom_reg,nom_com,direccion,nom_tip, ini_con, term_con, ult_vis, sue_tra,created from trabajadores,nub_trabajadores,tipo_trabajador,regiones,comunas where trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_tra=nub_trabajadores.id_tra and regiones.id_reg=trabajadores.id_reg and comunas.id_com=trabajadores.id_com and ini_con>='$fecha' and term_con<='$fecha1' and id_pel=".$id1.";";
      if ($id1==1) {
         $sql = "select nub_trabajadores.id_tra,foto,nom_tra,ape_tra,fec_nac,nom_usu,pas_usu,nom_reg,nom_com,direccion,nom_tip, ini_con, term_con,sue_tra,ult_vis, created from trabajadores,nub_trabajadores,tipo_trabajador,regiones,comunas where trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_tra=nub_trabajadores.id_tra and regiones.id_reg=trabajadores.id_reg and comunas.id_com=trabajadores.id_com and  ini_con>='$fecha' and term_con<='$fecha1';";
      }
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id = $rs['id_tra'];
         $nombre = $rs['nom_tra'];
         $apellido = $rs['ape_tra'];
         $edad = $rs['ini_con'];
         $reg = $rs['nom_reg'];
         $com = $rs['nom_com'];
         $dir = $rs['term_con'];
         $tipo = $rs['nom_tip'];
         $ult_vis = $rs['ult_vis'];
         $created = $rs['sue_tra'];
         $foto = $rs['foto'];
         $tra = new Trabajadores($id, $nombre, $apellido, $edad,$reg,$com,$dir, $tipo,$foto,$ult_vis,$created);
         $lista[] = $tra;
      }
      $this->desconection();
      return $lista;
         
   }

   public function ingresosmensuales1($fecha1,$fecha2){
      $this->conection();
      $sql = "select distinct Date_format(fec_res,'%M %Y') as mes, sum(precio) as cantidad from reservas,servicios where reservas.id_ser=servicios.id_ser and fec_res between '$fecha1' and '$fecha2' group by Date_format(fec_res,'%M %Y') ;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while ($rs = mysqli_fetch_array($consulta)) {
         $id1 = $rs['cantidad'];
         $hora = $rs['mes'];
         $hor = new Sexos($id1,$hora);
         $lista[] = $hor;
      }
      $this->desconection();
      return $lista;
   }

   //-----------------Listar todas las reservas por rango de fecha
   public function listarreserva10($fecha1,$fecha2){
      $this->conection();
      $sql = "select nom_pel, id_res,nom_est,reservas.id_usu,nom_usu,ape_usu,nom_ser,reservas.id_ta,hora,fec_res,nom_pel from reservas,usuarios,peluquerias,servicios,tabla_horario,estado_reservas where estado_reservas.id_est=reservas.id_est and usuarios.id_usu=reservas.id_usu and reservas.id_ser=servicios.id_ser and peluquerias.id_pel=reservas.id_pel and reservas.id_ta=tabla_horario.id_ta  and reservas.id_est!=4 and reservas.id_est!=5 and fec_res between '$fecha1' and '$fecha2' order by fec_res desc ;";
      $consulta = $this->mi->query($sql);
      $lista = array();
      while($rs = mysqli_fetch_array($consulta)){
         $id_reserva = $rs['id_res'];
         $id_servicio = $rs['nom_ser'];
         $id_peluqueria = $rs['nom_usu']." ".$rs['ape_usu'];
         $id_estado = $rs['nom_est'];
         $id_usuario = $rs['id_usu'];
         $hora = $rs['hora'];
         $fecha = $rs['fec_res'];
         $tra = $rs['nom_pel'];
         $r = new Reserva($id_reserva, $id_peluqueria, $id_estado, $id_servicio, $id_usuario, $hora, $fecha,$tra);
         $lista[] = $r;
      }
      $this->desconection();
      return $lista;
   }




}
