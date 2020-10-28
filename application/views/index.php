<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ingreso Usuario</title>
	<link rel="stylesheet" href="/clases/css/estilos.css">
	
</head>
<body>

 	<div class="login">

	 <img class="logo" src="/clases/imagenes/logo_caracol.jpg" alt="logo caracol">
	 <h1>Ingreso a sistema</h1>

	 <form action="/clases/index.php/usuario/login" method="post">

		<label for="username">Usuario</label>
		<input type="text" id="usuario" name="usuario" requerid>

		<label for="username">contraseña</label>
		<input type="password" id="contrasena" name="contrasena" requerid>

		<input class="boton" type="submit" name="submit" value="INGRESAR"/>

		<a href="/clases/index.php/home/recuperarContrasena">Recuperar contraseña</a>
		<br>
		<a href="/clases/index.php/home/registro">Registro</a>
		

	</form>


	</div>

</body>
</html>