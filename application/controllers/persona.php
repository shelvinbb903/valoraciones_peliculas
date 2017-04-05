<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* 
	*/
	class Persona extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			
		}
		/*
		  Servicio de mostrar login
		  Descripcion: Servicio que permite visualizar la pagina de login
		*/
		function index(){
			$data = [
				"titulo" => "Inicio de Sesión"
			];		
			$this->load->view('header', $data);					
			$this->load->view('clientes/login');
			$this->load->view('footer');
		}

		/*
		  Servicio home
		  Descripcion: Servicio que permite visualizar la pagina home, la cual se muestra despues de que el usuario inicia sesion. En ella se listan las peliculas a calificar
		*/
		function home(){			
			$data = [
				"titulo" => "Peliculas"
			];		
			$this->load->view('header', $data);					
			$this->load->view('home');
			$this->load->view('footer');
		}

		/***************************************************************/
		/*
		  Servicio a consumir login
		  Descripcion: Servicio que permite consultar el model los datos del usuario tomando como parametros el email y la contraseña.
		*/
		function login(){
			$this->load->model('persona_model');
			$array = array(
				'usuario' => $_POST["usuario"], 
				'clave' => base64_encode($_POST["password"]));

			$data = $this->persona_model->login($array);

			//Si el usuario existe se guarda el email como dato en la session. Este datos se usa para el CRUD con las calificaciones
			if($data != null){
				$datos_usuario = $data->result()[0];
				$this->session->set_userdata('EmailClienteValoracion', $datos_usuario->email);			
				echo json_encode($data->result()[0]);

			}else{
				echo "[]";
			}
		}

		/*
		  Servicio a consumir logut
		  Descripcion: Servicio que permite borrar datos de la sesion y redireccionar al login
		*/
		function logut(){
		 	$this->session->unset_userdata("EmailClienteValoracion");
		 	echo "<script>window.location.href = '" . base_url() . "'</script>";
		}

		/*
		  Servicio a consumir listar Peliculas
		  Descripcion: Servicio que permite listar todas las peliculas. Pero en este servicio se consulta las calificaciones que ha relizado el usuario a las peliculas, el numero de personas que han calificado las peliculas y los promedios de calificaciones.
		*/
		function serviceListarPeliculas(){
			$this->load->model('peliculas_model');
			$data = $this->peliculas_model->listar();
			if($data != null){				
				foreach ($data->result() as $value) {
					$dataCalificacionUsuario = $this->peliculas_model->obtenerValoraciones($_POST["usuario"], $value->id);

					if($dataCalificacionUsuario != null){
						$value->valoraciones = $dataCalificacionUsuario->result();
					}else{
						$value->valoraciones = [];
					}

					$dataCalificaciones = $this->peliculas_model->obtenerValoracionesGeneral($value->id);
					$datos_calificaciones = $dataCalificaciones->result()[0];

					if($datos_calificaciones->Personas != 0){
						
						$value->numero_personas = $datos_calificaciones->Personas;
						$value->promedio = $datos_calificaciones->Promedio;
					}else{
						$value->numero_personas = "0";
						$value->promedio = "0";
					}

				}
				echo json_encode($data->result());
			}else{
				echo "[]";
			}
		}

		/*
		  Servicio a consumir crear valoracion
		  Descripcion: Servicio que permite crear una valoracion de un usuario a una pelicula. Ademas se guarda como log en un archivo de texto los datos de la valoracion generada. El archivo log generado es logValoraciones.txt y se guarda dentro de la carpeta principal del proyecto
		*/
		function serviceCreaValoracion(){
			$this->load->model('peliculas_model');
			$this->load->model('persona_model');
			$this->load->library('kLogger');
			$array = array(
				'cliente' => $_POST["usuario_login"],
				'pelicula' => $_POST["pelicula"],
				'valor' => $_POST["valor"]
			);
			$this->peliculas_model->crearValoracion($array);

			$dataUsuario = $this->persona_model->consultarPersona($_POST["usuario_login"]);
			$dataPelicula = $this->peliculas_model->consultarPelicula($_POST["pelicula"]);

			if($dataUsuario != null && $dataPelicula != null){
				$log = new KLogger ( "logValoraciones.txt" , KLogger::DEBUG );

				// Print out some information
				$log->LogInfo("Valoracion Registrada con datos Usuario: " . $dataUsuario->result()[0]->nombres . " " . $dataUsuario->result()[0]->apellidos . " Pelicula: ". $dataPelicula->result()[0]->titulo . " Valor: ". $_POST["valor"]);
			}

			
		}

		/*
		  Servicio a consumir editar valoracion
		  Descripcion: Servicio que permite editar una valoracion de un usuario a una pelicula. 
		*/
		function serviceEditarValoracion(){
			$this->load->model('peliculas_model');
			$array = array(
				'cliente' => $_REQUEST["usuario_login"],
				'pelicula' => $_REQUEST["pelicula"],
				'valor' => $_REQUEST["valor"],
				'id' => $_REQUEST["idValoracion"]
			);
			$this->peliculas_model->editarValoracion($array);
		}

		/*
		  Servicio a consumir borrar valoracion
		  Descripcion: Servicio que permite borrar una valoracion de un usuario a una pelicula. 
		*/
		function serviceBorrarValoracion(){
			$this->load->model('peliculas_model');			
			$this->peliculas_model->eliminar($_POST["usuario_login"], $_POST["idValoracion"]);
		}
		
		
	}
?>