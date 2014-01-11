<div class="documentos view">
<h2><?php  echo __('Documento'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($documento['Documento']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Guardado'); ?></dt>
		<dd>
			<?php echo h($documento['Documento']['fecha_guardado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enlace'); ?></dt>
		<dd>
			<?php echo h($documento['Documento']['enlace']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estandar Id'); ?></dt>
		<dd>
			<?php echo h($documento['Documento']['estandar_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Documento'), array('action' => 'edit', $documento['Documento']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Documento'), array('action' => 'delete', $documento['Documento']['id']), null, __('Are you sure you want to delete # %s?', $documento['Documento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Documentos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documento'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas Proyectos'), array('controller' => 'personas_proyectos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('controller' => 'personas_proyectos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Personas Proyectos'); ?></h3>
	<?php if (!empty($documento['PersonasProyecto'])): ?>
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
		foreach ($documento['PersonasProyecto'] as $personasProyecto): ?>
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
