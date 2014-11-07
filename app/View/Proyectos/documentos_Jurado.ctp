<?PHP 
$user=NUll;
$roles;
//print_r($roles);	
//Aqui tenemos que postear uales son lso documento de ese proyecto...
//ahora es necesario realizar la evaluaciónd eun documento... y ya casi temrinamos
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<?php
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') 
			{
			?>
			<li class="panel_menu_actual">
				<span class="icon-list" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:12px;"></span>
				<?php 
				echo $this->Html->link(__('Documentos'), array('controller'=>'proyectos','action' => 'documentos',$proyecto['Proyecto']['id'])); 
				?></li><li>
				<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Datos generales'), array('action' => 'detallar_general',$proyecto['Proyecto']['id'])); 
				?></li><li>
				<span class="icon-group" style="color:#ddd;text-shadow:0px 0px 4px #222;"></span>
				<?php 
				echo $this->Html->link(__('Integrantes'), array('action' => 'detallar_integrantes',$proyecto['Proyecto']['id']));
				?>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
	<section class="panel_internal">
 		<table class="crud">
			<tr>
				<td>
					<div class="crud_fila_principal" id="principal_proyecto">
						<div class="back">
							<?php
							echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
										array('escape' => false));
							?>

						</div>
						<span class="principal_titulo">
							<?php
								echo $proyecto['Proyecto']['titulo']
							?>			
						</span>
					</div>
					<div class="crud_fila_secundaria">
						
						<?php
						foreach ($documentos as $documento) 
						{
							$rolescopia=$roles;
						?>
						<div class="div_integrantes">
							<span class="relacion_integrante">
							<?php
							echo $documento['Tiposestandar']['nombre'].": ";
							echo $documento['Documento']['fecha_guardado'];
							?>	
							</span>	
							<?php
							if(isset($documento['Documento']['Entregas']))
							{
								foreach ($documento['Documento']['Entregas'] as $entrega) 
								{	
									unset($rolescopia[$entrega['rol_id']]);
									if (isset($entrega['Detalleentregas'])) 
									{
										foreach ($entrega['Detalleentregas'] as $detalleEntrega) 
										{	
						?>
											<article class='ficha_index'>
												<a href="../../documentos/evaluacion_docente/<?php echo $detalleEntrega['id'];?>">
													<table class="informacion_proyecto">
														<tr>
															<th>
																<span>
																	<?php 
																		echo $this->Html->image("iconos/calendariorojo64.png", array('height' => '', 'width' => '32px'));
																	?>
																</span>	
															</th>
															<td>
																<span>
																	<strong>
																		<?php
																			echo $entrega['fecha_entrega'];
																		?>	
																	</strong>
																</span>	
															</td>
														</tr>
														<tr>
															<th>
																
																<?php
																	if($entrega['rol_id']==1)
																	{
																?>
																<span class="icon-auction documento_iconos"></span>
																<?php
																	}else
																	{
																?>
																<span class="icon-batman documento_iconos" style="font-size:36px;"></span>
																<?php
																	}
																?>
															</th>
															<td>
																<span>
																	<strong>
																		<?php
																			echo $detalleEntrega['persona'];
																		?>
																	</strong>
																</span>	
															</td>
														</tr>
														<tr>
															<th>
																
															</th>
															<td>
																
															</td>
														</tr>
														<tr>
															<th>
																
															</th>
															<td>
																
															</td>
														</tr>
														<tr>
															<th colspan="2" 

															<?php
																	 
																	if($detalleEntrega['estado_id']==1)
																	{
																	?>
																	class="doc_index_enproceso">
																	<strong>
																	Sin ver
																	</strong>
																	<?php
																	}
																	else if($detalleEntrega['estado_id']==2)
																	{
																	?>
																	class="doc_index_enproceso">
																	<strong>
																	Visto
																	</strong>
																	<?php
																	}else if($detalleEntrega['estado_id']==3)
																	{
																	?>
																	class="doc_index_aprobado">
																	<strong>
																	Sin correciones
																	</strong>
																	<?php
																	}
																?>
															</th>
														</tr>
														<tr>
															<th colspan="2" 

																<?php
																	if($detalleEntrega['parametro_veredicto_id']==1 && $detalleEntrega['estado_id']==3)
																	{
																?>
																	class="doc_index_aprobado">
																		<strong>
																		Aprobado
																		</strong>
																<?php
																	}else if($detalleEntrega['parametro_veredicto_id']==2 && $detalleEntrega['estado_id']==3)
																	{
																?>
																	class="doc_index_enproceso">
																		<strong>
																		Aprobado con correciones
																		</strong>
																<?php
																	}else if($detalleEntrega['parametro_veredicto_id']==3 && $detalleEntrega['estado_id']==3)
																	{
																?>
																	class="doc_index_noaprobado">
																		<strong>
																		No aprobado
																		</strong>
																<?php
																	}
																?>
															</th>
														</tr>
														<tr>
															<th colspan="2" 

																<?php
																	if($detalleEntrega['correcciones']===0 && $detalleEntrega['estado_id']==3)
																	{
																?>
																	class="doc_index_aprobado">
																	<strong>
																	Sin correcciones
																	</strong>
																<?php
																	}else if($detalleEntrega['correcciones']==1 && $detalleEntrega['estado_id']==3)
																	{
																?>
																	class="doc_index_noaprobado">
																	<strong>
																	Con correcciones
																	</strong>
																<?php
																	}
																?>
															</th>
														</tr>
													</table>
												</a>
											</article>
							<?php
										}
									}
								}
							}
						?>

						</div>
						<?php
						}
						?>
					</div>
				</td>
			</tr>
		</table>
 	</section>
</section>
<script>
	$('#navicon-suitcase').css( "background", "#7a0400" );
	$('#marcicon-suitcase').css( "color", "#7a0400" );
</script>