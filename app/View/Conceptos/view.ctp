<div class="conceptos view">
<h2><?php  echo __('Concepto'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($concepto['Concepto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($concepto['Concepto']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Concepto'), array('action' => 'edit', $concepto['Concepto']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Concepto'), array('action' => 'delete', $concepto['Concepto']['id']), null, __('Are you sure you want to delete # %s?', $concepto['Concepto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Conceptos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Concepto'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Evaluaciones'), array('controller' => 'evaluaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evaluacion'), array('controller' => 'evaluaciones', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Evaluaciones'); ?></h3>
	<?php if (!empty($concepto['Evaluacion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Itemestandar Id'); ?></th>
		<th><?php echo __('Concepto Id'); ?></th>
		<th><?php echo __('Comentarios'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($concepto['Evaluacion'] as $evaluacion): ?>
		<tr>
			<td><?php echo $evaluacion['id']; ?></td>
			<td><?php echo $evaluacion['itemestandar_id']; ?></td>
			<td><?php echo $evaluacion['concepto_id']; ?></td>
			<td><?php echo $evaluacion['comentarios']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'evaluaciones', 'action' => 'view', $evaluacion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'evaluaciones', 'action' => 'edit', $evaluacion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'evaluaciones', 'action' => 'delete', $evaluacion['id']), null, __('Are you sure you want to delete # %s?', $evaluacion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Evaluacion'), array('controller' => 'evaluaciones', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
