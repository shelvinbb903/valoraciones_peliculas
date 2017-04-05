<?php
	if(empty($this->session->userdata('EmailClienteValoracion'))){
		header('Location: ' . base_url());
	}
?>
<!--
	Vista Home de Clientes
	Descripcion: Se muestra como pagina principal home para lustar todas las peliculas con sus datos y valoraciones
-->
<style type="text/css">
	.labelValoracion{
		width: 40px; 
		text-align: center;
	}
	.panel-body > div{
		width: 100%;
	}
	.panel-title button{
		margin-left: 10px;
	}
	input{
		cursor: pointer;
	}
</style>
<div id="container">
	<p class="header"><a href="/Valoraciones/index.php/persona/logut">Cerrar Sesión</a></p>
	<h1><?= $titulo;?></h1>

	
	<div id="body">
		<div class="container">
			<form class="cmxform" id="frmListado" method="post" action="">
				<div class="panel-group" id="accordion">
					<label class="labelValoracion"><input type="radio" name="optradio" class="form-control">1</label>
					<label class="labelValoracion"><input type="radio" name="optradio" class="form-control">1</label>
					<label class="labelValoracion"><input type="radio" name="optradio" class="form-control">1</label>
				</div>
			</form>
		</div>
		
	</div>

	<p class="footer">Prueba Valoraciones de Peliculas</p>
</div>

<script type="text/javascript">	
	 
	(function() {
		//Se visualizan todas las peliculas al momento de cargar la pagina
		listarPeliculas()		
	})();

	/*
	  Script de listar Peliculas
	  Descripcion: Funcion que permite listar todas las peliculas junto con la valoración realizada por el usuario anteriormente. Si el usuario no ha calificado una pelicula, esta no saldra con valoracion personal y el boton BORRAR no es visible. El boton BORRAR solo se usa para borrar un valoracion que ha hecho un usuario a una pelicula
	*/
	function listarPeliculas(){
		$.post("/Valoraciones/index.php/persona/serviceListarPeliculas", {usuario: "<?= $this->session->userdata('EmailClienteValoracion');?>"})
        .done(function(result){

    		$("#accordion").html("")
          	if($.trim(result) != "[]"){
	            var json = JSON.parse(result);
	            for (var i = 0; i < json.length; i++) {	

	            	//Sirve para que el primer collapse este abierto y los demas cerrados
	            	var estado = "";
	            	if(i == 0){
	            		estado = "in"
	            	}else{
	            		estado = "out"
	            	}

	            	//Comienza a agregar en la pantalla los collapse con los datos de las peliculas, calificaciones del usuario y las estadisticas generales de las peliculas
	            	$("#accordion").append('<div class="panel panel-default">' +
				      '<div class="panel-heading">' +
				        '<h4 class="panel-title">' +
				          	'<a data-toggle="collapse" data-parent="#accordion" href="#collapse' + i + '">' + json[i].titulo + '</a>' +
				          	'<div>' + 
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="1" idpelicula="' + json[i].id + '">1</label>' + 
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="2" idpelicula="' + json[i].id + '">2</label>' +
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="3" idpelicula="' + json[i].id + '">3</label>' +
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="4" idpelicula="' + json[i].id + '">4</label>' +
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="5" idpelicula="' + json[i].id + '">5</label>' +
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="6" idpelicula="' + json[i].id + '">6</label>' +
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="7" idpelicula="' + json[i].id + '">7</label>' +
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="8" idpelicula="' + json[i].id + '">8</label>' +
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="9" idpelicula="' + json[i].id + '">9</label>' +
						  		'<label class="labelValoracion"><input type="radio" name="optradioValoracion' + json[i].id + '" class="form-control" value="10" idpelicula="' + json[i].id + '">10</label>' +
						  		'<button type="button" class="btn btn-danger" id="btnBorrar' + i + '' + json[i].id + '" idvaloracion="">BORRAR</button>' + 
							'</div>'+ 
				        '</h4>' +
				      '</div>' +
				      '<div id="collapse' + i + '" class="panel-collapse collapse ' + estado + '">' +
				        '<div class="panel-body">' +	
							json[i].descripcion + '<br><br>' + 					        	
							'<b>Personas que calificaron esta pelicula: </b>' + json[i].numero_personas + '<br>' + 
							'<b>Promedio: </b>' + json[i].promedio + 
			        	'</div>' +
				      '</div>' +
				    '</div>')

	            	//Validar si se debe mostrar o no el boton de borrar calificacion con respecto a la existencia de calificacion del usuario en la pelicula iterada
				    if(json[i].valoraciones.length > 0){
				    	$("#btnBorrar" + i + "" + json[i].id).css({"visibility":"visible"})
				    }else{
				    	$("#btnBorrar" + i + "" + json[i].id).css({"visibility":"hidden"})
				    }

				    //Si el usuario hizo calificacion a la pelicula iterada se selecciona su valor.
				    for (var j = 0; j < json[i].valoraciones.length; j++) {
				    	$('input[name=optradioValoracion' + json[i].valoraciones[j].id_pelicula + '][value=' + json[i].valoraciones[j].valor + ']').attr('checked', true); 
				    	$("#btnBorrar" + i + "" + json[i].id).attr("idvaloracion", json[i].valoraciones[j].id)
				    }	 

				    //Evento de borrar una calificacion
				    $("#btnBorrar" + i + "" + json[i].id).click(function(e){
				    	var confirmar = window.confirm("¿Desea borrar esta calificación?")
				    	if(confirmar){
				    		$.post("/Valoraciones/index.php/persona/serviceBorrarValoracion", {
					        	usuario_login: "<?= $this->session->userdata('EmailClienteValoracion');?>",
					        	idValoracion: $(this).attr("idvaloracion")
					        })
	    					.done(function(dato){
	    						//Durante la respuesta que genera el servicio usado se usa la funcion listarPeliculas() para actualizar las peliculas y las calificaciones que ha hecho el usuario
	    						listarPeliculas()		
	    					});
				    	}
				    })           	

				    //Evento de crear y/o modificar una calificacion
				    $("input[name=optradioValoracion" + i + "]").click(function (e) { 
				    	var idvaloracion = $(this).parent().parent().find("button")[0].attributes.idvaloracion.value

				    	//Si hay una calificacion hecha por el usuario se hace una peticion al servicio para hacer update en la base de datos
				        if($.trim(idvaloracion).length > 0){
				        	$.post("/Valoraciones/index.php/persona/serviceEditarValoracion", {
					        	usuario_login: "<?= $this->session->userdata('EmailClienteValoracion');?>",
					        	pelicula: $(this).attr("idpelicula"),
					        	valor: $(this).val(),
					        	idValoracion: idvaloracion
					        })
	    					.done(function(dato){
	    						//Durante la respuesta que genera el servicio usado se usa la funcion listarPeliculas() para actualizar las peliculas y las calificaciones que ha hecho el usuario
	    						listarPeliculas()		
	    					});
				        }else{
				        	//Si no hay una calificacion hecha por el usuario se hace una peticion al servicio para hacer insert en la base de datos
				        	$.post("/Valoraciones/index.php/persona/serviceCreaValoracion", {
					        	usuario_login: "<?= $this->session->userdata('EmailClienteValoracion');?>",
					        	pelicula: $(this).attr("idpelicula"),
					        	valor: $(this).val()
					        })
	    					.done(function(dato){
	    						//Durante la respuesta que genera el servicio usado se usa la funcion listarPeliculas() para actualizar las peliculas y las calificaciones que ha hecho el usuario
	    						listarPeliculas()		
	    					});
				        }

				        
				    });
				    
	            }
          	}
          
        })
	}
</script>