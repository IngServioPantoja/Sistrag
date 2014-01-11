<div class="evaluaciones index">
	<h2><?php echo __('Evaluaciones'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('itemestandar_id'); ?></th>
			<th><?php echo $this->Paginator->sort('concepto_id'); ?></th>
			<th><?php echo $this->Paginator->sort('comentarios'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evaluaciones as $evaluacion): ?>
	<tr>
		<td><?php echo h($evaluacion['Evaluacion']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($evaluacion['Itemsestandar']['orden'], array('controller' => 'itemsestandares', 'action' => 'view', $evaluacion['Itemsestandar']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evaluacion['Concepto']['nombre'], array('controller' => 'conceptos', 'action' => 'view', $evaluacion['Concepto']['id'])); ?>
		</td>
		<td><?php echo h($evaluacion['Evaluacion']['comentarios']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $evaluacion['Evaluacion']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $evaluacion['Evaluacion']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $evaluacion['Evaluacion']['id']), null, __('Are you sure you want to delete # %s?', $evaluacion['Evaluacion']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Evaluacion'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Itemsestandares'), array('controller' => 'itemsestandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itemsestandar'), array('controller' => 'itemsestandares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conceptos'), array('controller' => 'conceptos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Concepto'), array('controller' => 'conceptos', 'action' => 'add')); ?> </li>
	</ul>
</div>
