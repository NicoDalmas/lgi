<?php require_once("basics/session.php"); ?>
<?php
	if(isset($_SESSION["username"]))
	{
		if($_SESSION["usuario_permiso"] == 1)
		{
			header("Location: alumno.php");
			exit();
		}
		elseif($_SESSION["usuario_permiso"] == 2)
		{
			header("Location: clientes_pagos.php");
			exit();
		}
	}
	else
	{
		header("Location: home.php");
		exit();
	}
?>
<?php include("basics/functions.php") ?>	



	<?php include("basics/header.php") ?>
	<script>
	function validar()
	{
		pregunta=document.frmCrearPregunta.pregunta.value
		if (pregunta.length<=5)
		{
			alert("El nombre la pregunta debe contener un mínimo de 6 caracteres.")
			document.frmCrearPregunta.pregunta.focus()
			return false
		}
	}
	function modificarCamposParaAgregar()
	{
		var respuesta1 = document.frmCrearPregunta.respuesta1;
		var respuesta2 = document.frmCrearPregunta.respuesta2;
		var respuesta3 = document.frmCrearPregunta.respuesta3;
		var respuesta4 = document.frmCrearPregunta.respuesta4;
		var respuesta5 = document.frmCrearPregunta.respuesta5;
		var respPregunta = document.frmCrearPregunta.respPregunta;
		if (document.frmCrearPregunta.tipoPregunta.value == 0) // VERDADERO O FALSO
		{
			respuesta1.value = "Verdadero";
			respuesta1.readOnly = true;
			respuesta2.value = "Falso";
			respuesta2.readOnly = true;
			respuesta3.value = "";
			respuesta3.readOnly = true;
			respuesta4.value = '';
			respuesta4.readOnly = true;
			respuesta5.value = '';
			respuesta5.readOnly = true;
			document.frmCrearPregunta.respPregunta.style.visibility = "visible";
			var respPregunta = document.frmCrearPregunta.respPregunta;
			respPregunta.remove(2);
			respPregunta.remove(2);
			respPregunta.remove(2);
		}
		else if (document.frmCrearPregunta.tipoPregunta.value == 1) // MULTIPLE CHOICE
		{
			respuesta1.value = "";
			respuesta1.readOnly = false;
			respuesta2.value = "";
			respuesta2.readOnly = false;
			respuesta3.value = "";
			respuesta3.readOnly = false;
			respuesta4.value = '';
			respuesta4.readOnly = false;
			respuesta5.value = '';
			respuesta5.readOnly = false;
			document.frmCrearPregunta.respPregunta.style.visibility = "visible";
			var tipoPregunta = document.frmCrearPregunta.tipoPregunta;
			respPregunta.remove(0);
			respPregunta.remove(0);
			respPregunta.remove(0);
			respPregunta.remove(0);
			respPregunta.remove(0);
			for (var i = 1; i<=5; i++)
			{
				var opt = document.createElement('option');
				opt.value = i;
				opt.innerHTML = i;
				document.frmCrearPregunta.respPregunta.appendChild(opt);
			}
		}
		else // LIBRE
		{
			respuesta1.value = "";
			respuesta1.readOnly = true;
			respuesta2.value = "";
			respuesta2.readOnly = true;
			respuesta3.value = "";
			respuesta3.readOnly = true;
			respuesta4.value = '';
			respuesta4.readOnly = true;
			respuesta5.value = '';
			respuesta5.readOnly = true;
			document.frmCrearPregunta.respPregunta.style.visibility = "hidden";
			document.frmCrearPregunta.respPregunta.value = NULL;
		}
	}
	function modificarCamposParaEditar()
	{
		var respuesta1 = document.frmEditarPregunta.respuesta1;
		var respuesta2 = document.frmEditarPregunta.respuesta2;
		var respuesta3 = document.frmEditarPregunta.respuesta3;
		var respuesta4 = document.frmEditarPregunta.respuesta4;
		var respuesta5 = document.frmEditarPregunta.respuesta5;
		var respPregunta = document.frmEditarPregunta.respPregunta;
		if (document.frmEditarPregunta.tipoPregunta.value == 0) // VERDADERO O FALSO
		{
			respuesta1.value = "Verdadero";
			respuesta2.value = "Falso";
			respuesta3.value = "";
			respuesta4.value = '';
			respuesta5.value = '';
		}
		else if (document.frmEditarPregunta.tipoPregunta.value == 1) // MULTIPLE CHOICE
		{
			respuesta1.value = "";
			respuesta2.value = "";
			respuesta3.value = "";
			respuesta4.value = '';
			respuesta5.value = '';
		}
		else if (document.frmEditarPregunta.tipoPregunta.value == 2)// LIBRE
		{
			respuesta1.value = "";
			respuesta2.value = "";
			respuesta3.value = "";
			respuesta4.value = '';
			respuesta5.value = '';
		}
		changeReadOnly(document.frmEditarPregunta.tipoPregunta.value != 1)
		changeRespPregunta(document.frmEditarPregunta.tipoPregunta.value)
	}
	function changeReadOnly(nombre)
	{
		var respuesta1 = document.frmEditarPregunta.respuesta1;
		var respuesta2 = document.frmEditarPregunta.respuesta2;
		var respuesta3 = document.frmEditarPregunta.respuesta3;
		var respuesta4 = document.frmEditarPregunta.respuesta4;
		var respuesta5 = document.frmEditarPregunta.respuesta5;
		respuesta1.readOnly = nombre;
		respuesta2.readOnly = nombre;
		respuesta3.readOnly = nombre;
		respuesta4.readOnly = nombre;
		respuesta5.readOnly = nombre;	
	}
	function changeRespPregunta(nombre)
	{
		var respPregunta = document.frmEditarPregunta.respPregunta;
		if (nombre == 0)
		{
			respPregunta.style.visibility = "visible";
			respPregunta.remove(2);
			respPregunta.remove(2);
			respPregunta.remove(2);
		}
		else if (nombre == 1)
		{
			respPregunta.style.visibility = "visible";
			respPregunta.remove(0);
			respPregunta.remove(0);
			respPregunta.remove(0);
			respPregunta.remove(0);
			respPregunta.remove(0);
			for (var i = 1; i<=5; i++)
			{
				var opt = document.createElement('option');
				opt.value = i;
				opt.innerHTML = i;
				respPregunta.appendChild(opt);
			}
		}
		else if (nombre == 2)
		{
			respPregunta.style.visibility = "hidden";
			respPregunta.value = null;
		}
	}
	</script>

<body>
	<?php include("basics/menu_admin.php") ?>				
				
	<!--///////////////////////////////////////////////////////////////// PARTE PARA MOSTRAR EXAMENES, DONDE LUEGO DE PONER EDITAR SE MOSTRARAN SUS PREGUTNAS CORRESPONDIENTES//////////////////////////////////////////-->
				<br>
				<center><h2><b>Editar Exámenes</b></h2></center>
				<?php
				if(!isset($_REQUEST['editarExamen']) && !isset($_REQUEST['agregarPregunta']) && !isset($_REQUEST['editarPregunta'])) 
				{ ?>
				<center>
					<div class="table-responsive">
					<table class="table table-striped" id="tblModificarEvaluaciones">
						<tr>
							<th>Id Examen</th>
							<th>Nombre</th>
							<th>Descripcion</th>
							<th>Materia</th>
							<th>Tiempo</th>
							<th>Activo</th>
							<th>Desactivar</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
						<?php
							$examenes=l_examenes();
							while($examen = mysql_fetch_array($examenes))
							{	
								echo "<tr>";
								echo      "<td>" . $examen['id'] . "</td>" .
										  "<td>" . $examen['nombre'] . "</td>" .
										  "<td>" . $examen['descripcion'] . "</td>" .
										  "<td>" . $examen['materia'] . "</td>" .
										  "<td>" . $examen['tiempo'] . "</td>" .
										  "<td>"; if($examen['activo'] == 1) { echo 'Si';} else { echo 'No'; } echo "</td>" .
										  "<td>"; if($examen['activo'] == 1) { echo "<a href='?desactivarExamen=" . $examen['id'] . "'> <button type='button' class='btn btn-danger'>
	    <span class='glyphicon glyphicon-remove'></span>    </button> </a>"; } else { echo "<a href='?activarExamen=" . $examen['id'] . "'>Activar</a>"; } echo "</td>" .
										  "<td><a href='?editarExamen=" . $examen['id'] . "'> <button type='button' class='btn btn-warning'>
	    <span class='glyphicon glyphicon-edit'></span>    </button> </a></td>" .
										  "<td><a href='?eliminarExamen=" . $examen['id'] . "'> <button type='button' class='btn btn-danger'>
	    <span class='glyphicon glyphicon-trash'></span>    </button> </a></td>";
								echo "</tr>";
							}
						?>
					</table>
				</div>
					</br>
				</center>
				<?php
				}
				else
				{
				?>
	<!-- //////////////////////////////////////////////PARTE PARA MOSTRAR LAS PREGUNTAS DE LA BASE DE DATOS CORRESPONDIENTE A CADA EXAMEN//////////////////////////////////////////////////////-->
	<div class="table-responsive">
					<table class="table table-striped" id="tblModificarEvaluaciones">
						<tr>
							<td>Id Pregunta</td>
							<td>Pregunta</td>
							<td>Respuesta Correcta</td>
							<td>Tipo Pregunta</td>
							<td>Editar</td>
							<td>Eliminar</td>
						</tr>
						<?php
						if(isset($_REQUEST['editarExamen']))
						{
							$_SESSION['id_Examen'] = $_REQUEST['editarExamen'];
							$preguntas = l_preguntas_examen($_REQUEST['editarExamen']);
						}
						elseif(isset($_REQUEST['agregarPregunta'])) 
						{
							$preguntas = l_preguntas_examen($_REQUEST['agregarPregunta']);
						}
						elseif(isset($_REQUEST['editarPregunta'])) 
						{
							$preguntas = l_preguntas_preguntas($_REQUEST['editarPregunta']);
						}
						
						while($pregunta = mysql_fetch_array($preguntas))
						{	
							$tipoPregunta = '';
							if($pregunta['tipoPregunta'] == 0)
							{
								$tipoPregunta = 'V o F';
							}
							elseif($pregunta['tipoPregunta'] == 1)
							{
								$tipoPregunta = 'Multiple Choice';
							}
							elseif($pregunta['tipoPregunta'] == 2)
							{
								$tipoPregunta = 'Libre';
							}
							
							$respuestaCorrecta = '';
							if($pregunta['respcorrecta'] == 1)
							{
								$respuestaCorrecta = $pregunta['resp1'];
							}	
							elseif($pregunta['respcorrecta'] == 2)
							{
								$respuestaCorrecta = $pregunta['resp2'];
							}
							elseif($pregunta['respcorrecta'] == 3)
							{
								$respuestaCorrecta = $pregunta['resp3'];
							}
							elseif($pregunta['respcorrecta'] == 4)
							{
								$respuestaCorrecta = $pregunta['resp4'];
							}
							elseif($pregunta['respcorrecta'] == 5)
							{
								$respuestaCorrecta = $pregunta['resp5'];
							}
							echo "<tr>";
							echo      "<td>" . $pregunta['idPregunta'] . "</td>" .
									  "<td>" . $pregunta['pregunta'] . "</td>" .
									  "<td>" . $respuestaCorrecta . "</td>" .
									  "<td>" . $tipoPregunta . "</td>" .
									  "<td><a href='?editarPregunta=" . $pregunta['idPregunta'] . "'>Editar</a></td>" .
									  "<td><a href='?eliminarPregunta=" . $pregunta['idPregunta'] . "'>Eliminar</a></td>";
							echo "</tr>";
						}
						?>
					</table>
				</div>
					</br>
				<?php
					echo "<center><a href='?agregarPregunta=" . $_SESSION['id_Examen'] . "'>Agregar Pregunta</a></center>";
					echo "</br></br>";
					
	////////////////////////////////////////////////////////////ACA SE AGREGAN LAS PREGUNTAS ////////////////////////////////////////////////////////////////////////////////////////////////				
					
					if (isset($_REQUEST['agregarPregunta'])) 
					{
						$id_examen=$_SESSION['id_Examen'];
						echo "<form name='frmCrearPregunta' onsubmit='return validar()' action='admin_editarEvaluaciones.php?editarExamen=".$id_examen."' method='post' >";
						?>
							<p>
								<b>Pregunta: </b>
								<input type="text" name="pregunta" style="width:500px;" maxlength="150">
							</p>
							<p>
								<b>Tipo de Pregunta: </b>
								<select name="tipoPregunta" style="width:150px;" onchange="modificarCamposParaAgregar()">
									<option value="1">Multiple Choice</option>
									<option value="0">Verdadero o Falso</option>
									<?php
										$tipoDeExamen = buscarTipoExamen($_SESSION['id_Examen']);
										if($tipoDeExamen['tipoDeExamen'] == "Offline")
										{
											echo '<option value="2">Libre</option>';
										}
									?>
								</select>
							</p>
							<p>
								<b>Respuesta 1: </b>
								<input type="text" name="respuesta1" style="width:480px;" maxlength="150">
							</p>
							<p>
								<b>Respuesta 2: </b>
								<input type="text" name="respuesta2" style="width:480px;" maxlength="150">
							</p>
							<p>
								<b>Respuesta 3: </b>
								<input type="text" name="respuesta3" style="width:480px;" maxlength="150">
							</p>
							<p>
								<b>Respuesta 4: </b>
								<input type="text" name="respuesta4" style="width:480px;" maxlength="150">
							</p>
							<p>
								<b>Respuesta 5: </b>
								<input type="text" name="respuesta5" style="width:480px;" maxlength="150">
							</p>
							<p>
								<b>Respuesta Correcta: </b>
								<select name="respPregunta" style="width:50px;">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</p>
							
							<?php 	echo "<input type='hidden' name='id' value='".$id_examen."'>"; ?>
							<input type="submit" name="crear" value="Agregar">
						</form>
						</br>
					<?php
					} 
		//////////////////////////////////////////////////////////////////////////////////////////ACA SE EDITAN LAS PREGUNTAS SEGUN CORRESPONDAN A CADA EXAMEN/////////////////////////////////////////////////////////			
					if (isset($_REQUEST['editarPregunta'])) 
					{
						$gato = l_preguntas_preguntas($_REQUEST['editarPregunta']);
						$editarPreguntas=mysql_fetch_array($gato) ;
						$id_pregunta=$editarPreguntas['idPregunta'];
						$id_examen=$_SESSION['id_Examen'];
					?>
						<form name='frmEditarPregunta' onsubmit='return validar()' action='admin_editarEvaluaciones.php?editarExamen=<?php echo $id_examen;?>' method='post' >
								<p>
									<b>Pregunta: </b>
									<input type='text' name='pregunta' style='width:500px;' maxlength='150' value="<?php echo $editarPreguntas['pregunta'];?>">
								</p>
								<p>
									<b>Tipo de Pregunta: </b>
									<select name="tipoPregunta" style="width:150px;" onchange="modificarCamposParaEditar()" >
										<option value="1" <?php if ($editarPreguntas['tipoPregunta'] == '1') { echo 'selected'; }?>>Multiple Choice</option> 
										<option value="0" <?php if ($editarPreguntas['tipoPregunta'] == '0') { echo 'selected'; }?>>Verdadero o Falso</option>
										<?php
											$tipoDeExamen = buscarTipoExamen($_SESSION['id_Examen']);
											if($tipoDeExamen['tipoDeExamen'] == "Offline")
											{
												$selected = '';
												if ($editarPreguntas['tipoPregunta'] == '2') 
												{ 
													$selected = 'selected'; 
												}
												echo '<option value="2"' . $selected . '>Libre</option>';
											}
										?>
									</select>
								</p>
								<p>
									<b>Respuesta 1: </b>
									<input type='text' name='respuesta1' style='width:480px;' maxlength='150' value="<?php echo $editarPreguntas['resp1'];?>">
								</p>
								<p>
									<b>Respuesta 2: </b>
									<input type='text' name='respuesta2' style='width:480px;' maxlength='150' value="<?php echo $editarPreguntas['resp2'];?>">
								</p>
								<p>
									<b>Respuesta 3: </b>
									<input type='text' name='respuesta3' style='width:480px;' maxlength='150' value="<?php echo $editarPreguntas['resp3'];?>">
								</p>
								<p>
									<b>Respuesta 4: </b>
									<input type='text' name='respuesta4' style='width:480px;' maxlength='150' value="<?php echo $editarPreguntas['resp4'];?>">
								</p>
								<p>
									<b>Respuesta 5: </b>
									<input type='text' name='respuesta5' style='width:480px;' maxlength='150' value="<?php echo $editarPreguntas['resp5'];?>">
								</p>
								<p>
									<b>Respuesta Correcta: </b>
									<select name='respPregunta' style='width:50px;'>
										<option value='1' <?php if ($editarPreguntas['respcorrecta'] == '1') { echo 'selected'; }?>>1</option>
										<option value='2' <?php if ($editarPreguntas['respcorrecta'] == '2') { echo 'selected'; }?>>2</option>
										<option value='3' <?php if ($editarPreguntas['respcorrecta'] == '3' && $editarPreguntas['tipoPregunta'] == '1') { echo 'selected'; }?>>3</option>
										<option value='4' <?php if ($editarPreguntas['respcorrecta'] == '4' && $editarPreguntas['tipoPregunta'] == '1') { echo 'selected'; }?>>4</option>
										<option value='5' <?php if ($editarPreguntas['respcorrecta'] == '5' && $editarPreguntas['tipoPregunta'] == '1') { echo 'selected'; }?>>5</option>
									</select>
								</p>
							<input type='hidden' name='idPregunta' value="<?php echo $id_pregunta;?>">
							<input type="submit" name="editar" value="Editar">
							<script>
								changeReadOnly(<?php if ($editarPreguntas['tipoPregunta'] != '1') { echo true;} else { echo false;} ?>)
								changeRespPregunta(<?php echo $editarPreguntas['tipoPregunta'];?>)
							</script>
						</form>
						</br>
					<?php
					} 	
				}
				?>
	<!-- /////////////////////////////////////////////////////////////ACA SE ELIMINAN EXAMENES O PREGUNTAS SEGUN CORRESPONDE-->
				<?php
					if (isset($_REQUEST['activarExamen'])) 
					{
						activarExamen($_REQUEST['activarExamen']);
						echo "<script language='javascript'>window.location='admin_editarEvaluaciones.php'</script>";
					}
				?>
				<?php
					if (isset($_REQUEST['desactivarExamen'])) 
					{
						desactivarExamen($_REQUEST['desactivarExamen']);
						echo "<script language='javascript'>window.location='admin_editarEvaluaciones.php'</script>";
					}
				?>
				<?php
					if (isset($_REQUEST['eliminarPregunta'])) 
					{
						eliminarPregunta($_REQUEST['eliminarPregunta']);
						header("Location: admin_editarEvaluaciones.php?editarExamen=".$_SESSION['id_Examen']."");
						echo "<script language='javascript'>window.location='admin_editarEvaluaciones.php?editarExamen=".$_SESSION['id_Examen']."'</script>";
					}
				?>
				<?php
					if (isset($_REQUEST['eliminarExamen'])) 
					{
						$id_examen=$_SESSION['id_Examen'];
						eliminarExamen($_REQUEST['eliminarExamen']);
						echo "<script language='javascript'>window.location='admin_editarEvaluaciones.php'</script>";
					}
				?>
				<!-- //////////////////////////////PROCESAMIENTO DE DATOS PARA AGREGAR PREGUNTA/////////////////////////////-->
				<?php 
					if(isset($_POST['crear']))
					{
						$cuenta=0;
						$cuenta2=0;
						$id=$_POST["id"];
						$pregunta=$_POST["pregunta"];
						$tipoPregunta=$_POST["tipoPregunta"];
						$respuesta1=$_POST["respuesta1"];
						$respuesta2=$_POST["respuesta2"];
						$respuesta3=$_POST["respuesta3"];
						$respuesta4=$_POST["respuesta4"];
						$respuesta5=$_POST["respuesta5"];
						$respPregunta=$_POST["respPregunta"];	
						if (empty($respuesta1)) 
						{
							if ($respPregunta == 1){
							$cuenta++;
							}
							$cuenta2++;
						}
						if (empty($respuesta2)) 
						{
							if ($respPregunta == 2){
							$cuenta++;
							}
							$cuenta2++;
						}
						if (empty($respuesta3)) 
						{
							if ($respPregunta == 3){
							$cuenta++;
							}
							$cuenta2++;
						}
						if (empty($respuesta4)) 
						{
							if ($respPregunta == 4){
							$cuenta++;
							}
							$cuenta2++;
						}
						if (empty($respuesta5)) 
						{	
							if ($respPregunta == 5){
							$cuenta++;
							}
							$cuenta2++;
						}
						if ($tipoPregunta != 2)
						{
							if ($cuenta2 <= 3)
							{
								if ($cuenta == 1)
								{
									for ( $i=1 ; $i<=5 ; $i++ )
									{
										if ($respPregunta == $i )
										{
										echo "<script language='javascript'> alert('El campo con la respuesta esta vacio, vuelva a intentarlo.'); </script>)";
										}	
									}
				
								}
								else
								{
									agregarPregunta($pregunta,$tipoPregunta,$respuesta1,$respuesta2,$respuesta3,$respuesta4,$respuesta5,$respPregunta,$id);
									echo "<script language='javascript'>window.location='admin_editarEvaluaciones.php?editarExamen=".$_SESSION['id_Examen']."'</script>";
									header("Location: admin_editarEvaluaciones?agregarPregunta=" . $_SESSION['id_Examen'] . ".php");
								}
							}
							else 
							{
								echo "<script language='javascript'> alert('Ingrese al menos 2 respuestas.'); </script>";
							}
						}
						else
						{
							agregarPregunta($pregunta,$tipoPregunta,$respuesta1,$respuesta2,$respuesta3,$respuesta4,$respuesta5,$respPregunta,$id);
							header("Location: admin_editarEvaluaciones?agregarPregunta=" . $_SESSION['id_Examen'] . ".php");
						}
					}
					if(isset($_POST['editar']))
					{
						$cuenta=0;
						$cuenta2=0;
						$idPreg=$_POST["idPregunta"];
						$pregunta=$_POST["pregunta"];
						$tipoPregunta=$_POST["tipoPregunta"];
						$respuesta1=$_POST["respuesta1"];
						$respuesta2=$_POST["respuesta2"];
						$respuesta3=$_POST["respuesta3"];
						$respuesta4=$_POST["respuesta4"];
						$respuesta5=$_POST["respuesta5"];
						$respPregunta=$_POST["respPregunta"];	
						if (empty($respuesta1)) 
						{
							if ($respPregunta == 1){
							$cuenta++;
							}
							$cuenta2++;
						}
						if (empty($respuesta2)) 
						{
							if ($respPregunta == 2){
							$cuenta++;
							}
							$cuenta2++;
						}
						if (empty($respuesta3)) 
						{
							if ($respPregunta == 3){
							$cuenta++;
							}
							$cuenta2++;
						}
						if (empty($respuesta4)) 
						{
							if ($respPregunta == 4){
							$cuenta++;
							}
							$cuenta2++;
						}
						if (empty($respuesta5)) 
						{	
							if ($respPregunta == 5){
							$cuenta++;
							}
							$cuenta2++;
						}
						if ($tipoPregunta != 2)
						{
							if ($cuenta2 <= 3)
							{
								if ($cuenta == 1)
								{
									for ( $i=1 ; $i<=5 ; $i++ )
									{
										if ($respPregunta == $i )
										{
											echo "<script language='javascript'> alert('El campo con la respuesta esta vacio, vuelva a intentarlo.'); </script>)";		
										}	
									}
				
								}
								else
								{
									editarPregunta($pregunta,$tipoPregunta,$respuesta1,$respuesta2,$respuesta3,$respuesta4,$respuesta5,$respPregunta,$idPreg);
									echo "<script language='javascript'> alert('El campo con la respuesta esta vacio, vuelva a intentarlo.'); </script>)";
									header("Location: admin_editarEvaluaciones?editarPregunta=" . $_SESSION['id_Examen'] . ".php");
								}
							}
							else 
							{
								echo "<script language='javascript'> alert('Ingrese al menos 2 respuestas.'); </script>";
							}
						}
						else
						{
							editarPregunta($pregunta,$tipoPregunta,$respuesta1,$respuesta2,$respuesta3,$respuesta4,$respuesta5,$respPregunta,$idPreg);
							header("Location: admin_editarEvaluaciones?editarPregunta=" . $_SESSION['id_Examen'] . ".php");
						}
					}
				?>	
			</div>
		</div>
<?php include("basics/footer.php"); ?>