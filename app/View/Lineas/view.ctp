<div class="lineas view">
<h2><?php echo __('Linea'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($linea['Linea']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($linea['Linea']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($linea['Linea']['descripcion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo $this->Html->link($linea['Area']['nombre'], array('controller' => 'areas', 'action' => 'view', $linea['Area']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Linea'), array('action' => 'edit', $linea['Linea']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Linea'), array('action' => 'delete', $linea['Linea']['id']), null, __('Are you sure you want to delete # %s?', $linea['Linea']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lineas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Linea'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
	</ul>
</div>
