<?php require_once("basics/session.php"); ?>
<?php
	if(isset($_SESSION["username"]))
	{
		if($_SESSION["usuario_permiso"] == 1)
		{
			header("Location: alumno.php");
			exit();
		}
		elseif($_SESSION["usuario_permiso"] == 3)
		{
			header("Location: admin.php");
			exit();
		}
		elseif($_SESSION["usuario_permiso"] == 4)
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<?php include("basics/header.php") ?>	
</head>

<body>
	<div id="main">
		<div id="header">
			<div id="header">
				<div id="banner">
					<?php include("basics/logo.php") ?>
					<?php include("basics/sesion.php") ?>					
					<?php include("basics/menu_admin.php") ?>		
					<?php include("basics/functions.php") ?>	
				</div>	
			</div>	
		</div>	
		
		<div id="site_content">		
				<?php		
				$pruebas=l_pruebas_examen_alumno($_SESSION['id_alumno'], $_REQUEST['id']);
				echo'<font class="f8"> <label>Examen:'.$pruebas['nombre'].'</label>	</font><br>';
				echo'<font class="f8"> <label>Tiempo estimado:'.$pruebas['tiempo'].'</label>	</font><br>';
				echo'<font class="f8"> <label>Examen:'.$pruebas['nota'].'</label>	</font><br>';
				echo "<table class='tblExamenesAlumno' id='tblExamenesAlumno'><tr><td>Pregunta</td><td>Respuesta</td><td>Correcta</td></tr>";
				echo'</tr></table><br>';
				
				$resultados = l_resultados($_SESSION['id_alumno'], $_REQUEST['id']);
				
				$contador = 0;
				while ($resultado=mysql_fetch_array($resultados))
					{
					
						if ($resultado['tipoPregunta'] == '0') // VERDADERO O FALSO
						{
							$cantidadRespuestasPorPregunta[$contador] = 2;
							echo '<b>' . $contador . ' - ' . $resultado['pregunta'] . '</b>';
							echo '</br></br>';
							if ($resultado['idRespuesta'] == 1)
							{
								echo '<input type="radio" value="1" name="VF' . $contador . '" checked> Verdadero';
								echo '</br>';
								echo '<input type="radio" value="2" name="VF' . $contador . '"> Falso';
								echo '</br></br>';
							}
							else
							{
								echo '<input type="radio" value="1" name="VF' . $contador . '"> Verdadero';
								echo '</br>';
								echo '<input type="radio" value="2" name="VF' . $contador . '" checked> Falso';
								echo '</br></br>';
							}
							echo '</br>';
							if ($resultado['correcta'] == "Si")
							{ echo 'Respuesta Correcta'; echo '</br>'; }
							else
							{ echo 'Respuesta Incorrecta'; echo '</br>'; }
							$contador++;
						}
						else if ($resultado['tipoPregunta'] == '1') //MULTIPLE CHOICE
						{
							$cantidadPreguntas = 1;
							echo '<b>' . $contador . ' - ' . $resultado['pregunta'] . '</b></br>';
							echo '</br>';
							if (!empty($resultado['resp1']))
							{
								echo '<input type="radio" value="1" name="MC' . $contador . '"'; if ($resultado['idRespuesta'] == 1) { echo "checked"; } echo '> ' . $resultado['resp1'] . '</br>';
								$cantidadPreguntas++;
							}
							if (!empty($resultado['resp2']))
							{
								echo '<input type="radio" value="2" name="MC' . $contador . '"'; if ($resultado['idRespuesta'] == 2) { echo "checked"; } echo '> ' . $resultado['resp2'] . '</br>';
								$cantidadPreguntas++;
							}
							if (!empty($resultado['resp3']))
							{
								echo '<input type="radio" value="3" name="MC' . $contador . '"'; if ($resultado['idRespuesta'] == 3) { echo "checked"; } echo '> ' . $resultado['resp3'] . '</br>';
								$cantidadPreguntas++;
							}
							if (!empty($resultado['resp4']))
							{
								echo '<input type="radio" value="4" name="MC' . $contador . '"'; if ($resultado['idRespuesta'] == 4) { echo "checked"; } echo '> ' . $resultado['resp4'] . '</br>';
								$cantidadPreguntas++;
							}
							if (!empty($resultado['resp5']))
							{
								echo '<input type="radio" value="5" name="MC' . $contador . '"'; if ($resultado['idRespuesta'] == 5) { echo "checked"; } echo '> ' . $resultado['resp5'] . '</br>';
								$cantidadPreguntas++;
							}
							echo '</br>';
							if ($resultado['idRespuesta'] == $resultado['respcorrecta']) { echo 'Respuesta Correcta'; } else { echo 'Respuesta Incorrecta'; }
							echo '</br>';
							//$cantidadRespuestasPorPregunta[$contador] = $cantidadPreguntas;
							$contador++;
						}
					}

					
					/*$preguntas=l_preguntas_idExamen($prueb['id']);					FALTA ACA HACER LAS RELACIONES DE LAS TABLAS
	
					$prueba_renglones=l_respuestas($_REQUEST['id'], $_SESSION['id_alumno'] , $pregunta['idPregunta']);
					
					$nom_respuesta=l_nom_respuesta($prueb['id'], $renglon['idRespuesta'] );*/
					
					
				?>
		</div>
<?php include("basics/footer.php"); ?>