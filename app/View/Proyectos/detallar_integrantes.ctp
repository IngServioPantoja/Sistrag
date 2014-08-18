<?PHP 
$user=NUll;
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<?php

			?>
			<li>
				<span class="icon-list" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:12px;"></span>
				<?php 
				echo $this->Html->link(__('Documentos'), array('controller'=>'proyectos','action' => 'documentos',$proyecto['Proyecto']['id'])); 
				?></li>
				<?php
				if($current_user['nivel_id'] == '1' || $current_user['nivel_id'] == '2' || $current_user['nivel_id'] == '3' || $current_user['nivel_id'] == '5') 
				{
				?>
				<li>
				<span class="icon-cloudy" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Subir documento'), array('controller'=>'documentos','action' => 'subir_documento',$proyecto['Proyecto']['id'])); 
				?></li>
				<?php
				}
				if($current_user['nivel_id'] == '1' || $current_user['nivel_id'] == '2' || $current_user['nivel_id'] == '3') 
				{
				?>
				<li>
				<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Datos generales'), array('action' => 'editar_general',$proyecto['Proyecto']['id'])); 
				?></li><li class="panel_menu_actual">
				<span class="icon-group" style="color:#ddd;text-shadow:0px 0px 4px #222;"></span>
				<?php 
				echo $this->Html->link(__('Integrantes'), array('action' => 'editar_integrantes',$proyecto['Proyecto']['id']));
				?>
				</li>
				<?php
				}else
				{
				?>
				<li>
				<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Datos generales'), array('action' => 'detallar_general',$proyecto['Proyecto']['id'])); 
				?></li><li class="panel_menu_actual">
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
					<div class="crud_fila_principal">
						<span>
							<?php
								echo $proyecto['Proyecto']['titulo']
							?>			
						</span>
					</div>
					<div class="crud_fila_secundaria">
						<?php
						foreach ($proyecto['Integrantes'] as $integrante) 
						{
							if ($integrante['PersonasProyecto']['rol_id']==3)
							{
						?>
						<div class="div_integrantes">
							<span class="relacion_integrante">
								<span class="icon-graduate" id="proyectoIcono">
								</span>
								Integrantes
							</span>	
						<?php		
							break;
							}
						}
						?>
							<div class="contenedor_integrantes">
								<?php
									foreach ($proyecto['Integrantes'] as $integrante) 
									{	
										if($integrante['PersonasProyecto']['rol_id']==3)
										{
										?>
										<article class='ficha_index'>
											<a href="../../personas/view/<?php  echo $integrante['Persona']['id'];?>">
												<figure>
													<?php
													$destino = WWW_ROOT."img/img_subida/usuarios/".$integrante['Persona']['id']."".DS;
													if (file_exists($destino))
													{
														$urlImagen="img_subida/usuarios/".$integrante['Persona']['id']."/1_400.png";
													}
													else
													{
														$urlImagen="recursos/escudo400.png";
													}
													echo $this->Html->image($urlImagen, array('alt' => 'Login','height' => '200px', 'width' => '200px'));
													?>
													<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
														<div class="ficha_acciones">
													<?php 
													echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('controller'=>'personasproyectos','action' => 'delete', $integrante['PersonasProyecto']['id']), array('escape' => false,'title'=>'Eliminar integrante'), __('¿Esta seguro que desea borrar a %s?', $integrante['Persona']['nombre']." ".$integrante['Persona']['apellido']." del proyecto ".$proyecto['Proyecto']['titulo'])); 
													?>
														</div>
													<?php endif; ?>
												</figure>
											</a>
											<a href="../../personas/view/<?php  echo $integrante['Persona']['id'];?>">
												<div class='ficha_datos'>
													<table>
														<tr>
															<th colspan="2">
																<span>
																	Nombres y apellidos:
																</span>
															</th>
														</tr>
														<tr>
															<td colspan="2">
																<span>
																	<?php echo h($integrante['Persona']['nombre']." ".$integrante['Persona']['apellido']); ?>
																</span>
															</td>
														</tr>
														<tr>
															<th colspan="2">
																<span>
																	Programa:
																</span>
															</th>
														</tr>
														<tr>
															<td colspan="2">
																<span>
																	<?php echo h($integrante['Programa']['nombre']); ?>
																</span>
															</td>
														</tr>
													</table>
												</div>
											</a>
										</article>
										<?php
										}
									}
								?>
							<?php
							foreach ($proyecto['Integrantes'] as $integrante) 
							{
								if ($integrante['PersonasProyecto']['rol_id']==3)
								{
									
							?>
							</div>	
							<?php		
								break;
								}
							}
							?>
						</div>
						<?php
						foreach ($proyecto['Integrantes'] as $integrante) 
						{
							if ($integrante['PersonasProyecto']['rol_id']==2)
							{
						?>
						<div class="div_integrantes">
							<span class="relacion_integrante">
								<span class="icon-superman" id="proyectoIcono">
								</span>
								Asesor
							</span>	
						<?php		
							break;
							}
						}
						?>
									<?php
										foreach ($proyecto['Integrantes'] as $integrante) 
										{	
											if($integrante['PersonasProyecto']['rol_id']==2)
											{
											?>
											<article class='ficha_index'>
												<a href="../../personas/view/<?php  echo $integrante['Persona']['id'];?>">
													<figure>
														<?php
														$destino = WWW_ROOT."img/img_subida/usuarios/".$integrante['Persona']['id']."".DS;
														if (file_exists($destino))
														{
															$urlImagen="img_subida/usuarios/".$integrante['Persona']['id']."/1_400.png";
														}
														else
														{
															$urlImagen="recursos/escudo400.png";
														}
														echo $this->Html->image($urlImagen, array('alt' => 'Login','height' => '200px', 'width' => '200px'));
														?>
														<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
															<div class="ficha_acciones">
														<?php echo $this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')); 
														?>
														<?php 
														echo $this->Form->create('PersonasProyecto',array('controller'=>'personasproyectos','action'=>'edit/'.$integrante['PersonasProyecto']['id'],'class'=>'form_oculto_cambiar'));
														echo $this->Form->hidden('id',array('value'=>$integrante['PersonasProyecto']['id']));
														echo $this->Form->hidden('proyecto_id',array('value'=>$proyecto['Proyecto']['id']));
														echo $this->Form->hidden('persona_id',array('value'=>$integrante['Persona']['id']));
														echo $this->Form->hidden('rol_id',array('value'=>1));
														echo $this->Form->submit('',array('div'=>false,'class'=>'submit_oculto_cambiar','title'=>'Cambiar a Jurado'));
														echo $this->Form->end(__('')); 
														?>
														<?php 
															echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('controller'=>'personasproyectos','action' => 'delete', $integrante['PersonasProyecto']['id']), array('escape' => false,'title'=>'Eliminar integrante'), __('¿Esta seguro que desea borrar a %s?', $integrante['Persona']['nombre']." ".$integrante['Persona']['apellido']." del proyecto ".$proyecto['Proyecto']['titulo'])); 
														?>
															</div>
														<?php endif; ?>
													</figure>
												</a>
												<a href="../../personas/view/<?php  echo $integrante['Persona']['id'];?>">
													<div class='ficha_datos'>
														<table>
															<tr>
																<th colspan="2">
																	<span>
																		Nombres y apellidos:
																	</span>
																</th>
															</tr>
															<tr>
																<td colspan="2">
																	<span>
																		<?php echo h($integrante['Persona']['nombre']." ".$integrante['Persona']['apellido']); ?>
																	</span>
																</td>
															</tr>
															<tr>
																<th colspan="2">
																	<span>
																		<?php
																		if($integrante['Persona']['tiposusuario_id']==1)
																		{
																		?>
																		Institución:
																		<?php
																		}else if($integrante['Persona']['tiposusuario_id']==2)
																		{
																		?>
																		Facultad:
																		<?php
																		}else if($integrante['Persona']['tiposusuario_id']==3 || $integrante['Persona']['tiposusuario_id']==4 || $integrante['Persona']['tiposusuario_id']==5)
																		{
																		?>
																		Programa:
																		<?php
																		}
																		?>
																	</span>
																</th>
															</tr>
															<tr>
																<td colspan="2">
																	<span>
																		<?php
																		if($integrante['Persona']['tiposusuario_id']==1)
																		{
																		?>
																		</br>
																		<?php
																		}else if($integrante['Persona']['tiposusuario_id']==2)
																		{
																		?>
																		<?php echo h($integrante['Facultad']['nombre']); ?>
																		<?php
																		}else if($integrante['Persona']['tiposusuario_id']==3 || $integrante['Persona']['tiposusuario_id']==4 || $integrante['Persona']['tiposusuario_id']==5)
																		{
																		?>
																		<?php echo h($integrante['Programa']['nombre']); ?>
																		<?php
																		}
																		?>
																	</span>
																</td>
															</tr>
														</table>
													</div>
												</a>
											</article>
											<?php
											}
										}
									?>
						<?php
						foreach ($proyecto['Integrantes'] as $integrante) 
						{
							if ($integrante['PersonasProyecto']['rol_id']==2)
							{
								
						?>
						</div>	
						<?php		
							break;
							}
						}
						?>
						<?php
						foreach ($proyecto['Integrantes'] as $integrante) 
						{
							if ($integrante['PersonasProyecto']['rol_id']==1)
							{
						?>
						<div class="div_integrantes">
							<span class="relacion_integrante">
								<span class="icon-skeletor" id="proyectoIcono">
								</span>
								Jurados
							</span>
						<?php		
							break;
							}
						}
						?>
							<?php
									foreach ($proyecto['Integrantes'] as $integrante) 
									{	
										if($integrante['PersonasProyecto']['rol_id']==1)
										{
										?>
										<article class='ficha_index'>
											<a href="../../personas/view/<?php  echo $integrante['Persona']['id'];?>">
												<figure>
													<?php
													$destino = WWW_ROOT."img/img_subida/usuarios/".$integrante['Persona']['id']."".DS;
													if (file_exists($destino))
													{
														$urlImagen="img_subida/usuarios/".$integrante['Persona']['id']."/1_400.png";
													}
													else
													{
														$urlImagen="recursos/escudo400.png";
													}
													echo $this->Html->image($urlImagen, array('alt' => 'Login','height' => '200px', 'width' => '200px'));
													?>
													<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
														<div class="ficha_acciones">
													<?php echo $this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')); 
												?>
												<?php 
												echo $this->Form->create('PersonasProyecto',array('controller'=>'personasproyectos','action'=>'edit/'.$integrante['PersonasProyecto']['id'],'class'=>'form_oculto_cambiar'));
												echo $this->Form->hidden('id',array('value'=>$integrante['PersonasProyecto']['id']));
												echo $this->Form->hidden('proyecto_id',array('value'=>$proyecto['Proyecto']['id']));
												echo $this->Form->hidden('persona_id',array('value'=>$integrante['Persona']['id']));
												echo $this->Form->hidden('rol_id',array('value'=>2));
												echo $this->Form->submit('',array('div'=>false,'class'=>'submit_oculto_cambiar','title'=>'Cambiar a Asesor'));
												echo $this->Form->end(__('')); 
												?>
												<?php 
													echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('controller'=>'personasproyectos','action' => 'delete', $integrante['PersonasProyecto']['id']), array('escape' => false,'title'=>'Eliminar integrante'), __('¿Esta seguro que desea borrar a %s?', $integrante['Persona']['nombre']." ".$integrante['Persona']['apellido']." del proyecto ".$proyecto['Proyecto']['titulo'])); 
												?>
														</div>
													<?php endif; ?>
												</figure>
											</a>
											<a href="../../personas/view/<?php  echo $integrante['Persona']['id'];?>">
												<div class='ficha_datos'>
													<table>
														<tr>
															<th colspan="2">
																<span>
																	Nombres y apellidos:
																</span>
															</th>
														</tr>
														<tr>
															<td colspan="2">
																<span>
																	<?php echo h($integrante['Persona']['nombre']." ".$integrante['Persona']['apellido']); ?>
																</span>
															</td>
														</tr>
														<tr>
														<th colspan="2">
															<span>
																<?php
																if($integrante['Persona']['tiposusuario_id']==1)
																{
																?>
																Institución:
																<?php
																}else if($integrante['Persona']['tiposusuario_id']==2)
																{
																?>
																Facultad:
																<?php
																}else if($integrante['Persona']['tiposusuario_id']==3 || $integrante['Persona']['tiposusuario_id']==4 || $integrante['Persona']['tiposusuario_id']==5)
																{
																?>
																Programa:
																<?php
																}
																?>
															</span>
														</th>
													</tr>
													<tr>
														<td colspan="2">
															<span>
																<?php
																if($integrante['Persona']['tiposusuario_id']==1)
																{
																?>
																<?php
																}else if($integrante['Persona']['tiposusuario_id']==2)
																{
																?>
																<?php echo h($integrante['Facultad']['nombre']); ?>
																<?php
																}else if($integrante['Persona']['tiposusuario_id']==3 || $integrante['Persona']['tiposusuario_id']==4 || $integrante['Persona']['tiposusuario_id']==5)
																{
																?>
																<?php echo h($integrante['Programa']['nombre']); ?>
																<?php
																}
																?>
															</span>
														</td>
													</tr>
													</table>
												</div>
											</a>
										</article>
										<?php
										}
									}
								?>
						<?php
						foreach ($proyecto['Integrantes'] as $integrante) 
						{
							if ($integrante['PersonasProyecto']['rol_id']==1)
							{
								
						?>
						</div>	
						<?php		
							break;
							}
						}
						?>
					</div>
				</td>
			</tr>
		</table>
 	</section>
</section>
<?php
$this->Js->get('#valor')->event('keyup',
	$this->Js->request(
	    array(
	        'action'=>'lista_interventores',
	    ),
	    array(
	        'update'=>'#contenedor_interventores',
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
	$('#navicon-suitcase').css( "color", "#7a0400" );
</script>