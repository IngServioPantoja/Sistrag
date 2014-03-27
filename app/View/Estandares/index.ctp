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
				echo $this->Html->image('iconos/listar32.png', array('title' => 'Listar Estandares','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Estandares'), array('action' => 'index')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('title' => 'Registrar Estandar','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Registrar Estandar'), array('action' => 'add')); 
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
						<span class="principal_titulo">
							<?php
							if($current_user['nivel_id']==1)
							{
							?>
							Estandares de la Institución
							<?php
							}else if ($current_user['nivel_id']==2)
							{
							?>
							Estandares de la facultad
							<?php
							}else if ($current_user['nivel_id']==3 || $current_user['nivel_id']==4 || $current_user['nivel_id']==5)
							{
							?>
							Estandares del programa
							<?php
							}
							?>
						</span>
						<label for="valor">
							<?php
							echo $this->Html->image('iconos/consultar50.png', array('alt' => 'Login','height' => '', 'width' => '25px'));
							?>
						</label>
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
								<div class="div_estandar_programa">
									<span class="programa">
										Ingeniería de Sistemas
									</span>	
									<article class='ficha_index'>
										<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'){ ?>
										<div class="ficha_acciones" id="acciones_estandar">
											<?php 
											echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'editar_general'),
									array('escape' => false,'title'=>'Modificar Estandar'));
									?>
											<?php 
											echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete'), array('escape' => false,'title'=>'Eliminar Estandar'), __('¿Esta seguro que desea borrar el proyecto: %s?')); 
											?>
										</div>
										<?php 
										} 
										?>
										<a href="estandares/view/<?php echo "1";?>">
											<span class="estandar">
												Informe final
											</span>	
											<table class="informacion_proyecto">
												<tr>
													<th colspan="2">
														<p class="titulo_estandar">
															Trabajo de grado Ingeniería de Sístemas
														</p>	
													</th>
												</tr>
												<tr class="estandar_vigencia_inicio" title="Vigencia inicio">
													<td >
														<span>
															<?php
																echo $this->Html->image("iconos/calendariogreen64.png", array('height' => '', 'width' => '32px'))
															?>
														</span>	
													</td>
													<td>
														<strong>
															10 abril 2014
														</strong>	
													</td>
												</tr>
												<tr class="estandar_vigencia_fin" title="Vigencia fin">
													<td>
														<span>
															<?php
																echo $this->Html->image("iconos/calendariorojo64.png", array('height' => '', 'width' => '32px'))
															?>
														</span>	
													</td>
													<td>
														<strong>
															20 abril 2016
														</strong>	
													</td>
												</tr>
												<tr>
													<td colspan="2">
													</td>
												</tr>
											</table>
										</a>
										<div class='ficha_datos' id="datos_proyecto">
											<div colspan="2" class="proyectos_ampliar" title="Descargar maqueta XML">
												<strong>
													Descargar Estandar
												</strong>
											</div>
										</div>
									</article>
									<article class='ficha_index'>
										<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'){ ?>
										<div class="ficha_acciones" id="acciones_estandar">
											<?php 
											echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'editar_general'),
									array('escape' => false,'title'=>'Modificar Estandar'));
									?>
											<?php 
											echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete'), array('escape' => false,'title'=>'Eliminar Estandar'), __('¿Esta seguro que desea borrar el proyecto: %s?')); 
											?>
										</div>
										<?php 
										} 
										?>
										<a href="estandares/view/<?php echo "1";?>">
											<span class="estandar">
												Proyecto
											</span>	
											<table class="informacion_proyecto">
												<tr>
													<th colspan="2">
														<p class="titulo_estandar">
															Trabajo de grado Ingeniería de Sístemas
														</p>	
													</th>
												</tr>
												<tr class="estandar_vigencia_inicio" title="Vigencia inicio">
													<td >
														<span>
															<?php
																echo $this->Html->image("iconos/calendariogreen64.png", array('height' => '', 'width' => '32px'))
															?>
														</span>	
													</td>
													<td>
														<strong>
															10 abril 2014
														</strong>	
													</td>
												</tr>
												<tr class="estandar_vigencia_fin" title="Vigencia fin">
													<td>
														<span>
															<?php
																echo $this->Html->image("iconos/calendariorojo64.png", array('height' => '', 'width' => '32px'))
															?>
														</span>	
													</td>
													<td>
														<strong>
															20 abril 2016
														</strong>	
													</td>
												</tr>
												<tr>
													<td colspan="2">
													</td>
												</tr>
											</table>
										</a>
										<div class='ficha_datos' id="datos_proyecto">
											<div class="proyectos_ampliar" title="Descargar maqueta XML">
												<strong>
													Descargar Estandar
												</strong>
											</div>
										</div>
									</article>
									<article class='ficha_index'>
										<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'){ ?>
										<div class="ficha_acciones" id="acciones_estandar">
											<?php 
											echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'editar_general'),
									array('escape' => false,'title'=>'Modificar Estandar'));
									?>
											<?php 
											echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete'), array('escape' => false,'title'=>'Eliminar Estandar'), __('¿Esta seguro que desea borrar el proyecto: %s?')); 
											?>
										</div>
										<?php 
										} 
										?>
										<a href="estandares/view/<?php echo "1";?>">
											<span class="estandar">
												Propuesta
											</span>	
											<table class="informacion_proyecto">
												<tr>
													<th colspan="2">
														<p class="titulo_estandar">
															Trabajo de grado Ingeniería de Sístemas
														</p>	
													</th>
												</tr>
												<tr class="estandar_vigencia_inicio" title="Vigencia inicio">
													<td >
														<span>
															<?php
																echo $this->Html->image("iconos/calendariogreen64.png", array('height' => '', 'width' => '32px'))
															?>
														</span>	
													</td>
													<td>
														<strong>
															10 abril 2014
														</strong>	
													</td>
												</tr>
												<tr class="estandar_vigencia_fin" title="Vigencia fin">
													<td>
														<span>
															<?php
																echo $this->Html->image("iconos/calendariorojo64.png", array('height' => '', 'width' => '32px'))
															?>
														</span>	
													</td>
													<td>
														<strong>
															20 abril 2016
														</strong>	
													</td>
												</tr>
												<tr>
													<td colspan="2">
													</td>
												</tr>
											</table>
										</a>
										<div class='ficha_datos' id="datos_proyecto">
											<div colspan="2" class="proyectos_ampliar" title="Descargar maqueta XML">
												<strong>
													Descargar Estandar
												</strong>
											</div>
										</div>
									</article>
								</div>
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
	$('#navicon-file-settings').css( "background", "#7a0400" );
	$('#marcicon-file-settings').css( "color", "#7a0400" );
</script>