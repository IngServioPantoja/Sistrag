<div class="lineas form">
<?php echo $this->Form->create('Linea'); ?>
	<fieldset>
		<legend><?php echo __('Add Linea'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('area_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Lineas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
	</ul>
</div>
