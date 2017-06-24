<?php 
	include("connection_db.php");
?>
<?php 
	$username = trim($_POST["usuario"]);
	$password = trim($_POST["clave1"]);
	$razon = trim($_POST["razon"]);
	$nombre = trim($_POST["nombre"]);
	$apellido = trim($_POST["apellido"]);
	$dni = trim($_POST["dni"]);
	$tipo = trim($_POST["tipo"]);
	$correo = trim($_POST["correo"]); 
	//fecha de nacimiento ????????????????????????
	$sexo = trim($_POST["sexo"]);
	$preguntasecreta = trim($_POST["respuesta"]); //no la intruducimos a la base de datos ?
	
	//Validar que no exista el usuario antes de crearlo
	global $conexion;
	$consulta= "SELECT * 
				FROM usuarios 
				WHERE username = '{$username}' 
				   OR dni = '{$dni}' 
				LIMIT 1";
	$resultado = mysql_query($consulta,$conexion);
	if(mysql_num_rows($resultado)==0)
	{
		$q="INSERT INTO usuarios (username, password, razon, nombre, apellido, dni, idAcceso, email, sexo) 
			VALUES ('$username','$password','$razon','$nombre','$apellido','$dni','$tipo','$correo','$sexo')"; 
		$result = mysql_query($q) or die(mysql_error());
		header("Location: ../home.php");
	}
	else
	{
		echo 'El nombre de usuario y/o dni ya esta registrado';
	}
?>