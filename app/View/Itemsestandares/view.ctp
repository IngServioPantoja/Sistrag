<div class="itemsEstandares view">
<h2><?php  echo __('Items Estandar'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemsEstandar['ItemsEstandar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Items Estandar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemsEstandar['ItemsEstandar']['id'], array('controller' => 'items_estandares', 'action' => 'view', $itemsEstandar['ItemsEstandar']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orden'); ?></dt>
		<dd>
			<?php echo h($itemsEstandar['ItemsEstandar']['orden']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemsEstandar['Item']['nombre'], array('controller' => 'items', 'action' => 'view', $itemsEstandar['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estandar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemsEstandar['Estandar']['nombre'], array('controller' => 'estandares', 'action' => 'view', $itemsEstandar['Estandar']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Items Estandar'), array('action' => 'edit', $itemsEstandar['ItemsEstandar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Items Estandar'), array('action' => 'delete', $itemsEstandar['ItemsEstandar']['id']), null, __('Are you sure you want to delete # %s?', $itemsEstandar['ItemsEstandar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Items Estandares'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Estandar'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items Estandares'), array('controller' => 'items_estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Estandar'), array('controller' => 'items_estandares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estandares'), array('controller' => 'estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estandar'), array('controller' => 'estandares', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Items Estandares'); ?></h3>
	<?php if (!empty($itemsEstandar['ItemsEstandar'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Items Estandar Id'); ?></th>
		<th><?php echo __('Orden'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Estandar Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($itemsEstandar['ItemsEstandar'] as $itemsEstandar): ?>
		<tr>
			<td><?php echo $itemsEstandar['id']; ?></td>
			<td><?php echo $itemsEstandar['items_estandar_id']; ?></td>
			<td><?php echo $itemsEstandar['orden']; ?></td>
			<td><?php echo $itemsEstandar['item_id']; ?></td>
			<td><?php echo $itemsEstandar['estandar_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'items_estandares', 'action' => 'view', $itemsEstandar['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'items_estandares', 'action' => 'edit', $itemsEstandar['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'items_estandares', 'action' => 'delete', $itemsEstandar['id']), null, __('Are you sure you want to delete # %s?', $itemsEstandar['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Items Estandar'), array('controller' => 'items_estandares', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
