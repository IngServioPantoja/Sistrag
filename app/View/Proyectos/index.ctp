<?php 
$user=NUll;
if(!$this->request->is('ajax'))
{
?> 	
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			
			<?php
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') 
			{
			?>
			<li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Proyectos'), array('action' => 'index')); 
				?></li><li>
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
						<div class="back">
							<?php
							echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
										array('escape' => false));
							?>

						</div>
						<?php echo $this->Form->create('Busqueda'); ?>
						<span>
							<?php
							echo $this->Html->image('iconos/consultar50.png', array('alt' => 'Login','height' => '', 'width' => '25px'));
							?>
						</span>
						<span>
							<?php
							if(isset($busqueda))
							{
								echo $this->Form->select(
								'atributo', array('id' => 'Id', 'nombre'=>'Nombre'
									),array('id'=>'atributo','autocomplete' =>'off','empty'=>false,'default'=>$busqueda[0]['atributo'])
							);	
							}
							else
							{
							?>
							<?php
							echo $this->Form->select(
								'atributo', array('id' => 'Id', 'nombre'=>'Nombre'
									),array('id'=>'atributo','autocomplete' =>'off','empty'=>false)
							);
							}
							?>
						</span>
						<span>
							<?php
							if(isset($busqueda))
							{
								echo $this->Form->input('valor',array('label'=> false,'id'=>'valor','value'=>$busqueda[0]['valor'])); 
							}
							else
							{
							echo $this->Form->input('valor',array('label'=> false,'id'=>'valor','value'=>'')); 
							}
							?>
						</span>
					<?php echo $this->Form->end(__('')); ?>
					</div>
					<div id="contenedor_datos">
						<?php
						}
						?>						
							<div class="crud_fila_secundaria">
						<?php
							if(isset($encontrado)) 
							{
							?>
								<div class="no_hay_registros">
								<span>No se encontraron registros</span>
								</div>
						<?php
							}
						?>
							<?php foreach ($proyectos as $proyecto): ?>
								<div class="div_integrantes">
									<span class="relacion_integrante">
										<?php echo h($proyecto['Programa']['nombre']); ?>
									</span>	
									<article class='ficha_index'>
											<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'){ ?>
											<div class="ficha_acciones">
												<?php 
												echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'editar_general', $proyecto['Proyecto']['id']),
										array('escape' => false));
										?>
												<?php 
												echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $proyecto['Proyecto']['id']), array('escape' => false), __('¿Esta seguro que desea borrar el proyecto: %s?', $proyecto['Proyecto']['titulo'])); 
												?>
											</div>
											<?php } ?>
											<a href="proyectos/documentos/<?php echo $proyecto['Proyecto']['id'];?>">
												<table class="informacion_proyecto">
													<th>
														<span>
															Codigo
														</span>	
													</th>
													<tr>
														<td>
															<span>
																<?php echo h($proyecto['Proyecto']['codigo']); ?>
															</span>	
														</td>
													</tr>
													<tr>
														<th colspan="2">
															<span>
																Titulo:
															</span>
														</th>
													</tr>
													<tr>
														<td colspan="2">
															<span>
																<?php echo h($proyecto['Proyecto']['titulo'])	; ?>
															</span>
														</td>
													</tr>
													<tr>
														<th colspan="2">
															<span>
																Integrantes:
															</span>
														</th>
													</tr>
														<?php
														foreach ($proyecto['Persona'] as $persona) 
														{
														if($persona['PersonasProyecto']['rol_id']==3)
															{

														?>
															<tr>
																<td colspan="2">
																	<span>
																<?php
																	echo $persona['nombre']." ".$persona['apellido'];
																?>
																	</span>
																</td>
															</tr>
														<?php
															}
														}
														?>
													<tr>
												</table>
											</a>
											<a href="proyectos/documentos/<?php echo $proyecto['Proyecto']['id'];?>">
											<div class='ficha_datos' id="datos_proyecto">
												<div colspan="2" class="proyectos_ampliar">
													v
													<div class="informacion">	
														<div>
															<span>
																<strong>Asesor:</strong>
															</span>
														</div>
														<?php
														foreach ($proyecto['Persona'] as $persona) 
														{
															if($persona['PersonasProyecto']['rol_id']==2)
															{

															?>
																
																<div>
																	<span>
																<?php
																	echo $persona['nombre']." ".$persona['apellido'];
																?>
																	</span>
																</div>
															
															<?php
															}
														}
														?>
														<div>
															<span>
																<strong>Jurados:</strong>
															</span>
														</div>
														<?php
														foreach ($proyecto['Persona'] as $persona) 
														{
														if($persona['PersonasProyecto']['rol_id']==1)
															{

														?>
															<div>
																<span>
																<?php
																	echo $persona['nombre']." ".$persona['apellido'];
																?>
																</span>
															</div>		
														<?php
															}
														}
														?>
														<div>
															<span>
																<strong>Área de ivnestigación:</strong>
															</span>
														</div>
														<span>
															<?php echo h($proyecto['Area']['nombre'])	; ?>
														</span>
														<div>
															<span>
																<strong>Línea de ivnestigación:</strong>
															</span>
														</div>
														<span>
															<?php echo h($proyecto['Linea']['nombre'])	; ?>
														</span>
													</div>
												</div>
											</div>
										</a>
									</article>
								</div>
							<?php endforeach; ?>
						</br></br></br></br>
						</div>
						<div class="crud_fila_paginacion">
						<?php
							if(isset($busqueda))
							{
								echo $this->Paginator->options(array('url' => array($busqueda[0]['atributo'],$busqueda[0]['valor'])));
							}
							echo $this->Paginator->prev('< ', array(), null, array('class' => 'prev disabled'));
							?>
							<span class="actual">
							<?php
							echo $this->Paginator-> counter(array('separator' => ' de '));
							?>
							</span>
							<?php
							echo $this->Paginator->next(__('') . ' >', array(), null, array('class' => 'next disabled'));
						?>
						</div>
<?php
if(!$this->request->is('ajax'))
{
?>						
					</div>
				</td>
			</tr>
		</table>
	</section>
</section>
<?php
$this->Js->get('#atributo')->event('change',
	$this->Js->request(
	    array(
	        'action'=>'index'
	    ),
	    array(
	        'update'=>'#contenedor_datos',
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
<?php
$this->Js->get('#valor')->event('keyup',
	$this->Js->request(
	    array(
	        'action'=>'index',
	    ),
	    array(
	        'update'=>'#contenedor_datos',
	        //'before' => "$('.frame_cargando').fadeIn();",
  	        //'complete' =>"$('.frame_cargando').fadeOut();",
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
}
?>
<script>
	$('#navicon-suitcase').css( "color", "#7a0400" );
	$('.navicon-suitcase').css( "color", "#7a0400" );
</script>