<?php 
$user=NUll;
if(!$this->request->is('ajax'))
{
?> 	
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			
			<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'|| $current_user['nivel_id'] == '2'|| $current_user['nivel_id'] == '3') {
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
				</li><li>
				<span class="glyphicon icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:12px;"></span>
				<?php 
				echo $this->Html->link(__('Tipos de estandar'), array('controller'=>'tiposestandares','action' => 'add')); 
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
							Estandares
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
								'atributo', array('tiposestandar_id' => 'Tipo de estandar', 'programa_id'=>'Programa académico'
									),array('id'=>'atributo','autocomplete' =>'off','empty'=>false,'default'=>$busqueda[0]['atributo'])
							);	
							}
							else
							{
							?>
							<?php
							echo $this->Form->select(
								'atributo', array('tiposestandar_id' => 'Tipo de estandar', 'programa_id'=>'Programa académico'
									),array('id'=>'atributo','autocomplete' =>'off','empty'=>false)
							);
							}
							?>
						</span>
						<span id="valorDiv">
							<?php
							if(isset($busqueda))
							{
								echo $this->Form->select(
								'valor', array($lista
									),array('id'=>'valor','autocomplete' =>'off','empty'=>false,'value'=>$busqueda[0]['valor'])
								);
							}
							else
							{
								echo $this->Form->select(
									'valor', array($lista
										),array('id'=>'valor','autocomplete' =>'off','empty'=>false)
								);
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
						<?php
						if(isset($estandares))
						{
							$programa=NULL;
							$ultimo = end($estandares);
							foreach ($estandares as $estandar) 
							{
								if(isset($estandares))
								{
									$programaactual=$estandar['Estandar']['programa_id'];
									if($programa==$programaactual)
									{
									?>
									<article class='ficha_index'>
										<?php   if($current_user['nivel_id'] == '1'|| $current_user['nivel_id'] == '2'|| $current_user['nivel_id'] == '3'){ ?>
										<div class="ficha_acciones" id="acciones_estandar">
											<?php 
											echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'editar_estandar',$estandar['Estandar']['id']),array('escape' => false,'title'=>'Modificar Estandar'));
											?>
											<?php 
											echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete',$estandar['Estandar']['id']), array('escape' => false,'title'=>'Eliminar Estandar'), __('¿Esta seguro que desea borrar el estandar para '.$estandar['Estandar']['nombre']."?")); 
											?>
										</div>
										<?php 
										} 
										?>
										<a href="<?php echo '../../../Sistrag/estandares/view/'.$estandar['Estandar']['id'];?>">
											<span class="estandar">
												<?php
												echo $estandar['Tiposestandar']['nombre'];
												?>
											</span>	
											<table class="informacion_proyecto">
												<tr>
													<th colspan="2">
														<p class="titulo_estandar">
															<?php
															echo $estandar['Estandar']['nombre'];
															?>
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
															<?php
															echo $estandar['Estandar']['inicio vigencia'];
															?>
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
															<?php
															echo $estandar['Estandar']['fin vigencia'];
															?>
														</strong>	
													</td>
												</tr>
												<tr>
													<td colspan="2">
													</td>
												</tr>
											</table>
										</a>
										<div class="submit">
										<?php
										echo $this->Html->link(
										    'Descargar estandar',
										    array(
										        'action' => 'descargarDocumento',$estandar["Estandar"]["id"]
										        ),
										    array('class' => 'submitVinotinto','title'=>'Descargar estandar')
										);
										?>
										</div>
									</article>		
									<?php
										if($ultimo==$estandar)
										{
										?>
										</div>
										<?php
										}
										?>
										<?php
									}
									else
									{
										if($programa==NULL)
										{
									?>
											<div class="div_estandar_programa">
												<span class="programa">
													<?php
													echo $estandar['Programa']['nombre'];
													?>
												</span>	
									<?php
										}
										else
										{
											if($ultimo==$estandar)
											{
											?>
												</div>
												<div class="div_estandar_programa">
													<span class="programa">
														<?php
														echo $estandar['Programa']['nombre'];
														?>
													</span>	
											<?php
											}
											else
											{
											?>
												</div>
												<div class="div_estandar_programa">
													<span class="programa">
														<?php
														echo $estandar['Programa']['nombre'];
														?>
													</span>	
											<?php
											}
									?>
									<?php
										}
									?>
									<article class='ficha_index'>
										<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'){ ?>
										<div class="ficha_acciones" id="acciones_estandar">
											<?php 
											echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'editar_estandar',$estandar['Estandar']['id']),array('escape' => false,'title'=>'Modificar Estandar'));
											?>
											<?php 
											echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete',$estandar['Estandar']['id']), array('escape' => false,'title'=>'Eliminar Estandar'), __('¿Esta seguro que desea borrar el estandar para '.$estandar['Estandar']['nombre'])); 
											?>
										</div>
										<?php 
										} 
										?>
										<a href="<?php echo '../../../Sistrag/estandares/view/'.$estandar['Estandar']['id'];?>">
											<span class="estandar">
												<?php
												echo $estandar['Tiposestandar']['nombre'];
												?>
											</span>	
											<table class="informacion_proyecto">
												<tr>
													<th colspan="2">
														<p class="titulo_estandar">
															<?php
															echo $estandar['Estandar']['nombre'];
															?>
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
															<?php
															echo $estandar['Estandar']['inicio vigencia'];
															?>
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
															<?php
															echo $estandar['Estandar']['fin vigencia'];
															?>
														</strong>	
													</td>
												</tr>
												<tr>
													<td colspan="2">
													</td>
												</tr>
											</table>
										</a>
										<div class="submit">
										<?php
										echo $this->Html->link(
										    'Descargar estandar',
										    array(
										        'action' => 'descargarDocumento',$estandar["Estandar"]["id"]
										        ),
										    array('class' => 'submitVinotinto','title'=>'Descargar estandar')
										);
										?>
										</div>
									</article>	
										<?php
										if($ultimo==$estandar)
										{
										?>
											</div>
										<?php
										}
									}
								}
							$programa=$programaactual;
							}
						}

						?>
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
	        'action'=>'listado'
	    ),
	    array(
	        'update'=>'#valorDiv',
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
$this->Js->get('#valor')->event('change',
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
}
?>
<script>
	$('#navicon-file-settings').css( "background", "#7a0400" );
	$('#marcicon-file-settings').css( "color", "#7a0400" );
</script>