             <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	
	function __construct() {
        parent::__construct();        
		$this->load->model('Login');    
		$this->load->library('session');  
        $this->load->library(array('session', 'form_validation'));
    }

	public function index()
	{
		$this->load->view('usuario');

	}




	public function login()
	{
		
		        //llamo al metodo add
        		$add=$this->Login->valida_usuario(
                $this->input->post("usuario")
                             );

				$contrasena=$this->input->post("contrasena");
			

		//$resultado = $this->Login->valida_usuario($correo, $contrasena);


		if($add!=false)
		{


			if(password_verify($contrasena,$add->contrasena) ){

				$sesion = array('id_usuario'=>$add->id_usuario);
				$this->session->set_userdata($sesion);
				$this->session->set_userdata($contrasena);

				$id_usuario = $add->id_usuario;

							
			
		 		$this->load->view('home');
		

	


					}
			else{
				echo json_encode(false)."  Contraseña incorrecto";}
	
		}
		else{
			echo json_encode(false)." Usuario no esta registrado";		
		

		

	}	
}

	public function registro()
	{
		$this->load->view('registro');
	}

	public function registrar_usuario()
	{
		$usuario = $this->input->post("usuario");
		$correo = $this->input->post("correo");
		$rut = $this->input->post("rut");
		$direccion = $this->input->post("direccion");
		$contrasena = $this->input->post("contrasena");


		$objUsuario = $this->Login->valida_usuario($usuario);
		$objCorreo = $this->Login->valida_correo($correo);
		$objRut = $this->Login->valida_rut($rut);

		if(!$objUsuario && !$objCorreo && !$objRut) //false
		{
			$this->Login->guardar_usuario($usuario, $correo, $contrasena,$rut, $direccion);
			//echo json_encode(true);
			$this->load->view('index');
		}
		else
		{
			echo json_encode('El usuario, correo o RUT ya existe');
		}
		
	}


	public function recuperar_contrasena()
	{

		require('Mailin.php');
		$usuario = $this->input->post("usuario");
		$rut = $this->input->post("rut");
		$correo = $this->input->post("correo");
		$asunto = 'Recuperar contraseña';
		
		//$objUsuario = $this->Login->valida_usuario($usuario);
		//$objRut = $this->Login->valida_rut($rut);
		//$objCorreo = $this->Login->valida_correo($correo);
		$objCuenta = $this->Login->valida_cuenta($usuario,$correo,$rut);

		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        for ($i = 0; $i < 20; $i++) {
            $token .= $characters[rand(0, strlen($characters))];
        }
				
		if(!$objCuenta) //false
		{
			echo json_encode('RUT o correo no corresponden al usuario ingresado');

		}
		else
		{

			$this->Login->token_recuperar($usuario,$rut,$token);
			//echo json_encode(true);
			//enviar correo electronico

			$mensaje = 'El codigo para cambiar contraseña es:   '. $token;
			
			$mailin = new Mailin('hreyes.albornoz@gmail.com', '7HqtjN1QGKZ6OwJv');
			$mailin->
			addTo($correo, $usuario)->
			setFrom('noreply@caracolab.cl', 'Caracol-lab')->
			setReplyTo('noreply@caracolab.cl', 'Caracol-lab')->
			setSubject($asunto)->
			setText($mensaje)->
			setHtml('<head><title>'.$asunto.'</title></head>'.
			  '<body> <p>Nombre contacto: '.$usuario.
			  '</p><p> Correo Electronico solicitante: '.$correo.
			  '</p><p> Mensaje: '.$mensaje.
			  '</P> </body>');
			$res = $mailin->send();	
	
			/*
			El mensaje de éxito será enviado de esta forma:
			{'result' => true, 'message' => 'E-mail enviado'}
			*/


			$this->load->view('cambiarContrasena');

	
			
		}
		
	}


	public function cambiar_contrasena()
	{
		$token = $this->input->post("token");
		$contrasena = $this->input->post("contrasena");

			$result = $this->Login->cambiarContrasena($token, $contrasena);
			//echo json_encode(true);
			if (!$result){
				echo json_encode('Token no es valido');


			}else {
				$this->load->view('index');
			}


			

	}






}
