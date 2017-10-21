<?php require_once("basics/session.php"); ?>
<?php require_once("basics/connection_db.php"); ?>
<?php
	if(isset($_SESSION["username"]))
	{
		if($_SESSION["usuario_permiso"] == 2)
		{
			header("Location: clientes_pagos.php");
			exit();
		}
		elseif(($_SESSION["usuario_permiso"] == 3) || ($_SESSION["usuario_permiso"] == 4))
		{
			header("Location: admin.php");
			exit();
		}
	}
	else
	{
		header("Location: home.php");
		exit();
	}
?>



	<?php include("basics/header.php") ?>


<body>
	
					<?php include("basics/menu_admin.php") ?>		
					<?php include("basics/functions.php") ?>	
			
			<h2>Examenes:</h2>
			<?php
			if(!isset($_REQUEST['evaluacion']))
			{
			?>
			<form name="frmCodigoExamen" method="post">	
				<table class="table table-bordered" id="tblExamenesAlumno">
					<tr>
						<td><p><b>Ingrese su código y contraseña <u>de examen</u> para añadirlo a la lista:</b></p></td>
						<td><p>Código: <input type="text" name="codEvaluacion"></p></td>
						<td><p>Contraseña: <input type="text" name="passEvaluacion"></p></td>
						<td><input type="submit" name="agregarExamen" value="Agregar Examen"></td>
					</tr>
				</table>
			</form>
			<?php $mensaje = ''; echo $mensaje; ?>
			</br>
			<table class="table table-bordered" id="tblExamenesAlumno">				
				<tr>
					<td>Examen</td>
					<td>Estado</td>
					<td>Nota</td>
					<td>Inicio</td>
					<td>Terminada</td>
					<td>Habilitada</td>
					<td>Iniciar</td>
				</tr>
				<?php
				$id=$_SESSION["alumno_id"];
				$pruebas=l_pruebas_id_alumno($id);

				while($prueba = mysql_fetch_array($pruebas))
				{	
					
					if($prueba['estado']==0)
					{
						$estado="Pendiente";
					}
					else
					{
						$estado="Finalizado";
					}
					
					if($prueba['activo']==0)
					{
						$activo="No";
					}
					else
					{
						$activo="Si";
					}
					echo 	'<tr>
							<td>' . $prueba['nombre'] . '</td>
							<td>' . $estado.'</td>
							<td>' . $prueba['nota'] . '</td>
							<td>' . $prueba['inicio'] . '</td>
							<td>' . $prueba['terminada'] . '</td>
							<td>' . $activo . '</td>';
							
					if($prueba['estado']==0 || ($prueba['estado']==0 && $prueba['activo']==1))
					{
						echo '<td><a href="alumno_evaluacion.php?evaluacion=' . $prueba['id'] . '"> Iniciar</a></td>';
					}
					else
					{
						echo '<td></td>';
					}
							'</tr>';
				}
				?>
			</table>
			</br>
			<?php
				if(isset($_POST["codEvaluacion"]) && isset($_POST["passEvaluacion"]))
				{
					global $conexion;
					$codigo = trim($_POST["codEvaluacion"]);
					$password = trim($_POST["passEvaluacion"]);
					// Buscamos que el codigo de examen ingresado sea valido
					$consulta1 = "SELECT * 
								  FROM ex_codigos 
								  WHERE codigoExamen = '{$codigo}' 
								  AND passwordExamen = '{$password}'
								  AND utilizado = '0'
								  LIMIT 1";
					$resultado1 = mysql_query($consulta1, $conexion);
					
					if(mysql_num_rows($resultado1)!=0)
					{
						$examen1 = mysql_fetch_array($resultado1);
						// Buscamos que exista el examen
						$consulta2 = "SELECT * 
									 FROM examenes
									 WHERE id = '{$examen1['idExamen']}'
									 LIMIT 1";
						$resultado2 = mysql_query($consulta2, $conexion);		
						$exam = mysql_fetch_array($resultado2);
						
						if(mysql_num_rows($resultado2)!=0)
						{	
							// Buscamos el cliente al que pertenece el examen
							$consulta3 = "SELECT * 
										  FROM ex_clientes 
										  WHERE id_Examen = '{$examen1['idExamen']}' 
										  LIMIT 1";
							$resultado3 = mysql_query($consulta3, $conexion);
							$id_cliente=mysql_fetch_array($resultado3);
							
							if(mysql_num_rows($resultado3)!=0)
							{
									// Insertamos los registro para que el alumno pueda ver el examen
									$insert = "INSERT INTO pruebas (id_cliente, id_alumno, id_examen, nota, estado)
											   VALUES ('{$id_cliente['id_cliente']}', '{$_SESSION['alumno_id']}', '{$examen1['idExamen']}', NULL, '0')";
									mysql_query($insert, $conexion) or die(mysql_error());
									
									
									$consulta5=	"SELECT *
											FROM ex_codigos
											WHERE idExamen = '{$examen1['idExamen']}'
											AND idAlumno = '{$_SESSION['alumno_id']}' ";
									$resultado5 = mysql_query($consulta5,$conexion); 
									
									if (mysql_num_rows($resultado5)==0) 
									{
										// Marcamos el código de examen como utilizado
										$update = "UPDATE ex_codigos
												   SET utilizado = '1',
												   idAlumno = '{$_SESSION['alumno_id']}'
												   WHERE codigoExamen = '{$codigo}' 
												   AND passwordExamen = '{$password}'";
										mysql_query($update, $conexion);
										echo "<script language='javascript'>window.location='alumno_evaluacion.php'</script>";
										exit();
									}
									else
									{
										echo "El examen ya esta asignado al alumno mediante otro codigo.";
									}
							}
							else
							{
								echo "Error de examen: Cliente no asignado.";
							}
						}
						else
						{
							echo "El examen no existe.";
						}
					}
					else
					{
						echo "Este código ya ha sido utilizado o el código o contraseña de examen incorrectos.";
					}
				}
			}
			else
			{
				$_SESSION["idExamen"] = $_REQUEST['evaluacion'];
				$preguntas = l_preguntas_idExamen($_REQUEST['evaluacion']);
				$tiempo = buscar_tiempo($_SESSION["idExamen"]);
				insertarInicioExamen($_SESSION["idExamen"], $_SESSION["alumno_id"]);
				$_SESSION["tiempo"] = $tiempo['tiempo'];
				$contador = 1;
				
		?>		
				<script language="JavaScript">
					var fecha = new Date();
					fecha.setMinutes(fecha.getMinutes() + <?php echo $_SESSION["tiempo"]; ?>);
					fecha.setSeconds(fecha.getSeconds() + 0);
					TargetDate = fecha;
					CountActive = true;
					CountStepper = -1;
					DisplayFormat = "%%H%%:%%M%%:%%S%%";

					function calcage(secs, num1, num2) {
					  s = ((Math.floor(secs/num1))%num2).toString();
					  if (s.length < 2)
						s = "0" + s;
					  return "<b>" + s + "</b>";
					}

					function CountBack(secs) {
					  if (secs < 0) {
						alert("Se acabó el tiempo.");
						document.getElementsByName("frmExamen")[0].submit();
						return true;
					  }
					  DisplayStr = DisplayFormat.replace(/%%H%%/g, calcage(secs,3600,24));
					  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
					  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

					  document.getElementById("cntdwn").innerHTML = DisplayStr;
					  if (CountActive)
						setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
					}

					function putspan() {
					 document.write("<span id='cntdwn' style='position:fixed; margin-left:800px; color:red; font-size:30px; font-family:calibri;'></span>");
					}

					CountStepper = Math.ceil(CountStepper);
					if (CountStepper == 0)
					  CountActive = false;
					var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
					putspan();
					var dthen = new Date(TargetDate);
					var dnow = new Date();
					if(CountStepper>0)
					  ddiff = new Date(dnow-dthen);
					else
					  ddiff = new Date(dthen-dnow);
					gsecs = Math.floor(ddiff.valueOf()/1000);
					CountBack(gsecs);
				</script>
				<?php
				if(mysql_num_rows($preguntas) != 0)
				{
					echo '<form name="frmExamen" method="post" action="alumno_evaluacion.php">';
					while($pregunta = mysql_fetch_array($preguntas))
					{
						if ($pregunta['tipoPregunta'] == '0') // VERDADERO O FALSO
						{
							$cantidadRespuestasPorPregunta[$contador] = 2;
							echo '<b>' . $contador . ' - ' . $pregunta['pregunta'] . '</b>';
							echo '</br></br>';
							echo '<input type="radio" value="1" name="VF' . $contador . '" checked> Verdadero';
							echo '</br>';
							echo '<input type="radio" value="2" name="VF' . $contador . '"> Falso';
							echo '</br></br>';
							$contador++;
						}
						else if ($pregunta['tipoPregunta'] == '1') //MULTIPLE CHOICE
						{
							$cantidadPreguntas = 0;
							echo '<b>' . $contador . ' - ' . $pregunta['pregunta'] . '</b></br>';
							echo '</br>';
							if (!empty($pregunta['resp1']))
							{
								echo '<input type="radio" value="1" name="MC' . $contador . '"'; if (!empty($pregunta['resp1'])) { echo "checked"; } echo '> ' . $pregunta['resp1'] . '</br>';
								$cantidadPreguntas++;
							}
							if (!empty($pregunta['resp2']))
							{
								echo '<input type="radio" value="2" name="MC' . $contador . '"'; if (empty($pregunta['resp1'])) { echo "checked"; } echo '> ' . $pregunta['resp2'] . '</br>';
								$cantidadPreguntas++;
							}
							if (!empty($pregunta['resp3']))
							{
								echo '<input type="radio" value="3" name="MC' . $contador . '"'; if ((empty($pregunta['resp1'])) && (empty($pregunta['resp2']))) { echo "checked"; } echo '> ' . $pregunta['resp3'] . '</br>';
								$cantidadPreguntas++;
							}
							if (!empty($pregunta['resp4']))
							{
								echo '<input type="radio" value="4" name="MC' . $contador . '"'; if ((empty($pregunta['resp1'])) && (empty($pregunta['resp2'])) && (empty($pregunta['resp3']))) { echo "checked"; } echo '> ' . $pregunta['resp4'] . '</br>';
								$cantidadPreguntas++;
							}
							if (!empty($pregunta['resp5']))
							{
								echo '<input type="radio" value="5" name="MC' . $contador . '"> ' . $pregunta['resp5'] . '</br>';
								$cantidadPreguntas++;
							}
							echo '</br>';
							$cantidadRespuestasPorPregunta[$contador] = $cantidadPreguntas;
							$contador++;
						}
					}
					echo '<input type="submit" name="Finalizar" value="Finalizar">';
					echo '</form>';
				}
			}
			if(isset($_POST['MC1']) || isset($_POST['VF1']))
			{
				$contadorPreguntas = 0;
				$contadorRespuestasCorrectas = 0;
				$preguntas2 = l_preguntas_idExamen($_SESSION["idExamen"]);
				$correcta = '';
				while($pregunta2 = mysql_fetch_array($preguntas2))
				{
					if ($pregunta2['tipoPregunta'] == '0') // VERDADERO O FALSO
					{
						$contadorPreguntas++;
						if ($_POST["VF{$contadorPreguntas}"] == $pregunta2['respcorrecta'])
						{
							$contadorRespuestasCorrectas++;
							$correcta = "Si";
						}
						else
						{
							$correcta = "No";
						}
						cargarResultadoExamen($pregunta2['idExamen'], $_SESSION["alumno_id"], $pregunta2['idPregunta'], $pregunta2['respcorrecta'], $correcta);
					}
					else if ($pregunta2['tipoPregunta'] == '1') //MULTIPLE CHOICE
					{
						$contadorPreguntas++;
						if ($_POST["MC{$contadorPreguntas}"] == $pregunta2['respcorrecta'])
						{
							$contadorRespuestasCorrectas++;						
							$correcta = "Si";
						}
						else
						{
							$correcta = "No";
						}
						cargarResultadoExamen($pregunta2['idExamen'], $_SESSION["alumno_id"], $pregunta2['idPregunta'], $pregunta2['respcorrecta'], $correcta);
					}
				}
				$nota = 10 / $contadorPreguntas * $contadorRespuestasCorrectas;
				insertarFinExamen($nota, $_SESSION["idExamen"], $_SESSION["alumno_id"]);
				header("Location: alumno_evaluacion.php");
			}
			?>
			</br></br>
		</div>
<?php include("basics/footer.php"); ?>