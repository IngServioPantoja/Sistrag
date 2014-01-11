<div class="menusNiveles view">
<h2><?php  echo __('Menus Nivel'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($menusNivel['MenusNivel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menusNivel['Menu']['texto'], array('controller' => 'menus', 'action' => 'view', $menusNivel['Menu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nivel'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menusNivel['Nivel']['nombre'], array('controller' => 'niveles', 'action' => 'view', $menusNivel['Nivel']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orden'); ?></dt>
		<dd>
			<?php echo h($menusNivel['MenusNivel']['orden']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo h($menusNivel['MenusNivel']['estado']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menus Nivel'), array('action' => 'edit', $menusNivel['MenusNivel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menus Nivel'), array('action' => 'delete', $menusNivel['MenusNivel']['id']), null, __('Are you sure you want to delete # %s?', $menusNivel['MenusNivel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus Niveles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menus Nivel'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Niveles'), array('controller' => 'niveles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Nivel'), array('controller' => 'niveles', 'action' => 'add')); ?> </li>
	</ul>
</div>
