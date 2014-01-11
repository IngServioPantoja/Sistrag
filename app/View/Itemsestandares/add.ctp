<div class="itemsEstandares form">
<?php echo $this->Form->create('ItemsEstandar'); ?>
	<fieldset>
		<legend><?php echo __('Add Items Estandar'); ?></legend>
	<?php
		echo $this->Form->input('items_estandar_id');
		echo $this->Form->input('orden');
		echo $this->Form->input('item_id');
		echo $this->Form->input('estandar_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items Estandares'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Items Estandares'), array('controller' => 'items_estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Estandar'), array('controller' => 'items_estandares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estandares'), array('controller' => 'estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estandar'), array('controller' => 'estandares', 'action' => 'add')); ?> </li>
	</ul>
</div>
