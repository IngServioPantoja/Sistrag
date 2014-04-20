<div class="itemsDocumentos form">
<?php echo $this->Form->create('ItemsDocumento'); ?>
	<fieldset>
		<legend><?php echo __('Add Items Documento'); ?></legend>
	<?php
		echo $this->Form->input('documento_id');
		echo $this->Form->input('items_estandar_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items Documentos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Documentos'), array('controller' => 'documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documento'), array('controller' => 'documentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items Estandares'), array('controller' => 'items_estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Estandar'), array('controller' => 'items_estandares', 'action' => 'add')); ?> </li>
	</ul>
</div>
