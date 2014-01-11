<div class="facultades form">
<?php echo $this->Form->create('Facultad'); ?>
	<fieldset>
		<legend><?php echo __('Edit Facultad'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('Descripcion',array('type'=> 'textarea')); 

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
	
		<li><?php echo $this->Html->link(__('List Facultades'), array('action' => 'index')); ?></li>
		
	</ul>
</div>
