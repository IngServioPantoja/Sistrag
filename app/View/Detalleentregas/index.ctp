<div class="detalleentregas index">
	<h2><?php echo __('Detalleentregas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('entrega_id'); ?></th>
			<th><?php echo $this->Paginator->sort('personas_proyecto_id'); ?></th>
			<th><?php echo $this->Paginator->sort('estado_id'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_estado'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($detalleentregas as $detalleentrega): ?>
	<tr>
		<td><?php echo h($detalleentrega['Detalleentrega']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($detalleentrega['Entrega']['fecha_entrega'], array('controller' => 'entregas', 'action' => 'view', $detalleentrega['Entrega']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($detalleentrega['PersonasProyecto']['id'], array('controller' => 'personas_proyectos', 'action' => 'view', $detalleentrega['PersonasProyecto']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($detalleentrega['Estado']['id'], array('controller' => 'estados', 'action' => 'view', $detalleentrega['Estado']['id'])); ?>
		</td>
		<td><?php echo h($detalleentrega['Detalleentrega']['fecha_estado']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $detalleentrega['Detalleentrega']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $detalleentrega['Detalleentrega']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $detalleentrega['Detalleentrega']['id']), null, __('Are you sure you want to delete # %s?', $detalleentrega['Detalleentrega']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Detalleentrega'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Entregas'), array('controller' => 'entregas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entrega'), array('controller' => 'entregas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas Proyectos'), array('controller' => 'personas_proyectos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('controller' => 'personas_proyectos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estados'), array('controller' => 'estados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estado'), array('controller' => 'estados', 'action' => 'add')); ?> </li>
	</ul>
</div>
