<?PHP 
$user=NUll;
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			
			<?php
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') 
			{
			?>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Proyectos'), array('action' => 'index')); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Registrar Proyecto'), array('action' => 'add')); 
			}
				?>
			</li>
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
						<div class="div_integrantes">
							<span class="relacion_integrante">
								<span class="icon-graduate" id="proyectoIcono">
								</span>
								Integrantes
							</span>
							<div class="contenedor_integrantes">
								<?php
									foreach ($proyecto['Integrantes'] as $integrante) 
									{	
										if($integrante['PersonasProyecto']['rol_id']==3)
										{
										?>
										<article class='ficha_index'>
											<a href="personas/view/<?php  echo $integrante['Persona']['id'];?>">
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
													<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px','title'=>'Actualizar')), array('action' => 'edit', $integrante['Persona']['id']),
													array('escape' => false,'title'=>'Actualizar')); 
													?>
													<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $integrante['Persona']['id']), array('escape' => false), __('¿Esta seguro que desea borrar el usuario %s?', $integrante['Persona']['nombre']." ".$integrante['Persona']['apellido'])); ?>
														</div>
													<?php endif; ?>
												</figure>
											</a>
											<a href="personas/view/<?php  echo $integrante['Persona']['id'];?>">
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
							</div>
						</div>
						<div class="div_integrantes">
							<span class="relacion_integrante">
								<span class="icon-superman" id="proyectoIcono">
								</span>
								Asesor
							</span>
							<?php
								foreach ($proyecto['Integrantes'] as $integrante) 
								{	
									if($integrante['PersonasProyecto']['rol_id']==2)
									{
									?>
									<article class='ficha_index'>
										<a href="personas/view/<?php  echo $integrante['Persona']['id'];?>">
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
												<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'edit', $integrante['Persona']['id']),
												array('escape' => false)); 
												?>
												<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $integrante['Persona']['id']), array('escape' => false), __('¿Esta seguro que desea borrar el usuario %s?', $integrante['Persona']['nombre']." ".$integrante['Persona']['apellido'])); ?>
													</div>
												<?php endif; ?>
											</figure>
										</a>
										<a href="personas/view/<?php  echo $integrante['Persona']['id'];?>">
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
						</div>
						<div class="div_integrantes">
							<span class="relacion_integrante">
								<span class="icon-skeletor" id="proyectoIcono">
								</span>
								Jurados
							</span>
							<?php
									foreach ($proyecto['Integrantes'] as $integrante) 
									{	
										if($integrante['PersonasProyecto']['rol_id']==1)
										{
										?>
										<article class='ficha_index'>
											<a href="personas/view/<?php  echo $integrante['Persona']['id'];?>">
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
													<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'edit', $integrante['Persona']['id']),
													array('escape' => false)); 
													?>
													<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $integrante['Persona']['id']), array('escape' => false), __('¿Esta seguro que desea borrar el usuario %s?', $integrante['Persona']['nombre']." ".$integrante['Persona']['apellido'])); ?>
														</div>
													<?php endif; ?>
												</figure>
											</a>
											<a href="personas/view/<?php  echo $integrante['Persona']['id'];?>">
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
						</div>
						<div class="div_agregar_integrantes">
							<span class="relacion_integrante">
								<span class="icon-group" id="proyectoIcono">
								</span>
								Agregar interventores
							</span>
							<?php echo $this->Form->create('Busqueda',array('class'=>'form_interventores'));?>
							<?php echo $this->Form->hidden('proyecto_id', array('value'=>$proyecto['Proyecto']['id'])); ?>

								<div class="div_buscar_interventor">
									<label  for="valor">
										<?php
										echo $this->Html->image('iconos/consultar50.png', array('alt' => 'Login','height' => '', 'width' => '20px','class'=>'icono_buscar_interventores'));
										?>
									</label>
									<?php
									echo $this->Form->select(
										'atributo', array('id' => 'Id', 'identificacion'=>'Identificación','nombre'=>'Nombre', 'apellido'=>'Apellido'
											),array('id'=>'atributo','autocomplete' =>'off','empty'=>false)
									);
									?>
								</div>
								<div class="div_buscar_interventor">
									<?php
									echo $this->Form->input('valor',array('label'=> false,'id'=>'valor','value'=>'','placeholder'=>'Valor busqueda'));
									?>
								</div>
							<?php echo $this->Form->end(__('')); ?>
							<div class="contenedor_interventores" id="contenedor_interventores">
								</br></br>s
							</div>
						</div>
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