<?PHP 
$user=NUll;
print_r($documentos);
$roles;
//print_r($roles);	
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
				<span class="icon-cloudy" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Subir documento'), array('controller'=>'documentos','action' => 'subir_documento',$proyecto['Proyecto']['id'])); 
				?></li><li>
				<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Datos generales'), array('action' => 'editar_general',$proyecto['Proyecto']['id'])); 
				?></li><li>
				<span class="icon-group" style="color:#ddd;text-shadow:0px 0px 4px #222;"></span>
				<?php 
				echo $this->Html->link(__('Integrantes'), array('action' => 'editar_integrantes',$proyecto['Proyecto']['id']));
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
						<span class="proxima_entrega">
							Proxima entrega: Abril 24 2014			
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
												<a href="../../documentos/detalle_entrega/<?php echo $detalleEntrega['id'];?>">
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
																	Sin ver
																	</strong>
																	<?php
																	}else if($detalleEntrega['estado_id']==3 and $detalleEntrega['correciones']==0)
																	{
																	?>
																	class="doc_index_aprobado">
																	<strong>
																	Sin correciones
																	</strong>
																	<?php
																	}else if($detalleEntrega['estado_id']==3 and $detalleEntrega['correciones']==1)
																	{
																	?>
																	class="doc_index_noaprobado">
																	<strong>
																	Con correciones
																	</strong>
																	<?php
																	}
																?>
															</th>
														</tr>
														<tr>
															<th colspan="2" 

																<?php
																	if($detalleEntrega['veredicto']==1)
																	{
																?>
																	class="doc_index_aprobado">
																	<strong>
																	Aprobado
																	</strong>
																<?php
																	}else if($detalleEntrega['veredicto']==2)
																	{
																?>
																	class="doc_index_noaprobado">
																	<strong>
																	No aprobado
																	</strong>
																<?php
																	}else if($detalleEntrega['veredicto']==0)
																	{
																?>
																	class="doc_index_enproceso">
																	<strong>
																	Presentado
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
						<?php
						if(count($rolescopia)>0)
						{
						?>
						<div class="contenedorVinotinto">
						<?php echo $this->Form->create('Entrega',array('controller'=>'entregas','action'=>'add','onSubmit'=>'return confirm("¿Realmente deseas enviar este documento?");'));?>
							<?php echo $this->Form->hidden('documento_id',array('value'=>$documento['Documento']['id'])); ?>
							<?php echo $this->Form->hidden('proyecto_id',array('value'=>$documento['Documento']['proyecto_id'])); ?>
							<?php
								echo $this->Form->select(
									'rol_id', $rolescopia,array('id'=>'rol','autocomplete' =>'off','empty'=>false,'class'=>'inputCorto left')
								);
						?>
						<?php 
							echo $this->Form->submit(
							    'Enviar documento', 
							    array('class' => 'submitGrisRedondoDelgado','id'=>'submitCortoRight','div'=>false)
							); 
					    ?>
						</div>	
						<?php
						}
						?>
						</div>
						<?php
						}
						?>
						<div class="div_integrantes">
							<span class="relacion_integrante">
								Proyecto 1
							</span>	
							<article class='ficha_index'>
								<a href="../../documentos/view/<?php echo $proyecto['Proyecto']['id'];?>">
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
														abril 10 2014
													</strong>
												</span>	
											</td>
										</tr>
										<tr>
											<th>
												<span class="icon-auction documento_iconos"></span>
											</th>
											<td>
												<span>
													<strong>
														Luis Carlos Revelo Tobar
													</strong>
												</span>	
											</td>
										</tr>
										<tr>
											<th colspan="2" class="doc_index_aprobado">
												<strong>
													Sin correccines
												</strong>
											</th>
										</tr>
										<tr>
											<th colspan="2" class="doc_index_noaprobado">
												<strong>
													No aprobado
												</strong>
											</th>
										</tr>
									</table>
								</a>
							</article>
							<article class='ficha_index'>
								<a href="../../documentos/view/<?php echo $proyecto['Proyecto']['id'];?>">
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
														abril 10 2014
													</strong>
												</span>	
											</td>
										</tr>
										<tr>
											<th>
												<span class="icon-auction documento_iconos"></span>
											</th>
											<td>
												<span>
													<strong>
														Mauricio Casanova
													</strong>
												</span>	
											</td>
										</tr>
										<tr>
											<th colspan="2" class="doc_index_noaprobado">
												<strong>
													Hay correcciones
												</strong>
											</th>
										</tr>
										<tr>
											<th colspan="2" class="doc_index_aprobado">
												<strong>
													Aprobado
												</strong>
											</th>
										</tr>
									</table>
								</a>
							</article>
							<article class='ficha_index'>
								<a href="proyectos/documentos/<?php echo $proyecto['Proyecto']['id'];?>">
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
														abril 10 2014
													</strong>
												</span>	
											</td>
										</tr>
										<tr>
											<th>
												<span class="icon-auction documento_iconos"></span>
											</th>
											<td>
												<span>
													<strong>
														Luis Carlos Revelo Tobar
													</strong>
												</span>	
											</td>
										</tr>
										<tr>
											<th colspan="2" class="doc_index_enproceso">
												<strong>
													Sin ver
												</strong>
											</th>
										</tr>
										<tr>
											<th colspan="2" class="doc_index_enproceso">
												<strong>
													Presentado
												</strong>
											</th>
										</tr>
									</table>
								</a>
							</article>
						</div>


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