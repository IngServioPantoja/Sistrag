<div class="personasProyectos view">
<h2><?php  echo __('Personas Proyecto'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($personasProyecto['PersonasProyecto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Persona'); ?></dt>
		<dd>
			<?php echo $this->Html->link($personasProyecto['Persona']['nombre'], array('controller' => 'personas', 'action' => 'view', $personasProyecto['Persona']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Proyecto'); ?></dt>
		<dd>
			<?php echo $this->Html->link($personasProyecto['Proyecto']['nombre'], array('controller' => 'proyectos', 'action' => 'view', $personasProyecto['Proyecto']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rol'); ?></dt>
		<dd>
			<?php echo $this->Html->link($personasProyecto['Rol']['nombre'], array('controller' => 'roles', 'action' => 'view', $personasProyecto['Rol']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Personas Proyecto'), array('action' => 'edit', $personasProyecto['PersonasProyecto']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Personas Proyecto'), array('action' => 'delete', $personasProyecto['PersonasProyecto']['id']), null, __('Are you sure you want to delete # %s?', $personasProyecto['PersonasProyecto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas Proyectos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Proyectos'), array('controller' => 'proyectos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proyecto'), array('controller' => 'proyectos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>
