<div class="menus view">
<h2><?php  echo __('Menu'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Texto'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['texto']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vinculo'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['vinculo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Icono'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['icono']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['estado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Menu Id'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['menu_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menu'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Niveles'), array('controller' => 'niveles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Nivel'), array('controller' => 'niveles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Niveles'); ?></h3>
	<?php if (!empty($menu['Nivel'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['Nivel'] as $nivel): ?>
		<tr>
			<td><?php echo $nivel['id']; ?></td>
			<td><?php echo $nivel['nombre']; ?></td>
			<td><?php echo $nivel['descripcion']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'niveles', 'action' => 'view', $nivel['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'niveles', 'action' => 'edit', $nivel['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'niveles', 'action' => 'delete', $nivel['id']), null, __('Are you sure you want to delete # %s?', $nivel['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Nivel'), array('controller' => 'niveles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
