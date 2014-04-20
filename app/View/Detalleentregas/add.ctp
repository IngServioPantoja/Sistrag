<div class="detalleentregas form">
<?php echo $this->Form->create('Detalleentrega'); ?>
	<fieldset>
		<legend><?php echo __('Add Detalleentrega'); ?></legend>
	<?php
		echo $this->Form->input('entrega_id');
		echo $this->Form->input('personas_proyecto_id');
		echo $this->Form->input('estado_id');
		echo $this->Form->input('fecha_estado');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Detalleentregas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Entregas'), array('controller' => 'entregas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entrega'), array('controller' => 'entregas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas Proyectos'), array('controller' => 'personas_proyectos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('controller' => 'personas_proyectos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estados'), array('controller' => 'estados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estado'), array('controller' => 'estados', 'action' => 'add')); ?> </li>
	</ul>
</div>
