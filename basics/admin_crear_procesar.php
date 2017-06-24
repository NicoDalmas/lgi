<?php 
	include("connection_db.php");
?>	
<?php 
	if(!empty($_POST['username'])and !empty($_POST['password'])and !empty($_POST['email']))
	{
		$username=$_POST["username"];
		$password=$_POST["password"];
		$email=$_POST["email"];
		$idacceso=$_POST["idacceso"];
		$nombre=$_POST["nombre"];
		$apellido=$_POST["apellido"];
		$dni=$_POST["dni"];
		$sexo=$_POST["sexo"];	
		$q="INSERT INTO usuarios (username, password, nombre, apellido, dni, idAcceso, email, sexo) VALUES ('$username','$password','$nombre','$apellido','$dni','$idacceso','$email','$sexo')"; 
		$result = mysql_query($q) or die(mysql_error());
		header("Location: ../admin_usuarios.php");
	}
	else
	{
		echo "Complete los datos correctamente";
	}
?>	