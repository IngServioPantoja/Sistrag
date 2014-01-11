<div class="menusNiveles index">
	<h2><?php echo __('Menus Niveles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('menu_id'); ?></th>
			<th><?php echo $this->Paginator->sort('nivel_id'); ?></th>
			<th><?php echo $this->Paginator->sort('orden'); ?></th>
			<th><?php echo $this->Paginator->sort('estado'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($menusNiveles as $menusNivel): ?>
	<tr>
		<td><?php echo h($menusNivel['MenusNivel']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($menusNivel['Menu']['texto'], array('controller' => 'menus', 'action' => 'view', $menusNivel['Menu']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($menusNivel['Nivel']['nombre'], array('controller' => 'niveles', 'action' => 'view', $menusNivel['Nivel']['id'])); ?>
		</td>
		<td><?php echo h($menusNivel['MenusNivel']['orden']); ?>&nbsp;</td>
		<td><?php echo h($menusNivel['MenusNivel']['estado']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $menusNivel['MenusNivel']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $menusNivel['MenusNivel']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $menusNivel['MenusNivel']['id']), null, __('Are you sure you want to delete # %s?', $menusNivel['MenusNivel']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Menus Nivel'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Niveles'), array('controller' => 'niveles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Nivel'), array('controller' => 'niveles', 'action' => 'add')); ?> </li>
	</ul>
</div>
