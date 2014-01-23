<?php 
$user=NUll;
if(!$this->request->is('ajax'))
{
?> 	
<section class="panel_frame">
	<nav class="panel_menu">
		<ul>
			<?php   
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'|| $current_user['nivel_id'] == '2') 
			{
			?>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Programa'), array('action' => 'view',$programa['Programa']['id'])); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Áreas asociadas'), array('action' => 'areas_asociadas',$programa['Programa']['id'])); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Agregar Área'), array('action' => 'agregar_area',$programa['Programa']['id'])); 
			}
			?>
			</li>
		</ul>
	</nav>
	<section class="panel_internal">
		<table class="crud">
			<tr>
				<td>
					<div class="crud_fila_principal">
						<?php echo $this->Form->create('Busqueda'); ?>
						<?php echo $this->Form->input('programa_id',array('type'=>'hidden','value'=>$programa['Programa']['id'])); ?>
						<span>
							<?php echo "Programa de ".$programa['Programa']['nombre']; ?>
						</span>
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
							<?php foreach ($areas as $area): ?>
								<article class='ficha_index'>
									<a href="../../areas/view/<?php  echo $area['Area']['id'];?>">
									<figure>
										<?php
										echo $this->Html->image('recursos/escudo400.png', array('alt' => 'Login','height' => '', 'width' => '200px'));
										?>
										<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
											<div class="ficha_acciones">
										<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('controller'=>'programas','action' => 'edit', $area['Area']['id']),
										array('escape' => false)); 
										?>
										<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('controller'=>'programas','action' => 'delete', $area['Area']['id']), array('escape' => false), __('¿Esta seguro que desea borrar el programa de %s?', $area['Area']['nombre'])); ?>
											</div>
										<?php endif; ?>
									</figure>
									</a>
									<a href="../../areas/view/<?php  echo $area['Area']['id'];?>">
									<div class='ficha_datos'>
										<table>
											<tr>
												<th>
													<span>
														Identificación
													</span>	
												</th>
												<td>
													<span>
														<?php echo h($area['Area']['id']); ?>
													</span>	
												</td>
											</tr>
											<tr>
												<th colspan="2">
													<span>
														Nombre
													</span>
												</th>
											</tr>
											<tr>
												<td colspan="2">
													<span>
														<?php echo h($area['Area']['nombre']); ?>
													</span>
												</td>
											</tr>
											<tr>
												<th>
													<span>Líneas de investigación</span>
												</th>
												<td>
													<span><?php echo h($area['Area']['lineas']); ?></span>
												</td>
											</tr>
										</table>
									</div>
									</a>
								</article>
							<?php endforeach; ?>
						</div>
						<div class="crud_fila_paginacion">
						<?php
							if(isset($busqueda))
							{
								echo $this->Paginator->options(array('url' => array($programa['Programa']['id'],$busqueda[0]['atributo'],$busqueda[0]['valor'])));
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
	        'controller'=>'programas','action'=>'areas_asociadas'
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
	        'controller'=>'programas','action'=>'areas_asociadas',$programa['Programa']['id']
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