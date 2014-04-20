<div class="itemsContenidos index">
	<h2><?php echo __('Items Contenidos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('texto'); ?></th>
			<th><?php echo $this->Paginator->sort('tipo'); ?></th>
			<th><?php echo $this->Paginator->sort('items_documento_id'); ?></th>
			<th><?php echo $this->Paginator->sort('orden'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($itemsContenidos as $itemsContenido): ?>
	<tr>
		<td><?php echo h($itemsContenido['ItemsContenido']['id']); ?>&nbsp;</td>
		<td><?php echo h($itemsContenido['ItemsContenido']['texto']); ?>&nbsp;</td>
		<td><?php echo h($itemsContenido['ItemsContenido']['tipo']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itemsContenido['ItemsDocumento']['id'], array('controller' => 'items_documentos', 'action' => 'view', $itemsContenido['ItemsDocumento']['id'])); ?>
		</td>
		<td><?php echo h($itemsContenido['ItemsContenido']['orden']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itemsContenido['ItemsContenido']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $itemsContenido['ItemsContenido']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itemsContenido['ItemsContenido']['id']), null, __('Are you sure you want to delete # %s?', $itemsContenido['ItemsContenido']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Items Contenido'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items Documentos'), array('controller' => 'items_documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Documento'), array('controller' => 'items_documentos', 'action' => 'add')); ?> </li>
	</ul>
</div>
