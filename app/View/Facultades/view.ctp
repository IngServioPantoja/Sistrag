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


