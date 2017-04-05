<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Persona_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*
	  Funcion login
	  Descripcion: Funcion que permite consultar los datos de un usuario y una contraseña, los cuales fueron ingresados por el usuario en el login y se espera que estos datos se validen para verificar su existencia en la base de datos
	*/	
	function login($data){
		$this->db->where('email', $data['usuario']);
		$this->db->where('salt_password', $data['clave']);
		$datos = $this->db->get('clientes');
		if($datos->num_rows() > 0) return $datos;
		else return false;
	} 

	/*
	  Funcion consultar persona
	  Descripcion: Funcion que permite consultar los datos de un usuario usando como parametro el email
	*/	
	function consultarPersona($email){
		$this->db->where('email', $email);
		$datos = $this->db->get('clientes');
		if($datos->num_rows() > 0) return $datos;
		else return false;
	}
	
	
}