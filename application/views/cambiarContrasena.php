<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Registro de Usuarios</title>
    <link rel="stylesheet" href="/clases/css/estilos.css">
     

</head>
<body>

 	<div class="registro">

	 <img class="logo" src="/clases/imagenes/logo_caracol.jpg" alt="logo caracol">
	 <h1>Registro</h1>

	 <form action="/clases/index.php/usuario/cambiar_contrasena" method="post" onsubmit =" return validaContrasena();">

        <label for="token">Codigo de seguridad</label>
		<input type="text" id="token" name="token" required>

		<label for="pass">contraseña</label>
		<input type="password" id="contrasena" name="contrasena" required>

        <label for="pass2">Repite contraseña</label>
		<input type="password" id="contrasena2" name="contrasena2" required>

		<input class="boton" type="submit" name="submit" value="CAMBIAR CONTRASEÑA"/>

		
	</from>


    </div>
   

</body>
<script src="/clases/js/script.js"></script>

</html>


