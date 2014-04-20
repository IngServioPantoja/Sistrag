<div class="entregas view">
<h2><?php echo __('Entrega'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($entrega['Entrega']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Entrega'); ?></dt>
		<dd>
			<?php echo h($entrega['Entrega']['fecha_entrega']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rol'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entrega['Rol']['nombre'], array('controller' => 'roles', 'action' => 'view', $entrega['Rol']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Documento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entrega['Documento']['fecha_guardado'], array('controller' => 'documentos', 'action' => 'view', $entrega['Documento']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Entrega'), array('action' => 'edit', $entrega['Entrega']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Entrega'), array('action' => 'delete', $entrega['Entrega']['id']), null, __('Are you sure you want to delete # %s?', $entrega['Entrega']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Entregas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entrega'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documentos'), array('controller' => 'documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documento'), array('controller' => 'documentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Detalleentregas'), array('controller' => 'detalleentregas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detalleentrega'), array('controller' => 'detalleentregas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Detalleentregas'); ?></h3>
	<?php if (!empty($entrega['Detalleentrega'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entrega Id'); ?></th>
		<th><?php echo __('Personas Proyecto Id'); ?></th>
		<th><?php echo __('Estado Id'); ?></th>
		<th><?php echo __('Fecha Estado'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entrega['Detalleentrega'] as $detalleentrega): ?>
		<tr>
			<td><?php echo $detalleentrega['id']; ?></td>
			<td><?php echo $detalleentrega['entrega_id']; ?></td>
			<td><?php echo $detalleentrega['personas_proyecto_id']; ?></td>
			<td><?php echo $detalleentrega['estado_id']; ?></td>
			<td><?php echo $detalleentrega['fecha_estado']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'detalleentregas', 'action' => 'view', $detalleentrega['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'detalleentregas', 'action' => 'edit', $detalleentrega['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'detalleentregas', 'action' => 'delete', $detalleentrega['id']), null, __('Are you sure you want to delete # %s?', $detalleentrega['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Detalleentrega'), array('controller' => 'detalleentregas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
