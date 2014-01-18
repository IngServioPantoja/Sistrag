<div class="facultades view">
<h2><?php  echo __('Facultad '); echo 'de ',h($facultad['Facultad']['nombre']); ?>
</h2><br/>
 <?php echo h($facultad['Facultad']['Descripcion']); ?>
</div>

<?php $user=NUll;
?> 	
<br/>
	<div class="actions">
		<ul>
				 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>

			<li><?php echo $this->Html->link(__('Nuevo Programa'), array('controller' => 'programas', 'action' => 'add')); ?> </li>
								<?php endif; ?>

		</ul>
	</div>
</div>

<table class="crud">
	<tr>
		<td>
			<div class="crud_fila_principal">
			   <div class="related">
	<h3><?php echo __('Programas Relacionados'); ?></h3>
			</div>	
			   </div>
	<?php if (!empty($facultad['Programa'])): ?>

<div class="crud_fila_secundaria">
				<table class="crud_fila_secundaria_contenido">
					<tr class="crud_fila_secundaria_contenido_fila_primaria">
						<th class="th_id"><?php echo __('Id'); ?></th>
						<th class="th_res"><?php echo __('Nombre'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>


	<?php
		$i = 0;
		foreach ($facultad['Programa'] as $programa): ?>
		<tr>
			 <td><?php echo $programa['id']; ?></td>
			<td><?php echo $programa['nombre']; ?></td>
			<!-- <td><?php echo $programa['facultad_id']; ?></td>-->
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'programas', 'action' => 'view', $programa['id'])); ?>
							 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>

				<?php echo $this->Html->link(__('Edit'), array('controller' => 'programas', 'action' => 'edit', $programa['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'programas', 'action' => 'delete', $programa['id']), null, __('Are you sure you want to delete # %s?', $programa['id'])); ?>
				<?php endif; ?>

			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>



 <table>
<tr  >
<td class="crud_fila_secundaria_contenido">
  	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagina {:page} de {:pages}, observando {:current} registros de un total de {:count}')
	));
	?>	</p>
	<div class="paging">
	<?php

		echo $this->Paginator->prev('< ' . __('Anterior '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator-> counter(array('separator' => ' de un total de  '));
		echo $this->Paginator->next(__('siguiente ') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	</td></tr>

			</table>
			
			
			</div>
		</td>

	</tr>

</table>








<?php 
$user=NUll;
?> 	
<section class="panel_frame">
	<nav class="panel_menu">
		<ul>
			
				<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') {?>
			<li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Facultad'), array('action' => 'index')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Programas'), array('action' => 'add')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Agregar programa'), array('action' => 'add')); }
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
						<div class="crud_fila_secundaria">
							<a href="facultades/view/<?php  echo $facultad['Facultad']['id'];?>">
								<article class='ficha_index'>
									<figure>
										<?php
										echo $this->Html->image('recursos/escudo400.png', array('alt' => 'Login','height' => '', 'width' => '200px'));
										?>
										<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
											<div class="ficha_acciones">
										<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'edit', $facultad['Facultad']['id']),
										array('escape' => false)); 
										?>
										<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $facultad['Facultad']['id']), array('escape' => false), __('¿Esta seguro que desea borrar la facultad de %s?', $facultad['Facultad']['nombre'])); ?>
											</div>
										<?php endif; ?>
									</figure>
							</a>
							<a href="facultades/view/<?php  echo $facultad['Facultad']['id'];?>">
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
														<?php echo h($facultad['Facultad']['id']); ?>
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
														<?php echo h($facultad['Facultad']['nombre']); ?>
													</span>
												</td>
											</tr>
											<tr>
												<th>
													<span>Programas asociados</span>
												</th>
												<td>
													<span><?php echo h($facultad['Facultad']['programas']); ?></span>
												</td>
											</tr>
										</table>
									</div>
								</article>
							</a>
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
					</div>
				</td>
			</tr>
		</table>
	</section>
</section>