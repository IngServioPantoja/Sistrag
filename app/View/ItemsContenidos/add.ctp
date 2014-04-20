<div class="itemsContenidos form">
<?php echo $this->Form->create('ItemsContenido'); ?>
	<fieldset>
		<legend><?php echo __('Add Items Contenido'); ?></legend>
	<?php
		echo $this->Form->input('texto');
		echo $this->Form->input('tipo');
		echo $this->Form->input('items_documento_id');
		echo $this->Form->input('orden');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items Contenidos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Items Documentos'), array('controller' => 'items_documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Documento'), array('controller' => 'items_documentos', 'action' => 'add')); ?> </li>
	</ul>
</div>
