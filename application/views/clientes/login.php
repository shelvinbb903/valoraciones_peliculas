<?php
	if(!empty($this->session->userdata('EmailClienteValoracion'))){
		header('Location: ' . base_url() . "index.php/persona/home");
	}
?>
<!--
	Vista Iniciar Sesion de Clientes
	Descripcion: Se muestran los campos con los datos basicos para que el usuario los ingrese y pueda tener acceso en el sistema
-->
<div id="container">
	<h1><?= $titulo;?></h1>

	<div id="body">
		<div class="container">
			<form class="cmxform" id="frmLoginCliente" method="post" action="">
				<br>
				<div class="row">
					<div class="col-md-1">
						<label>Usuario:</label>
					</div>
					<div class="col-md-4">
						<input type="text" name="txtUsuario" id="txtUsuario" class="form-control">
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-1">
						<label>Contraseña:</label>
					</div>
					<div class="col-md-4">
						<input type="password" name="txtPassword" id="txtPassword" class="form-control">
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5">
						<button class="btn btn-primary pull-right" type="submit"><b>ENTRAR</b></button>
					</div>
				</div>
			</form>
		</div>
		
	</div>

	<p class="footer">Prueba Valoraciones de Peliculas</p>
</div>