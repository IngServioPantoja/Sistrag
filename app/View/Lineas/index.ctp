<div class="lineas index">
	<h2><?php echo __('Lineas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('descripcion'); ?></th>
			<th><?php echo $this->Paginator->sort('area_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($lineas as $linea): ?>
	<tr>
		<td><?php echo h($linea['Linea']['id']); ?>&nbsp;</td>
		<td><?php echo h($linea['Linea']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($linea['Linea']['descripcion']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($linea['Area']['nombre'], array('controller' => 'areas', 'action' => 'view', $linea['Area']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $linea['Linea']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $linea['Linea']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $linea['Linea']['id']), null, __('Are you sure you want to delete # %s?', $linea['Linea']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Linea'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
	</ul>
</div>
