<div class="documentos index">
	<h2><?php echo __('Documentos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_guardado'); ?></th>
			<th><?php echo $this->Paginator->sort('enlace'); ?></th>
			<th><?php echo $this->Paginator->sort('estandar_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($documentos as $documento): ?>
	<tr>
		<td><?php echo h($documento['Documento']['id']); ?>&nbsp;</td>
		<td><?php echo h($documento['Documento']['fecha_guardado']); ?>&nbsp;</td>
		<td><?php echo h($documento['Documento']['enlace']); ?>&nbsp;</td>
		<td><?php echo h($documento['Documento']['estandar_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $documento['Documento']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $documento['Documento']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $documento['Documento']['id']), null, __('Are you sure you want to delete # %s?', $documento['Documento']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Documento'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Personas Proyectos'), array('controller' => 'personas_proyectos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('controller' => 'personas_proyectos', 'action' => 'add')); ?> </li>
	</ul>
</div>