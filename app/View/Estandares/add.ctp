<div class="estandares form">
<?php echo $this->Form->create('Estandar'); ?>
	<fieldset>
		<legend><?php echo __('Add Estandar'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('programa_id');
		echo $this->Form->input('tiposestandar_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<br/>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Estandares'), array('action' => 'index')); ?></li>
			
	</ul>
</div>
