<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<li>
			<?php
			echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
			?>
			<?php echo $this->Html->link(__('Documentos'), array('action' => 'index', $proyecto['Proyecto']['id'])); ?></li><li>
			<span class="icon-cloudy" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
			<?php echo $this->Html->link(__('Subir documento'), array('action' => 'subir_documento', $proyecto['Proyecto']['id'])); 
			?></li><li class="panel_menu_actual">
			<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
			<?php echo $this->Html->link(__('Documento'), array('action' => 'mostrar_documento', $proyecto['Documento']['id'])); 
			?>
			</li>
		</ul>
	</nav>
	<section class="panel_internal">
		<table class="crud">
			<tr>
				<td>
					<?php echo $this->Form->create('Documento',array('type' => 'file')); ?>
					<div class="crud_fila_principal">
						<div class="contenedor_integrantes">
							<div class="back">
								<?php
								echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
											array('escape' => false));
								?>
							</div>
							<span class="principal_titulo"> 
							<?php 
							echo $proyecto['TiposEstandar']['nombre'];
							?>
							<?php 
							echo $proyecto['Documento']['fecha_guardado'];
							?>
							:
							<?php 
							echo $proyecto['Proyecto']['titulo'];
							?>
							</span>
						</div>
						<div class="contenedor_integrantes">
							<div class="unidad_integrantes">
								<span class="icon-graduate icono_izquierda_pequeño">
								</span>
								<?php
								foreach ($proyecto['Integrantes'] as $integrante) 
								{
									if($integrante['PersonasProyecto']['rol_id']==3)
									{
								?>
								<span>
								<?php
										echo " *";
										echo $integrante['Persona']['nombre'];
										echo " ";
										echo $integrante['Persona']['apellido'];
								?>
								</span>
								<?php
									}
								}
								?>
							</div>
							<div class="unidad_integrantes">
								<span class="icon-batman icono_izquierda_pequeño">
								</span>
								<?php
								foreach ($proyecto['Integrantes'] as $integrante) 
								{
									if($integrante['PersonasProyecto']['rol_id']==2)
									{
										echo " *";
										echo $integrante['Persona']['nombre'];
										echo " ";
										echo $integrante['Persona']['apellido'];

									}
								}
								?>
							</div>
							<div class="unidad_integrantes">
								<span class="icon-auction icono_izquierda_pequeño">
								</span>
								<?php
								foreach ($proyecto['Integrantes'] as $integrante) 
								{
									if($integrante['PersonasProyecto']['rol_id']==1)
									{
										echo " *";
										echo $integrante['Persona']['nombre'];
										echo " ";
										echo $integrante['Persona']['apellido'];
									}
								}
								?>
							</div>
						</div>	
						<div class="contenedor_integrantes">
							<?php echo $this->Form->create('Proyecto'); ?>
							<?php echo $this->Form->input('id',array('value'=>$proyecto['Proyecto']['id'])); ?>
							<div class="unidad_integrantes">
								<?php
								echo $this->Form->select(
									'tipodocumento', $tiposestandares,array('id'=>'tiposestandares','autocomplete' =>'off','empty'=>false,'value'=>$proyecto['TiposEstandar']['id'])
								);
								?>
							</div>
							<div class="unidad_integrantes" id="lista_documentos">
								<?php
								echo $this->Form->select(
									'documento', $documentos,array('id'=>'documento','autocomplete' =>'off','empty'=>false,'value'=>$proyecto['Documento']['id'])
								);
								?>
							</div>
							<div class="unidad_integrantes" id="lista_documentos">
								<?php echo $this->Form->submit(
								    'Mostrar', 
								    array('class' => 'submitGrisRedondoDelgado' )
								); 
							    ?>	
							</div>
							<?php echo $this->Form->end(__('')); ?>
						</div>
					</div>
					<div class="crud_fila_secundaria">
						<?php
						foreach ($descomposiciones as $descomposicion)
						{
							if($descomposicion['nivel']!=1)
	        				{
	        			?>
								<article class='marcoPrincipal' id="<?php echo "item".$descomposicion['item_documento_id']; ?>">
									<div class="headerVinotinto"  id="<?php echo $descomposicion['item_documento_id']; ?>" style="cursor:pointer;">
										<div class="tituloModulo">
											<span onClick="encoger(this)" id="<?php echo $descomposicion['item_documento_id']; ?>" class="marcador">v</span>
											<span>
				       						<?php
				       						echo $descomposicion['titulo'];
											?>
											</span>
										</div>
										<?php
											echo $this->Form->create('Evaluacion');
										?>

										<div class="row-fluid pull-right">
											<div class="btn-group" data-toggle="buttons" style="overflow:hidden;">
											  <label class="btn btn-success btn-xs aclarar <?php if($descomposicion['id_concepto']==1){echo 'active';}?>" idconcepto="1" onClick="actualizar_comentario(this)" idpregunta="<?php echo $descomposicion['id_comentario']; ?>">
											    <input type="radio" name="concepto" <?php if($descomposicion['id_concepto']==1){echo "checked";}?>>Aprobado
											  </label>
											  <label class="btn btn-danger btn-xs aclarar <?php if($descomposicion['id_concepto']==3){echo 'active';}?>" idconcepto="3" onClick="actualizar_comentario(this)" idpregunta="<?php echo $descomposicion['id_comentario']; ?>">
											    <input type="radio" name="concepto" <?php if($descomposicion['id_concepto']==3){echo "checked";}?>>No aprobado
											  </label>
											</div>
										</div>

										<?php
											echo $this->Form->end();
										?>
									</div>
									<div class="marcoSecundario" id="<?php echo "contenido".$descomposicion['item_documento_id']; ?>">
										<div class="headerGris">
											<div class="tituloSubmoduloLeft">
												<div class="tituloUnidad">
													<span>
													Líneas:
													</span>
												</div>
												<div 
													<?php if($descomposicion['extencion_lineas']>=ceil($descomposicion['caracteres']/85))
													{?>class="tituloUnidad extencionAprobado" 
													<?php 
													}else{?> class="tituloUnidad extencionNoAprobado" 
													<?php 
													} ?>
													>
													<span>
													<?php echo ceil($descomposicion['caracteres']/85); ?>
													</span>
												</div>
											</div>												
											<div class="tituloSubmoduloRight">
												<div class="tituloUnidad">
													<span>
													Caracteres:
													</span>
												</div>
												<div <?php if($descomposicion['extencion_caracteres']>=$descomposicion['caracteres'])
													{?>class="tituloUnidad extencionAprobado" 
													<?php 
													}else{?> class="tituloUnidad extencionNoAprobado" 
													<?php 
													} ?>
													>
													<span>
													<?php echo $descomposicion['caracteres']; 
													?>
													</span>
												</div>
											</div>
										</div>
										<div class="contenidoItem" id="<?php echo "txt".$descomposicion['item_documento_id']; ?>">
								<?php
								if (isset($descomposicion['contenido'])) 
								{
									foreach ($descomposicion['contenido'] as $item) 
				        			{
				        				if($item['tipo']==2)
							        	{	
							    		?>
											<p class="parrafo">
										<?php
											echo $item['elementos'];
										?>
											</p>
							    		<?php
							        	}
							        	else if($item['tipo']==3)
							        	{	
							    		?>
											<p class="figura">
										<?php
											echo $item['elementos'];
										?>
											</p>
							    		<?php
							        	}
							        	else if($item['tipo']==4)
							        	{	
							    		?>
											<p class="fuente">
										<?php
											echo $item['elementos'];
										?>
											</p>
							    		<?php
							        	}
							        	else if($item['tipo']==5)
							        	{	
							    		?>
											<p class="piePagina">
										<?php
											echo $item['elementos'];
										?>
											</p>
							    		<?php
							        	}
							        	else if($item['tipo']==6)
							        	{
							        		echo $this->Html->image('/app/webroot/files/documentos/'.$item['elementos'], array('class'=>'img'));
							        	}
							        	else if($item['tipo']==7)
							        	{	
							    		?>
											<p class="tabla">
										<?php
											echo $item['elementos'];
										?>
											</p>
							    		<?php
							        	}
				        			}
				        		?>
										</div>
									</div>
									<div class="marcoDescripcion" id="<?php echo "contenido".$descomposicion['item_documento_id']; ?>">
										<div class="headerGris">
											<div class="tituloSubmoduloLeft">
												<div class="tituloUnidad">
													<span>
													Observaciones:
													</span>
												</div>
												<div style=";display:inline-block;margin:0px;vertical-align:top;" >
													<div class="progress" id="<?php echo $descomposicion['id_comentario'];?>" style="display:none; width: 250px; height:16px;">
														<div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding:0px; font-size:10px;line-height:15px;">
															Guardando
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="contenidoItem" id="<?php echo "com".$descomposicion['item_documento_id']; ?>">

											<?php
												echo $this->Form->create('Evaluacion');

											?>
											<?php
												echo $this->Form->textarea('titulo', array("label" => false,'type'=>'text',"class" => "cuestionario_titulo_input",'id' =>'titulo','value'=>$descomposicion['comentario'],'onBlur'=>'actualizar_comentario(this)','idpregunta'=>$descomposicion['id_comentario']));
											?>
											<?php
												echo $this->Form->end();
											?>
										</div>
									</div>
				        		<?php
								}
								?>
								</article>
								
						<?php
							}
						}
						?>
								
						<div class="panel panel-default">
							<div class="panel-heading"><h3>Veredicto final</h3></div>
							<div class="panel-body">
								<?php
									echo $this->Form->create('Detalleentrega',array('id'=>'formularioDetalleentrega'));
									echo $this->Form->input('id',array('value'=>$detalleentrega['Detalleentrega']['id']));
								?>
								<div class="row pd-5 pull-left form-inline">
									<div class="btn-group" data-toggle="buttons" style="overflow:hidden; display:inline-block; vertical-align:top;">
									  <label class="btn btn-success btn-md aclarar <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==1){echo 'active';}?>">
									    <input type="radio" name="data[Detalleentrega][parametro_veredicto_id]" <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==1){echo "checked";}?> value="1">Aprobado
									  </label>
									  <label class="btn btn-warning btn-md aclarar <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==2){echo 'active';}?>">
									    <input type="radio" name="data[Detalleentrega][parametro_veredicto_id]" <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==2){echo "checked";}?> value="2">Aprobado con correcciones
									  </label>
									  <label class="btn btn-danger btn-md aclarar <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==3){echo 'active';}?>">
									    <input type="radio" name="data[Detalleentrega][parametro_veredicto_id]" <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==3){echo "checked";}?> value="3">No aprobado
									  </label>
									</div>
									<div style=";display:inline-block;" >
										<div class="progress" id="barraComentarios" style="display:none; width: 250px; height:30px;">
											<div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding:8px;">
												Guardando
											</div>
										</div>
									</div>
								</div>
								<div class="form-group pd-5">
									<?php
										echo $this->Form->textarea('comentarios', array("label" => false,'type'=>'text',"class" => "cuestionario_titulo_input form-control use-tooltip",'data-toggle' =>'tooltip','data-placement' =>'top','title' =>'Correcciones generales del documento','value'=>$detalleentrega['Detalleentrega']['comentarios']));
									?>
								</div>
								<?php
									echo $this->Form->end(); 
								?>
								<?php
									echo $this->Form->create('Detalleentrega',array('action'=>'emitir_concepto','onsubmit'=>'return confirm("¿Realmente desea terminar la evaluación de este documento y emitir un concepto?");'));
									echo $this->Form->input('id',array('value'=>$detalleentrega['Detalleentrega']['id']));
									echo $this->Form->hidden('estado_id',array('value'=>3));
								?>
								<?php
									//echo $this->Form->submit(
									 //   'Enviar evaluación', 
									 //   array('class' => 'submitGrisRedondoDelgado','id'=>'submitCortoRight','div'=>false,'style'=>'float:none;margin:0 auto;')
								//	); 

									echo $this->Form->submit('Emitir concepto', array(
										'url'=>array('controller'=>'detalleentregas','action'=>'emitir_concepto'),
									    'div' => false,
									    'class'=>'submitGrisRedondoDelgado',
									    'id'=>'submitCortoRight',
									    'style'=>'float:none;margin:0 auto;'
									));
								?>


							</div>
						</div>
					</div>
					<span id="bot">
					</span>
				</td>
			</tr>
		</table>
	</section>
</section>
<div class="goTop">
	<a href="" title="Subir">
		<span class="icon-arrow-up" style="font-size:16px;">
		</span>
	</a>
	<?php
		echo $this->Form->select(
			'anclasItems', $anclasItems,array('id'=>'anclasItems','autocomplete' =>'off','empty'=>false,'title'=>'Ir a')
		);
	?>
	<a href="#bot" title="Bajar">
		<span class="icon-arrow-down" style="font-size:16px;">
		</span>
	</a>
</div>
<?php
$this->Js->get('#formularioDetalleentrega')->event('change',
	$this->Js->request(
	    array(
	        'controller'=>'detalleentregas','action' => 'edit',
	    ),
	    array(
	        'before'=>'$("#barraComentarios").fadeIn();',
		    'complete' => '$("#barraComentarios").fadeOut();',
	        'update'=>'#sss',
	        'async' => true,
	        'method' => 'post',
	        'dataExpression'=>true,
	        'data'=> $this->Js->serializeForm(array(
	            'isForm' => false,
	            'inline' => true
	        ))
	    )
	)
);
?><?php
$this->Js->get('#tiposestandares')->event('change',
	$this->Js->request(
	    array(
	        'controller'=>'documentos','action' => 'lista_documentos',
	    ),
	    array(
	        'update'=>'#lista_documentos',
	        'async' => true,
	        'method' => 'post',
	        'dataExpression'=>true,
	        'data'=> $this->Js->serializeForm(array(
	            'isForm' => false,
	            'inline' => true
	        ))
	    )
	)
);
?>
<script>

	$('.cuestionario_titulo_input').autosize();
	function actualizar_comentario(e)
	{	
		var valor=$(e).val();
		var id=$(e).attr("idpregunta");
		var id_concepto=$(e).attr("idconcepto");
		
		if (id_concepto === undefined) 
		{
			var respuesta=$.ajax
			(
				{
				  type: 'post',
		          dataType: 'json',
		          url: "<?php echo $this->Html->url(array('action' => 'actualizar_comentario')); ?>",
				  data: 'id='+id+'&titulo='+valor,
				  beforeSend: function() {
					$("#"+id).fadeIn();

				  }
				}
			);	
			}else
			{
			var respuesta=$.ajax
			(
				{
				  type: 'post',
		          dataType: 'json',
		          url: "<?php echo $this->Html->url(array('action' => 'actualizar_comentario')); ?>",
				  data: 'id='+id+'&titulo='+valor+'&concepto='+id_concepto,
				  beforeSend: function() {
					$("#"+id).fadeIn();

				  }
				}
			);
		}
		respuesta.always(function() 
		{
			$("#"+id).fadeOut();
		}
		)
	}


	function encoger(obj)
	{
		afectado=obj.id;
		var vista=$('#txt'+afectado).css( "display");
	if (vista=='none')
		{
			$('#txt'+afectado).slideDown(1000, function()
				{
					$('#marcador'+afectado).text("v");
				}
			);
			$('#com'+afectado).slideDown(1000, function()
				{
					$('#marcador'+afectado).text("v");
				}
			);
							
		}
	else
		{
			$('#txt'+afectado).slideUp(1000,function()
				{
					$('#marcador'+afectado).text("-");
				}
			);
			$('#com'+afectado).slideUp(1000, function()
				{
					$('#marcador'+afectado).text("v");
				}
			);
		}
	}
	
	$(function() 
	{
		$('#navicon-suitcase').css( "background", "#7a0400" );
		$('#marcicon-suitcase').css( "color", "#7a0400" );
		$("#anclasItems").change(function() 
			{
			window.location = "#item"+this.value;
  			}
		);
	});
</script>