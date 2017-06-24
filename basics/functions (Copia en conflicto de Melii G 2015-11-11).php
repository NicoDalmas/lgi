<?php include("connection_db.php") ?>	
<?php
	
	function verificar_consulta($consulta)
	{
		if(!$consulta)
		{
			die("No se ha podido realizar la consulta:" .mysql_error());
		}
	}
	
	function validarCamposObligatorios($campos_obligatorios)
	{
		$errores = array();
		foreach($campos_obligatorios as $campo)
		{
			if(!isset($_POST[$campo]) || (empty($_POST[$campo]) 
				&& !is_numeric($_POST[$campo])))
			{
				$errores[] = $campo;
			}
		}
		return $errores;
	}
	//listar alumno segun id
	function listar_alumnos($id)
	{
		global $conexion;
		$consulta= //-----
					"SELECT * 
					FROM usuarios 
					WHERE id = '{$id}' 
					ORDER BY nombre"; 
					//-----
		$resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
		$valor = mysql_fetch_array($resultado);
		return $valor ;
	}
	////listar pruebas segun id_alumno 
	function l_pruebas_id_alumno($id_alumno){
	global $conexion;
	$consulta= "SELECT * 
				FROM pruebas 
				WHERE id_alumno = '{$id_alumno}' "; 
    $resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
		return $resultado ;
	}
	////listar examenes segun id
	function l_examenes_id($id){
	global $conexion;
	$consulta= //-----
				"SELECT * 
				FROM examenes 
				WHERE id = '{$id}' 
				ORDER BY nombre"; 
				//-----
    $resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
	$valor = mysql_fetch_array($resultado);
		return $valor ;
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	////login clientes
	function l_login_clientes($username,$password){
	global $conexion;
	$consulta = "SELECT * 
				FROM usuarios 
				WHERE usuario = '{$username}' 
				AND clave = '{$password}' 
				AND activo = '1' 
				LIMIT 1";
	$resultado = mysql_query($consulta, $conexion);
	
			$login = mysql_fetch_array($resultado);
			return $login ;
	
	}
	
	function l_ex_clientes($id_cliente){
	global $conexion;
	$consulta= //-----
				"SELECT * 
				FROM ex_clientes 
				WHERE id_cliente = '{$id_cliente}'   
				ORDER BY id"; 
				//-----
    $resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
	return $resultado ;
}
	function l_alumnos($id_cliente){ 					/////////////////// MODIFICAR ACA
	global $conexion;
	$consulta= //-----
				"SELECT * 
				FROM alumnos 
				WHERE id_cliente = '{$id_cliente}' 
				ORDER BY apellido"; 
				//-----
    $resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
			return $resultado ;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//listar materias
	function l_materias()
	{
		global $conexion;
		$consulta= "SELECT * 
					FROM materias 
					ORDER BY materia"; 
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		return $resultado;
	}

//buscar materia por id
	function buscarMateria($idMateria)
	{
		global $conexion;
		$consulta= "SELECT * 
					FROM materias
					WHERE idMateria = '{$idMateria}'
					ORDER BY materia
					LIMIT 1";
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		$valor = mysql_fetch_array($resultado);
		return $valor ;
	}
	
//agregar materia
	function agregarMateria($materia, $descripcion)
	{
		global $conexion;
		$consulta= "SELECT * 
					FROM materias 
					WHERE materia = '{$materia}' OR descripcion = '{$descripcion}'
					LIMIT 1";
		$resultado = mysql_query($consulta,$conexion);
		if(mysql_num_rows($resultado)==0)
		{
			$insert= "INSERT INTO `examinar`.`materias` (`idMateria`, `materia`, `descripcion`)
						VALUES (NULL, '{$materia}', '{$descripcion}');"; 
			mysql_query($insert,$conexion);
			header("Location: admin_materias.php");
		}
		else
		{
			echo '<p>La materia y/o descripcion coinciden con un registro existente</p>';
		}
	}
	
//editar materia
	function editarMateria($idMateria, $materia, $descripcion)
	{
		global $conexion;
		$consulta1= "SELECT * 
					FROM materias 
					WHERE idMateria <> '{$idMateria}' AND (materia = '{$materia}' OR descripcion = '{$descripcion}')
					LIMIT 1";
		$resultado1 = mysql_query($consulta1,$conexion);
		if(mysql_num_rows($resultado1)==0)
		{
			$consulta2= "SELECT * 
						FROM materias 
						WHERE idMateria = '{$idMateria}'
						LIMIT 1";
			$resultado2 = mysql_query($consulta2,$conexion);
			verificar_consulta($resultado2);
			$valor = mysql_fetch_array($resultado2);
			if(($materia != $valor['materia']) || ($descripcion != $valor['descripcion']))
			{
				$update= "UPDATE materias 
						  SET materia='{$materia}', descripcion='{$descripcion}'
						  WHERE idMateria='{$idMateria}'"; 
				mysql_query($update,$conexion);
				header("Location: admin_materias.php");
			}
			else
			{
				echo '<p>No se ha modificado el registro</p>';
			}
		}
		else
		{
			echo '<p>La materia y/o descripcion coinciden con un registro existente</p>';
		}

	}
	
//eliminar materia
	function eliminarMateria($idMateria)
	{
		global $conexion;
		$consulta= "SELECT *
					FROM examenes 
					WHERE id_materia = '{$idMateria}'
					LIMIT 1"; 
		$resultado1 = mysql_query($consulta,$conexion);
		if(mysql_num_rows($resultado1)==0)
		{
			global $conexion;
			$consulta= "SELECT *
						FROM ex_solicitados 
						WHERE idMateria = '{$idMateria}'
						LIMIT 1"; 
			$resultado2 = mysql_query($consulta,$conexion);
			if(mysql_num_rows($resultado2)==0)
			{
				$delete= "DELETE
						  FROM materias 
						  WHERE idMateria = '{$idMateria}'"; 
				mysql_query($delete,$conexion);
				header("Location: admin_materias.php");
			}
			else
			{
				echo '<p>La materia ' . $idMateria . ' no puede ser eliminada porque esta siendo usada en un pedido.</p>';
			}
		}
		else
		{
			echo '<p>La materia ' . $idMateria . ' no puede ser eliminada porque esta siendo usada en un examen.</p>';
		}
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//listar promociones
	function l_promociones()
	{
		global $conexion;
		$consulta= "SELECT * 
					FROM promociones 
					ORDER BY id"; 
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		return $resultado;
	}
	
//eliminar promocion
	function eliminarPromo($id)
	{
		global $conexion;
		$consulta= "DELETE
					FROM promociones 
					WHERE id = '{$id}'"; 
		mysql_query($consulta,$conexion);
		header("Location: admin_promos.php");
	}
	
//buscar promo por id
	function buscarPromo($id)
	{
		global $conexion;
		$consulta= "SELECT * 
					FROM promociones
					WHERE id = '{$id}'
					ORDER BY id
					LIMIT 1";
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		$valor = mysql_fetch_array($resultado);
		return $valor ;
	}
	
//agregar promo
	function agregarPromo($titulo, $descripcion, $precio)
	{
		global $conexion;
		$insert= "INSERT INTO promociones (titulo, descripcion, precio)
				  VALUES ('{$titulo}', '{$descripcion}', '{$precio}');"; 
		mysql_query($insert,$conexion);
		header("Location: admin_promos.php");
	}	
	
//editar promo
	function editarPromo($id, $titulo, $descripcion, $precio)
	{
		global $conexion;
		$consulta= "SELECT * 
					 FROM promociones 
					 WHERE id = '{$id}'
					 LIMIT 1";
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		$valor = mysql_fetch_array($resultado);
		if(($titulo != $valor['titulo']) || ($descripcion != $valor['descripcion']) || ($precio != $valor['precio']))
		{
			$update= "UPDATE promociones 
					  SET titulo='{$titulo}', descripcion='{$descripcion}', precio='{$precio}'
					  WHERE id='{$id}'"; 
			mysql_query($update,$conexion);
			header("Location: admin_promos.php");
		}
		else
		{
			echo '<p>No se ha modificado el registro</p>';
		}
	}
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//listar promociones
	function l_temas()
	{
		global $conexion;
		$consulta= "SELECT * 
					FROM materias 
					ORDER BY materia"; 
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		return $resultado;
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
//agregar solicitud
	function agregarSolicitudProducto($tipo, $comentarios, $tema, $tiempo, $cantidad)
	{
		global $conexion;
		$insert= "INSERT INTO ex_solicitados (idCliente, idMateria, idExamen, tipoDeExamen, tiempo, comentarios, cantidadEncuestados)
				  VALUES ('{$_SESSION["cliente_id"]}', '{$tema}', NULL, '{$tipo}', '{$tiempo}', '{$comentarios}', '{$cantidad}');"; 
		mysql_query($insert,$conexion);
		echo '<p>Pedido ingresado</p>';
	}	

	function l_solicitudesPendientes()
	{
		global $conexion;
		$consulta= "SELECT ES.id, ES.idCliente, M.materia, ES.tipoDeExamen, ES.tiempo, ES.comentarios, ES.cantidadEncuestados
					FROM ex_solicitados ES
					LEFT JOIN materias M
						   ON ES.idMateria = M.idMateria
					WHERE ES.idExamen IS NULL
					ORDER BY ES.id"; 
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		return $resultado;
	}
	
	function l_solicitudesPendientes_id($id)
	{
		global $conexion;
		$consulta= "SELECT ES.id, ES.idCliente, M.materia, ES.tipoDeExamen, ES.tiempo, 
						   ES.comentarios, ES.cantidadEncuestados, ES.idExamen, ES.idMateria
					FROM ex_solicitados ES
					LEFT JOIN materias M
						   ON ES.idMateria = M.idMateria
					WHERE ES.id = '$id'
					  AND ES.idExamen IS NULL
					LIMIT 1"; 
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		$valor = mysql_fetch_array($resultado);
		return $valor;
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function l_examenes()
	{
		global $conexion;
		$consulta= "SELECT E.id, E.nombre, E.descripcion, M.materia, E.tiempo, E.activo
					FROM examenes E
					LEFT JOIN materias M
						   ON E.id_materia = M.idMateria
					ORDER BY E.id DESC"; 
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		return $resultado;
	}
	
	function agregarExamen($nombre, $descripcion, $idMateria, $tiempo, $activo, $cantidad, 
							$idCliente, $idSolicitud)
	{
		global $conexion;
		$insert= "INSERT INTO examenes (nombre, descripcion, id_materia, tiempo, activo)
				  VALUES ('{$nombre}', '{$descripcion}', '{$idMateria}', '{$tiempo}', '{$activo}')";
		$resultado1 = mysql_query($insert,$conexion);
		verificar_consulta($resultado1);
		
		$consulta = "SELECT MAX(id) AS 'id'
					 FROM examenes";
		$resultado2 = mysql_query($consulta,$conexion);
		verificar_consulta($resultado2);
		$idExamenNuevo = mysql_fetch_array($resultado2);
		
		$idExamen = $idExamenNuevo['id'];

		$insert2= "INSERT INTO ex_clientes (id_examen, id_cliente, id_solicitud)
				  VALUES ('{$idExamen}', '{$idCliente}', '{$idSolicitud}')";
		$resultado3 = mysql_query($insert2,$conexion);
		verificar_consulta($resultado3);
		
		for($i=1;$i<=$cantidad;$i++) 
		{
			$nombreCodigo = $idExamenNuevo['id'] . 'E' . $i;
			$passCodigo = aleatorio(8);
			$insertCodigos= "INSERT INTO ex_codigos (idExamen, codigoExamen, passwordExamen, utilizado)
					  VALUES ('{$idExamen}', '{$nombreCodigo}', '{$passCodigo}', '0')";
			mysql_query($insertCodigos,$conexion);
		}
		
		$update= "UPDATE ex_solicitados 
				  SET idExamen='{$idExamen}'
				  WHERE id='{$idSolicitud}'"; 
		$resultado4 = mysql_query($update,$conexion);
		verificar_consulta($resultado4);
		
		$_SESSION["ex_id"] = '';
		$_SESSION["ex_materia"] = '';
		$_SESSION["ex_tipoDeExamen"] = '';
		$_SESSION["ex_tiempo"] = '';
		$_SESSION["ex_comentarios"] = '';
		$_SESSION["ex_cantidadEncuestados"] = '';
		$_SESSION["ex_idCliente"] = '';
		$_SESSION["ex_idMateria"] = '';
	}
	
	function aleatorio($length)
	{
		$codigo = '';
		$patron = "1234567890abcdefghijklmnopqrstuvwxyz";
		for($i = 0; $i < $length; $i++) {
			$codigo .= $patron{rand(0, 35)};
		}
		return $codigo;
	}	
	
	function eliminarExamen($idExamen)
	{
		global $conexion;
		$delete1 = "DELETE
					FROM examenes 
					WHERE id = '{$idExamen}'"; 
		$resultado1 = mysql_query($delete1,$conexion);
		verificar_consulta($resultado1);			
		
		$delete2 = "DELETE
					FROM ex_clientes 
					WHERE id_examen = '{$idExamen}'"; 
		$resultado2 = mysql_query($delete2,$conexion);
		verificar_consulta($resultado2);
		
		$update= "UPDATE ex_solicitados 
				  SET idExamen = NULL
				  WHERE idExamen='{$idExamen}'"; 
		$resultado3 = mysql_query($update,$conexion);
		verificar_consulta($resultado3);
		
		$delete3 = "DELETE
					FROM ex_codigos 
					WHERE idExamen = '{$idExamen}'"; 
		$resultado4 = mysql_query($delete3,$conexion);
		verificar_consulta($resultado4);
	}
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	function l_preguntas_examen($idExamen)
	{
		global $conexion;
		$consulta= "SELECT *
					FROM preguntas
					WHERE idExamen = '{$idExamen}'
					ORDER BY idPregunta DESC"; 
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		return $resultado;
	}
	
	function eliminarPregunta($idPregunta)
	{
		global $conexion;
		$delete = "DELETE
				   FROM preguntas 
				   WHERE idPregunta = '{$idPregunta}'"; 
		$resultado = mysql_query($delete,$conexion);
		verificar_consulta($resultado);	
	}
	
	function buscarTipoExamen($idExamen)
	{
		global $conexion;
		$consulta= "SELECT *
					FROM ex_solicitados
					WHERE idExamen = '{$idExamen}'
					LIMIT 1"; 
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		$valor = mysql_fetch_array($resultado);
		return $valor;
	}
	
	function activarExamen($idExamen)
	{
		global $conexion;
		$update= "UPDATE examenes 
				  SET activo = 1
				  WHERE id='{$idExamen}'"; 
		$resultado = mysql_query($update,$conexion);
		verificar_consulta($resultado);
	}
	
	function desactivarExamen($idExamen)
	{
		global $conexion;
		$update= "UPDATE examenes 
				  SET activo = 0
				  WHERE id='{$idExamen}'"; 
		$resultado = mysql_query($update,$conexion);
		verificar_consulta($resultado);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
////////////////////////////////////////USUARIOS/////////////////////////////////////////////////////////////

////listar usuarios
	function l_usuarios($id)
	{
		global $conexion;
		$consulta= //-----
					"SELECT * 
					FROM usuarios 
					ORDER BY username"; 
					//-----
		$resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
		verificar_consulta($resultado);  //llama funcion de funtions.php
		return $resultado;
	}	
	function l_usuarios_id($id)
	{
		global $conexion;
		$consulta= //-----
					"SELECT * 
					FROM usuarios 
					WHERE id = '{$id}'"; 
					//-----
		$resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
		verificar_consulta($resultado);  //llama funcion de funtions.php
		return $resultado;
	}
	
////listar usuarios x id de acceso
	function l_usuarios_idacceso($idacceso)
	{
		global $conexion;
		$consulta= //-----
					"SELECT * 
					FROM usuarios 
					WHERE idAcceso = '{$idacceso}'
					ORDER BY username"; 
					//-----
		$resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
		verificar_consulta($resultado);  //llama funcion de funtions.php
		return $resultado;
	}	

///separar por grupo de usuarios
	function separar($usuarios, $idacceso){
		
		if ($idacceso==1){
			$nombre_usuario="Alumnos";
		}
		elseif ($idacceso==2){
			$nombre_usuario="Clientes";
		}
		elseif ($idacceso==3){
			$nombre_usuario="Administradores";
		}
		else {
			$nombre_usuario="Admins";
		}
		echo "<br><h2>".$nombre_usuario."</h2>";
		echo "<br><table  class='tblExamenesAlumno' id='tblExamenesAlumno'>";
		echo "<tr>
				<td>Username</td>
				<td>Password</td>
				<td>Email</td>
				<td>Id de acceso</td>
				<td>Nombre</td>
				<td>Apellido</td>
				<td>DNI</td>
				<td>Razon</td>
				<td>Sexo</td>
				<td>Editar</td>
			</tr>";
		while($usuario = mysql_fetch_array($usuarios))
		{	
			echo"<tr>";
			echo"<td>".$usuario['username']."</td><td>".$usuario['password']."</td><td>".$usuario['email']."</td><td>".$usuario['idAcceso']."</td><td>".$usuario['nombre']."</td><td>".$usuario['apellido']."</td><td>".$usuario['dni']."</td><td>".$usuario['razon']."</td><td>".$usuario['sexo']."</td><td><li><a href='admin_usuarios_editar.php?id=".$usuario['id']."'> Editar</a></li></td></tr>";
		}
		echo "</table>";
		echo "<br>";
	}	
//////// modificar usuarios
	function m_usuarios($username,$password,$email,$nombre,$apellido,$dni,$razon,$sexo,$id){
	global $conexion;
	$consulta = "UPDATE usuarios SET 
									username = '{$username}',
									password = '{$password}',
									email = '{$email}',
									nombre = '{$nombre}',
									apellido = '{$apellido}',
									dni = '{$dni}',
									razon = '{$razon}',
									sexo = '{$sexo}'
								WHERE id = {$id}";
	$resultado = mysql_query($consulta, $conexion);
		if(mysql_affected_rows() == 1)
			{$mensaje = "Se ha actualizado correctamente";}
		else	{$mensaje = "Se ha obtenido un error. <br>" . mysql_error();}
		return $mensaje;
	}
	
/////////////////////////////////////////////////////////////////PRODUCTOS CLIENTES///////////////////////////////////////////////////////////////////////////////////
	function ex_clientes($cliente_id)
	{
		global $conexion;
		$consulta= //-----
					"SELECT * 
					FROM ex_clientes 
					WHERE id_cliente = '{$cliente_id}'"; 
					//-----
		$resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
		verificar_consulta($resultado);  //llama funcion de funtions.php
		return $resultado;
	}
		function id_examenes($id_del_examen)
	{
		global $conexion;
		$consulta= //-----
					"SELECT * 
					FROM examenes 
					WHERE id = '{$id_del_examen}'"; 
					//-----
		$resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
		verificar_consulta($resultado);  //llama funcion de funtions.php
		return $resultado;
	}
	function tabla_codigos($id_del_examen)
	{
		global $conexion;
		$consulta= //-----
					"SELECT * 
					FROM ex_codigos
					WHERE idExamen = '{$id_del_examen}'"; 
					//-----
		$resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
		verificar_consulta($resultado);  //llama funcion de funtions.php
		return $resultado;
	}
	function nombre_materia($materiaID)
	{
		global $conexion;
		$consulta= //-----
					"SELECT materia 
					FROM materias
					WHERE idMateria = '{$materiaID}'"; 
					//-----
		$resultado = mysql_query($consulta,$conexion); // ejecucion de la consulta anterior
		verificar_consulta($resultado);  //llama funcion de funtions.php
		return $resultado;
	}
	////////////////////////////////////////////////////////////////////////ULTIMO MAGIO///////////////////////////////////////////////////////
	
	function agregarPregunta($pregunta,$tipoPregunta,$respuesta1,$respuesta2,$respuesta3,$respuesta4,$respuesta5,$respPregunta,$id)
	{
		global $conexion;
		$insert= "INSERT INTO preguntas (idExamen, pregunta, resp1, resp2, resp3, resp4, resp5, respcorrecta, tipoPregunta)
				  VALUES ('{$id}', '{$pregunta}', '{$respuesta1}', '{$respuesta2}', '{$respuesta3}', '{$respuesta4}', '{$respuesta5}', '{$respPregunta}', '{$tipoPregunta}')";
		$resultado1 = mysql_query($insert,$conexion);
		verificar_consulta($resultado1);
	}
	
	function editarPregunta($pregunta,$tipoPregunta,$respuesta1,$respuesta2,$respuesta3,$respuesta4,$respuesta5,$respPregunta,$idPreg)
	{
		global $conexion;
		$consulta = "UPDATE preguntas SET 
							pregunta = '{$pregunta}',
							resp1 = '{$respuesta1}',
							resp2 = '{$respuesta2}',
							resp3 = '{$respuesta3}',
							resp4 = '{$respuesta4}',
							resp5 = '{$respuesta5}',
							respcorrecta = '{$respPregunta}',
							tipoPregunta = '{$tipoPregunta}'
						WHERE idPregunta = {$idPreg}";
		$resultado1 = mysql_query($consulta,$conexion);
		verificar_consulta($resultado1);
	}
	
	
	function l_preguntas_preguntas($idPregunta)
	{
		global $conexion;
		$consulta= "SELECT *
					FROM preguntas
					WHERE idPregunta = '{$idPregunta}'
					ORDER BY idPregunta DESC"; 
		$resultado = mysql_query($consulta,$conexion);
		verificar_consulta($resultado);
		return $resultado;
	}
?>