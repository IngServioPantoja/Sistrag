<div class="itemsDocumentos view">
<h2><?php echo __('Items Documento'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemsDocumento['ItemsDocumento']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Documento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemsDocumento['Documento']['fecha_guardado'], array('controller' => 'documentos', 'action' => 'view', $itemsDocumento['Documento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Items Estandar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemsDocumento['ItemsEstandar']['id'], array('controller' => 'items_estandares', 'action' => 'view', $itemsDocumento['ItemsEstandar']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Items Documento'), array('action' => 'edit', $itemsDocumento['ItemsDocumento']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Items Documento'), array('action' => 'delete', $itemsDocumento['ItemsDocumento']['id']), null, __('Are you sure you want to delete # %s?', $itemsDocumento['ItemsDocumento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Items Documentos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Documento'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documentos'), array('controller' => 'documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documento'), array('controller' => 'documentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items Estandares'), array('controller' => 'items_estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Estandar'), array('controller' => 'items_estandares', 'action' => 'add')); ?> </li>
	</ul>
</div>
