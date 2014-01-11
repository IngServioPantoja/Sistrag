<div class="itemsEstandares index">
	<h2><?php echo __('Items Estandares'); ?></h2>
	<table cellpadding="0" cellspacing="0" border="1">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('items_estandar_id'); ?></th>
			<th><?php echo $this->Paginator->sort('orden'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('estandar_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($itemsEstandares as $itemsEstandar): ?>
	<tr>
		<td><?php echo h($itemsEstandar['ItemsEstandar']['id']); ?>&nbsp;</td>
		<td>


			<?php //echo $this->Html->link($itemsEstandar['ItemsEstandar']['items_estandar_id'], array('controller' => 'items_estandares', 'action' => 'view', $itemsEstandar['ItemsEstandar']['id'])); ?>
			<?php foreach ($itemsEstandares as $itemsEstandar2): ?>
				<?php if(h($itemsEstandar['ItemsEstandar']['items_estandar_id'])==h($itemsEstandar2['ItemsEstandar']['id'])) {?>	

					<?php  echo $itemsEstandar2['Item']['nombre']; ?>

				<?php }?>


			<?php endforeach; ?>


		</td>
		<td><?php echo h($itemsEstandar['ItemsEstandar']['orden']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itemsEstandar['Item']['nombre'], array('controller' => 'items', 'action' => 'view', $itemsEstandar['Item']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($itemsEstandar['Estandar']['nombre'], array('controller' => 'estandares', 'action' => 'view', $itemsEstandar['Estandar']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itemsEstandar['ItemsEstandar']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $itemsEstandar['ItemsEstandar']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itemsEstandar['ItemsEstandar']['id']), null, __('Are you sure you want to delete # %s?', $itemsEstandar['ItemsEstandar']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Items Estandar'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items Estandares'), array('controller' => 'items_estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Estandar'), array('controller' => 'items_estandares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estandares'), array('controller' => 'estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estandar'), array('controller' => 'estandares', 'action' => 'add')); ?> </li>
	</ul>
</div>
