<div class="entregas form">
<?php echo $this->Form->create('Entrega'); ?>
	<fieldset>
		<legend><?php echo __('Edit Entrega'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fecha_entrega');
		echo $this->Form->input('rol_id');
		echo $this->Form->input('documento_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Entrega.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Entrega.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Entregas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documentos'), array('controller' => 'documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documento'), array('controller' => 'documentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Detalleentregas'), array('controller' => 'detalleentregas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detalleentrega'), array('controller' => 'detalleentregas', 'action' => 'add')); ?> </li>
	</ul>
</div>
