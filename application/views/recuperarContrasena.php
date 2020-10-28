<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="/clases/css/estilos.css">
     

</head>
<body>

 	<div class="registro">

	 <img class="logo" src="/clases/imagenes/logo_caracol.jpg" alt="logo caracol">
	 <h1>Recuperar Contraseña</h1>

	 <form action="/clases/index.php/usuario/recuperar_contrasena" method="post">

		<label for="usuario">Usuario</label>
		<input type="text" id="usuario" name="usuario" required>

        <label for="RUT">RUT</label>
		<input type="text" id="rut" name="rut" required>

        <label for="RUT">Correo</label>
		<input type="text" id="correo" name="correo" required>
        		
		<input class="boton" type="submit" name="submit" value="RECUPERAR CONTRASEÑA"/>

		
	</from>


    </div>
   

</body>
<script src="/clases/js/script.js"></script>

</html>