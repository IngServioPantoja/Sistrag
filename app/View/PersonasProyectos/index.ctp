<div class="personasProyectos index">
	<h2><?php echo __('Personas Proyectos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('proyecto_id'); ?></th>
			<th><?php echo $this->Paginator->sort('persona_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rol_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($personasProyectos as $personasProyecto): ?>
	<tr>
		<td><?php echo h($personasProyecto['PersonasProyecto']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($personasProyecto['Proyecto']['titulo'], array('controller' => 'proyectos', 'action' => 'view', $personasProyecto['Proyecto']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($personasProyecto['Persona']['nombre'], array('controller' => 'personas', 'action' => 'view', $personasProyecto['Persona']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($personasProyecto['Rol']['nombre'], array('controller' => 'roles', 'action' => 'view', $personasProyecto['Rol']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $personasProyecto['PersonasProyecto']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $personasProyecto['PersonasProyecto']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $personasProyecto['PersonasProyecto']['id']), null, __('Are you sure you want to delete # %s?', $personasProyecto['PersonasProyecto']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Proyectos'), array('controller' => 'proyectos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proyecto'), array('controller' => 'proyectos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>
