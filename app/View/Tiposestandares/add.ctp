<div class="tiposestandares form">
<?php echo $this->Form->create('Tiposestandar'); ?>
	<fieldset>
		<legend><?php echo __('Add Tiposestandar'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tiposestandares'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Estandares'), array('controller' => 'estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estandar'), array('controller' => 'estandares', 'action' => 'add')); ?> </li>
	</ul>
</div>
