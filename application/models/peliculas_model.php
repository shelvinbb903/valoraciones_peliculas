<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Peliculas_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*
	  Funcion crear valoracion
	  Descripcion: Funcion que permite crear una valoracion de una pelicula en la base de datos. Se crea un array asociativo para pasarlo como parametro al insert
	*/
	function crearValoracion($data){
		$array = array(
			'email_cliente' => $data['cliente'],
			'id_pelicula' => $data['pelicula'],
			'valor' => $data['valor']);		
		$this->db->set('fecha', 'CURDATE()', FALSE);
        $this->db->set('hora', 'curTime()', FALSE);
        $this->db->insert('valoraciones', $array);
	}

	/*
	  Funcion consultar pelicula
	  Descripcion: Funcion que permite consultar los datos de una pelicula. Se usa el id como parametro para hacer la busqueda
	*/
	function consultarPelicula($id){
		$this->db->where('id', $id);
		$datos = $this->db->get('peliculas');
		if($datos->num_rows() > 0) return $datos;
		else return false;
	}

	/*
	  Funcion editar valoracion
	  Descripcion: Funcion que permite modificar una valoracion hecha a una pelicula por un usuario
	*/
	function editarValoracion($data){
		$datos = array(
			'email_cliente' => $data['cliente'],
			'id_pelicula' => $data['pelicula'],
			'valor' => $data['valor']);		
		$this->db->where('id', $data['id']);
		$this->db->update('valoraciones', $datos);
	}

	/*
	  Funcion listar
	  Descripcion: Funcion que permite listar todas las peliculas registradas en la base de datos
	*/	
	function listar(){	
		$this->db->select('peliculas.*');
        $this->db->from('peliculas');	
		$datos = $this->db->get();
		if($datos->num_rows() > 0) return $datos;
		else return false;
	}

	/*
	  Funcion Obtener valoracion
	  Descripcion: Funcion que permite consultar los datos de una valoracion hecha por el usuario a una pelicula.
	*/
	function obtenerValoraciones($cliente, $pelicula){	
		$this->db->select('valoraciones.*');
        $this->db->from('valoraciones');	
		$this->db->where('email_cliente', $cliente);
		$this->db->where('id_pelicula', $pelicula);
		$datos = $this->db->get();
		if($datos->num_rows() > 0) return $datos;
		else return false;
	}

	/*
	  Funcion Obtener valoraciones generales
	  Descripcion: Funcion que permite consultar las estadisticas de una pelicula, es decir el numero de personas que la han calificado y su promedio de calificacion
	*/
	function obtenerValoracionesGeneral($pelicula){	
		$this->db->select('COUNT(*) AS Personas, avg(valoraciones.valor) AS Promedio');
        $this->db->from('valoraciones');	
		$this->db->where('id_pelicula', $pelicula);
		$datos = $this->db->get();
		if($datos->num_rows() > 0) return $datos;
		else return false;
	}

	/*
	  Funcion eliminar
	  Descripcion: Funcion que permite borrar una calificacion hecha por un usuario a una pelicula 
	*/
	function eliminar($cliente, $id){
		$this->db->where('email_cliente', $cliente);
		$this->db->where('id', $id);
		$this->db->delete('valoraciones');
	}
}