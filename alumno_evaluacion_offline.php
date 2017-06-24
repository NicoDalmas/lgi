<?php require_once("basics/session.php"); ?>
<?php
	if(isset($_SESSION["username"]))
	{
		if($_SESSION["usuario_permiso"] == 1)
		{
			header("Location: alumno.php");
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
<?php
include("basics/functions.php");
echo "<center>";
$preguntas = l_preguntas_idExamen($_SESSION['idExamen']);
$contador = 1;
echo "<center><h2>Intrucciones examen offline</h2></center><br>";
echo "<p> En las opciones Multiple Choice debera marcar la respuesta correcta con una X</p>";
echo "<p> Para imprimir el examen deberá hacer en pantalla <u>CLICK DERECHO - IMPRIMIR</u> o con la combinacion de teclas <u>CONTROL - P</u> y seleccionar su impresora correspondiente<br>";
echo "<hr>";
echo "<table style='size:8.27in 11.69in; margin:.5in .5in .5in .5in; mso-header-margin:.5in; mso-footer-margin:.5in; mso-paper-source:0;'><tr><td>";
	if(mysql_num_rows($preguntas) != 0)
	{
		while($pregunta = mysql_fetch_array($preguntas))
		{
			if ($pregunta['tipoPregunta'] == '0') // VERDADERO O FALSO
			{
				$cantidadRespuestasPorPregunta[$contador] = 2;
				echo '<b>' . $contador . ' - ' . $pregunta['pregunta'] . ':   _________________________________________________________________________________________________</b><br><br>';
				
				$contador++;
			}
			else if ($pregunta['tipoPregunta'] == '1') //MULTIPLE CHOICE
			{
				$cantidadPreguntas = 0;
				echo '<b>' . $contador . ' - ' . $pregunta['pregunta'] . '</b></br>';
				echo '</br>';
				if (!empty($pregunta['resp1']))
				{
					echo '<input type="radio" value="1_' . $pregunta['idPregunta'] . '" name="MC' . $contador . '"> ' . $pregunta['resp1'] . '</br>';
					$cantidadPreguntas++;
				}
				if (!empty($pregunta['resp2']))
				{
					echo '<input type="radio" value="2_' . $pregunta['idPregunta'] . '" name="MC' . $contador . '"> ' . $pregunta['resp2'] . '</br>';
					$cantidadPreguntas++;
				}
				if (!empty($pregunta['resp3']))
				{
					echo '<input type="radio" value="3_' . $pregunta['idPregunta'] . '" name="MC' . $contador . '"> ' . $pregunta['resp3'] . '</br>';
					$cantidadPreguntas++;
				}
				if (!empty($pregunta['resp4']))
				{
					echo '<input type="radio" value="4_' . $pregunta['idPregunta'] . '" name="MC' . $contador . '"> ' . $pregunta['resp4'] . '</br>';
					$cantidadPreguntas++;
				}
				if (!empty($pregunta['resp5']))
				{
					echo '<input type="radio" value="5_' . $pregunta['idPregunta'] . '" name="MC' . $contador . '"> ' . $pregunta['resp5'] . '</br>';
					$cantidadPreguntas++;
				}
				echo '</br>';
				$cantidadRespuestasPorPregunta[$contador] = $cantidadPreguntas;
				$contador++;
			}
			else if ($pregunta['tipoPregunta'] == '2') //MULTIPLE CHOICE
			{
				echo '<b>' . $contador . ' - ' . $pregunta['pregunta'] . '</b></br>';
				echo '___________________________________________________________________________________________________________ </br></br>';
				$contador++;
			}
		}
	}
echo "</td></tr></table>";
echo "</center>"
?>