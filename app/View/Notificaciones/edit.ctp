<div class="notificaciones form">
<?php echo $this->Form->create('Notificacion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Notificacion'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fecha');
		echo $this->Form->input('parametro_estado_id');
		echo $this->Form->input('parametro_tipo_notificacion');
		echo $this->Form->input('url');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Notificacion.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Notificacion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Notificaciones'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Parametros'), array('controller' => 'parametros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parametro'), array('controller' => 'parametros', 'action' => 'add')); ?> </li>
	</ul>
</div>
