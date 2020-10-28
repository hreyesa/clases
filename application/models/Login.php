<?php

class Login extends CI_Model{

 public function __construct() 
  {
  
      $this->load->database();
      //$this->db_valida = $this->load->database("conexion_b", true);
     $this->load->library('session');
  }
    
  

  public function valida_usuario($usuario){
    $query = "select * from usuario where usuario='".$usuario."'";
    
    $query=$this->db->query($query);
    if($query->num_rows() >0)
    {
      foreach ($query->result() as $fila) 
      {
        $data[] = $fila;
      }
      return $data[0];
    }
    else
    {
      return false;
    } 
  }

  public function valida_correo($correo){
    $query = "select * from usuario where correo_usuario='".$correo."'";
    
    $query=$this->db->query($query);
    if($query->num_rows() >0)
    {
      foreach ($query->result() as $fila) 
      {
        $data[] = $fila;
      }
      return $data[0];
    }
    else
    {
      return false;
    } 
  }

  public function valida_rut($rut){
    $query = "select * from usuario where rut_usuario='".$rut."'";
    
    $query=$this->db->query($query);
    if($query->num_rows() >0)
    {
      foreach ($query->result() as $fila) 
      {
        $data[] = $fila;
      }
      return $data[0];
    }
    else
    {
      return false;
    } 
  }


  public function valida_cuenta($usuario,$correo,$rut){
    $query = "select * from usuario where rut_usuario='".$rut."' and correo_usuario='".$correo."' and usuario='".$usuario."'";
    
    $query=$this->db->query($query);
    if($query->num_rows() >0)
    {
      foreach ($query->result() as $fila) 
      {
        $data[] = $fila;
      }
      return $data[0];
    }
    else
    {
      return false;
    } 
  }


  public function guardar_usuario($usuario, $correo, $contrasena, $rut, $direccion)
  {

    $query = "select max(id_usuario) id_usuario from usuario";
    $query=$this->db->query($query);

      $id_usuario = 1;
    if($query->num_rows() >0)
    {
      foreach ($query->result() as $fila) {
        $data[] = $fila;
    }

    $id_usuario = $data[0]->id_usuario + 1;
    }

    $clave_cifrada = password_hash($contrasena, PASSWORD_DEFAULT, array("cost"=>15));

      $query = 'insert into usuario values( "'.$id_usuario.'","'.$usuario.'", "'.$correo.'" ,"'.$clave_cifrada.'","1", "1","'.$rut.'","'.$direccion.'");';
      $query=$this->db->query($query);


  }


  public function token_recuperar($usuario,$rut,$token)
  {

    $query = "select * from usuario where usuario='".$usuario."'";
    $query=$this->db->query($query);

      
    if($query->num_rows() >0)
    {
      foreach ($query->result() as $fila) {
        $data[] = $fila;
    }

    $id_usuario = $data[0]->id_usuario;
    }

    
      $query = 'update usuario set token_usuario = "'.$token.'" where id_usuario = "'.$id_usuario.'";';
      $query=$this->db->query($query);


  }
 

  public function cambiarContrasena($token,$contrasena)
  {
      
      if($token != 1){     

    $query = "select id_usuario from usuario where token_usuario ='".$token."'";
    $query=$this->db->query($query);

      
    if($query->num_rows() >0)
    {
      foreach ($query->result() as $fila) {
        $data[] = $fila;
    }

    $id_usuario = $data[0]->id_usuario;
    $clave_cifrada = password_hash($contrasena, PASSWORD_DEFAULT, array("cost"=>15));


    $query = 'update usuario set token_usuario = 1, contrasena = "'.$clave_cifrada.'" where id_usuario = "'.$id_usuario.'";';
    $query=$this->db->query($query);
    return true;

    }

    else{
      return false;
    } 
  } else {

      return false;

  }
    
  }


}

?>