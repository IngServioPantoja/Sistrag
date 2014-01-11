<div class="roles view">
<h2><?php  echo __('Rol'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rol['Rol']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($rol['Rol']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rol'), array('action' => 'edit', $rol['Rol']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rol'), array('action' => 'delete', $rol['Rol']['id']), null, __('Are you sure you want to delete # %s?', $rol['Rol']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Controles'), array('controller' => 'controles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Control'), array('controller' => 'controles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Entregas'), array('controller' => 'entregas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entrega'), array('controller' => 'entregas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas Proyectos'), array('controller' => 'personas_proyectos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('controller' => 'personas_proyectos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Controles'); ?></h3>
	<?php if (!empty($rol['Control'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Fecha'); ?></th>
		<th><?php echo __('Rol Id'); ?></th>
		<th><?php echo __('Estandar Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rol['Control'] as $control): ?>
		<tr>
			<td><?php echo $control['id']; ?></td>
			<td><?php echo $control['fecha']; ?></td>
			<td><?php echo $control['rol_id']; ?></td>
			<td><?php echo $control['estandar_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'controles', 'action' => 'view', $control['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'controles', 'action' => 'edit', $control['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'controles', 'action' => 'delete', $control['id']), null, __('Are you sure you want to delete # %s?', $control['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Control'), array('controller' => 'controles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Entregas'); ?></h3>
	<?php if (!empty($rol['Entrega'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Fecha Entrega'); ?></th>
		<th><?php echo __('Fecha Estado'); ?></th>
		<th><?php echo __('Rol Id'); ?></th>
		<th><?php echo __('Estado Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rol['Entrega'] as $entrega): ?>
		<tr>
			<td><?php echo $entrega['id']; ?></td>
			<td><?php echo $entrega['fecha_entrega']; ?></td>
			<td><?php echo $entrega['fecha_estado']; ?></td>
			<td><?php echo $entrega['rol_id']; ?></td>
			<td><?php echo $entrega['estado_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'entregas', 'action' => 'view', $entrega['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'entregas', 'action' => 'edit', $entrega['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'entregas', 'action' => 'delete', $entrega['id']), null, __('Are you sure you want to delete # %s?', $entrega['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Entrega'), array('controller' => 'entregas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Personas Proyectos'); ?></h3>
	<?php if (!empty($rol['PersonasProyecto'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Persona Id'); ?></th>
		<th><?php echo __('Documento Id'); ?></th>
		<th><?php echo __('Rol Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rol['PersonasProyecto'] as $personasProyecto): ?>
		<tr>
			<td><?php echo $personasProyecto['id']; ?></td>
			<td><?php echo $personasProyecto['persona_id']; ?></td>
			<td><?php echo $personasProyecto['documento_id']; ?></td>
			<td><?php echo $personasProyecto['rol_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'personas_proyectos', 'action' => 'view', $personasProyecto['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'personas_proyectos', 'action' => 'edit', $personasProyecto['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'personas_proyectos', 'action' => 'delete', $personasProyecto['id']), null, __('Are you sure you want to delete # %s?', $personasProyecto['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('controller' => 'personas_proyectos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
