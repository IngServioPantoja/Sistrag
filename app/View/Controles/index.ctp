<div class="controles index">
	<h2><?php echo __('Controles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha'); ?></th>
			<th><?php echo $this->Paginator->sort('rol_id'); ?></th>
			<th><?php echo $this->Paginator->sort('estandar_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($controles as $control): ?>
	<tr>
		<td><?php echo h($control['Control']['id']); ?>&nbsp;</td>
		<td><?php echo h($control['Control']['fecha']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($control['Rol']['nombre'], array('controller' => 'roles', 'action' => 'view', $control['Rol']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($control['Estandar']['nombre'], array('controller' => 'estandares', 'action' => 'view', $control['Estandar']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $control['Control']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $control['Control']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $control['Control']['id']), null, __('Are you sure you want to delete # %s?', $control['Control']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Control'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estandares'), array('controller' => 'estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estandar'), array('controller' => 'estandares', 'action' => 'add')); ?> </li>
	</ul>
</div>
