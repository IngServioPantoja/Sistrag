<?php
//print_r($descomposiciones);
?>
<?php 
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<li>
			<?php
			echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
			?>
			<?php echo $this->Html->link(__('Documentos'), array('controller'=>'proyectos','action' => 'documentos', $proyecto['Proyecto']['id'])); ?></li><li>
			<span class="icon-cloudy" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
			<?php echo $this->Html->link(__('Subir documento'), array('action' => 'subir_documento', $proyecto['Proyecto']['id'])); 
			?></li><li class="panel_menu_actual">
			<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
			<?php echo $this->Html->link(__('Documento'), array('action' => 'detalle_entrega', $entrega['Detalleentrega']['id'])); 
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
							<?php echo $this->Form->create('Proyecto',array('controller'=>'documentos','action'=>'detalle_entrega')); ?>
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
									'documento', $documentos,array('id'=>'documento','autocomplete' =>'off','empty'=>false,'value'=>$entrega['Detalleentrega']['id'])
								);
								?>
							</div>
							<div class="unidad_integrantes" id="lista_documentos">
								<?php echo $this->Form->submit(
								    'Mostrar', 
								    array('class' => 'btn btn-default botones-acciones','div'=>false,'role'=>'button')
								); 
							    ?>
							    <a href="../comparar_documento/<?php echo $entrega['Detalleentrega']['id'];?>" class="btn btn-default botones-acciones" role="button">Comparar
							    </a>	
							</div>
							<?php 
							//tengo un problemita... con la renderización de vistas de comparar tiene que ser coerente debe ser por el ajxa...
							//aun no se aregla es eproblema debo de corregir solo la reder
							//asds
							echo $this->Form->end(__('')); ?>
						</div>
					</div>
					<div class="crud_fila_secundaria">
						<?php
						foreach ($descomposiciones as $descomposicion)
						{
							if($descomposicion['contenido']!=null)
	        				{
	        			?>
								<article class='marcoPrincipal' id="<?php echo "item".$descomposicion['item_documento_id']; ?>">
									<div class="headerVinotinto" onClick="encoger(this)" id="<?php echo $descomposicion['item_documento_id']; ?>" style="cursor:pointer;">
										<div class="tituloModulo">
											<span id="<?php echo "marcador".$descomposicion['item_documento_id']; ?>" class="marcador">v</span>
											<span>
				       						<?php
				       						echo $descomposicion['titulo'];
											?>
											</span>
										</div>
										<div class="row-fluid pull-right">
												<div class="btn-group" data-toggle="buttons" style="overflow:hidden;">
											<?php 
											if($descomposicion['id_concepto']==1)
											{
											?>
													 <label class="btn btn-success btn-xs aclarar <?php if($descomposicion['id_concepto']==1){echo 'active';}?>" idconcepto="1" onClick="actualizar_comentario(this)" idpregunta="<?php echo $descomposicion['id_comentario']; ?>">
													    <input type="radio" name="concepto" <?php if($descomposicion['id_concepto']==1){echo "checked";}?>>Aprobado
													  </label>
											<?php
											}else if($descomposicion['id_concepto']==3)
											{
											?>
													<label class="btn btn-danger btn-xs aclarar <?php if($descomposicion['id_concepto']==3){echo 'active';}?>" idconcepto="3" onClick="actualizar_comentario(this)" idpregunta="<?php echo $descomposicion['id_comentario']; ?>">
												    <input type="radio" name="concepto" <?php if($descomposicion['id_concepto']==3){echo "checked";}?>>No aprobado
												  </label>
											<?php
											}
											?>
												</div>
											</div>
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
											</div>
										</div>
										<div class="contenidoItem">
											<?php
												echo $descomposicion['comentario'];												
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
					</div>
					<div class="panel panel-default" disabled>
								<div class="panel-heading"><h3>Veredicto final</h3></div>
									<div class="panel-body">
										<?php
											echo $this->Form->create('Detalleentrega',array('id'=>'formularioDetalleentrega'));
											echo $this->Form->input('id',array('value'=>$detalleentrega['Detalleentrega']['id']));
										?>
										<div class="row pd-5 pull-left form-inline">
											<div class="btn-group" data-toggle="buttons" style="overflow:hidden; display:inline-block; vertical-align:top;" >
												<?php
												if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==1)
												{
												?>
													<label class="btn btn-success btn-md aclarar <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==1){echo 'active';}?>">
												    <input type="radio" name="data[Detalleentrega][parametro_veredicto_id]" <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==1){echo "checked";}?> value="1">Aprobado
												  </label>
												<?php
												}else if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==2)
												{
												?>
													<label class="btn btn-warning btn-md aclarar <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==2){echo 'active';}?>">
												    <input type="radio" name="data[Detalleentrega][parametro_veredicto_id]" <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==2){echo "checked";}?> value="2">Aprobado con correcciones
												  </label>
												<?php
												}else if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==3)
												{
												?>
													<label class="btn btn-danger btn-md aclarar <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==3){echo 'active';}?>">
												    <input type="radio" name="data[Detalleentrega][parametro_veredicto_id]" <?php if($detalleentrega['Detalleentrega']['parametro_veredicto_id']==3){echo "checked";}?> value="3">No aprobado
												  </label>
												<?php
												}
												?>
											</div>
										</div>
										<div class="form-group pd-5">
											<?php
												echo $this->Form->textarea('comentarios', array("label" => false,'type'=>'text',"class" => "cuestionario_titulo_input form-control use-tooltip",'data-toggle' =>'tooltip','data-placement' =>'top','title' =>'Correcciones generales del documento','value'=>$detalleentrega['Detalleentrega']['comentarios'],'disabled'=>'disabled'));
											?>
										</div>
									</div>
								</div>
					<?php
						if($proyecto['Documento']['enviado']==0)
						{
					?>
					<div class="contenedorAzul">
						<?php echo $this->Form->create('Entrega',array('controller'=>'entregas','action'=>'add')); ?>
						<?php echo $this->Form->hidden('documento_id',array('value'=>$proyecto['Documento']['id'])); ?>
						<?php echo $this->Form->hidden('proyecto_id',array('value'=>$proyecto['Proyecto']['id'])); ?>
						<?php
							echo $this->Form->select(
								'rol_id', $roles,array('id'=>'rol','autocomplete' =>'off','empty'=>false)
							);
						?>
						<?php 
						echo $this->Form->submit(
						    'Enviar', 
						    array('class' => 'submitGrisRedondoDelgado','id'=>'submitCortoRight','div'=>false)
						); 
					    ?>	
					</div>
					<?php
						}
					?>
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
							
		}
	else
		{
			$('#txt'+afectado).slideUp(1000,function()
				{
					$('#marcador'+afectado).text("-");
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