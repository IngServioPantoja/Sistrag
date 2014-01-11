<div class="tiposestandares view">
<h2><?php  echo __('Tiposestandar'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tiposestandar['Tiposestandar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($tiposestandar['Tiposestandar']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tiposestandar'), array('action' => 'edit', $tiposestandar['Tiposestandar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tiposestandar'), array('action' => 'delete', $tiposestandar['Tiposestandar']['id']), null, __('Are you sure you want to delete # %s?', $tiposestandar['Tiposestandar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tiposestandares'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tiposestandar'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estandares'), array('controller' => 'estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estandar'), array('controller' => 'estandares', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Estandares'); ?></h3>
	<?php if (!empty($tiposestandar['Estandar'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Programa Id'); ?></th>
		<th><?php echo __('Tiposestandar Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tiposestandar['Estandar'] as $estandar): ?>
		<tr>
			<td><?php echo $estandar['id']; ?></td>
			<td><?php echo $estandar['nombre']; ?></td>
			<td><?php echo $estandar['programa_id']; ?></td>
			<td><?php echo $estandar['tiposestandar_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'estandares', 'action' => 'view', $estandar['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'estandares', 'action' => 'edit', $estandar['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'estandares', 'action' => 'delete', $estandar['id']), null, __('Are you sure you want to delete # %s?', $estandar['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Estandar'), array('controller' => 'estandares', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
