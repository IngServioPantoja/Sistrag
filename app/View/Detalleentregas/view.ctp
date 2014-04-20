<div class="detalleentregas view">
<h2><?php echo __('Detalleentrega'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($detalleentrega['Detalleentrega']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entrega'); ?></dt>
		<dd>
			<?php echo $this->Html->link($detalleentrega['Entrega']['fecha_entrega'], array('controller' => 'entregas', 'action' => 'view', $detalleentrega['Entrega']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Personas Proyecto'); ?></dt>
		<dd>
			<?php echo $this->Html->link($detalleentrega['PersonasProyecto']['id'], array('controller' => 'personas_proyectos', 'action' => 'view', $detalleentrega['PersonasProyecto']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo $this->Html->link($detalleentrega['Estado']['id'], array('controller' => 'estados', 'action' => 'view', $detalleentrega['Estado']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Estado'); ?></dt>
		<dd>
			<?php echo h($detalleentrega['Detalleentrega']['fecha_estado']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Detalleentrega'), array('action' => 'edit', $detalleentrega['Detalleentrega']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Detalleentrega'), array('action' => 'delete', $detalleentrega['Detalleentrega']['id']), null, __('Are you sure you want to delete # %s?', $detalleentrega['Detalleentrega']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Detalleentregas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detalleentrega'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Entregas'), array('controller' => 'entregas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entrega'), array('controller' => 'entregas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas Proyectos'), array('controller' => 'personas_proyectos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('controller' => 'personas_proyectos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estados'), array('controller' => 'estados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estado'), array('controller' => 'estados', 'action' => 'add')); ?> </li>
	</ul>
</div>
