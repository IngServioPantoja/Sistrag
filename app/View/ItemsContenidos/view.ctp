<div class="itemsContenidos view">
<h2><?php echo __('Items Contenido'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemsContenido['ItemsContenido']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Texto'); ?></dt>
		<dd>
			<?php echo h($itemsContenido['ItemsContenido']['texto']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo'); ?></dt>
		<dd>
			<?php echo h($itemsContenido['ItemsContenido']['tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Items Documento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemsContenido['ItemsDocumento']['id'], array('controller' => 'items_documentos', 'action' => 'view', $itemsContenido['ItemsDocumento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orden'); ?></dt>
		<dd>
			<?php echo h($itemsContenido['ItemsContenido']['orden']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Items Contenido'), array('action' => 'edit', $itemsContenido['ItemsContenido']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Items Contenido'), array('action' => 'delete', $itemsContenido['ItemsContenido']['id']), null, __('Are you sure you want to delete # %s?', $itemsContenido['ItemsContenido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Items Contenidos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Contenido'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items Documentos'), array('controller' => 'items_documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items Documento'), array('controller' => 'items_documentos', 'action' => 'add')); ?> </li>
	</ul>
</div>
