<div class="programas view">
<h2><?php  echo __('Programa '); echo 'de ',h($programa['Programa']['nombre']); ?>
	<t><?php echo  __('facultad de '); echo $this->Html->link($programa['Facultad']['nombre'], array('controller' => 'facultades', 'action' => 'view', $programa['Facultad']['id'])); ?> </t>
</h2><br/>
 <?php echo h($programa['Programa']['descripcion']); ?>
</div>
			

<?php $user=NUll;
?> 	
	<div class="actions">
		<ul>
			 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>

			<li><?php echo $this->Html->link(__('Nuevo Estandar'), array('controller' => 'estandares', 'action' => 'add')); ?> </li>
			<?php endif; ?>

		</ul>
	</div>
</div>

<table class="crud">
	<tr>
		<td>
			<div class="crud_fila_principal">

<div class="related">
	<h3><?php echo __('Estandares relacionados'); ?></h3>
		</div>	
			   </div>
	<?php if (!empty($programa['Estandar'])): ?>


<div class="crud_fila_secundaria">
				<table class="crud_fila_secundaria_contenido">
					<tr class="crud_fila_secundaria_contenido_fila_primaria">
						<th class="th_id"><?php echo __('Id'); ?></th>
						<th class="th_res"><?php echo __('Nombre'); ?></th>
						<th><?php echo __('Programa Id'); ?></th>
						<th><?php echo __('Tiposestandar Id'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>


	<?php
		$i = 0;
		foreach ($programa['Estandar'] as $estandar): ?>
		<tr>
			<td><?php echo $estandar['id']; ?></td>
			<td><?php echo $estandar['nombre']; ?></td>
			<td><?php echo $estandar['programa_id']; ?></td>
			<td><?php echo $estandar['tiposestandar_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'estandares', 'action' => 'view', $estandar['id'])); ?>
								 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>

				<?php echo $this->Html->link(__('Edit'), array('controller' => 'estandares', 'action' => 'editar_estandar', $estandar['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'estandares', 'action' => 'delete', $estandar['id']), null, __('Are you sure you want to delete # %s?', $estandar['id'])); ?>
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