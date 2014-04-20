<div class="entregas index">
	<h2><?php echo __('Entregas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_entrega'); ?></th>
			<th><?php echo $this->Paginator->sort('rol_id'); ?></th>
			<th><?php echo $this->Paginator->sort('documento_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entregas as $entrega): ?>
	<tr>
		<td><?php echo h($entrega['Entrega']['id']); ?>&nbsp;</td>
		<td><?php echo h($entrega['Entrega']['fecha_entrega']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($entrega['Rol']['nombre'], array('controller' => 'roles', 'action' => 'view', $entrega['Rol']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($entrega['Documento']['fecha_guardado'], array('controller' => 'documentos', 'action' => 'view', $entrega['Documento']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $entrega['Entrega']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $entrega['Entrega']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $entrega['Entrega']['id']), null, __('Are you sure you want to delete # %s?', $entrega['Entrega']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Entrega'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documentos'), array('controller' => 'documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documento'), array('controller' => 'documentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Detalleentregas'), array('controller' => 'detalleentregas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detalleentrega'), array('controller' => 'detalleentregas', 'action' => 'add')); ?> </li>
	</ul>
</div>
