<div class="controles view">
<h2><?php  echo __('Control'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($control['Control']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha'); ?></dt>
		<dd>
			<?php echo h($control['Control']['fecha']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rol'); ?></dt>
		<dd>
			<?php echo $this->Html->link($control['Rol']['nombre'], array('controller' => 'roles', 'action' => 'view', $control['Rol']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estandar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($control['Estandar']['nombre'], array('controller' => 'estandares', 'action' => 'view', $control['Estandar']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Control'), array('action' => 'edit', $control['Control']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Control'), array('action' => 'delete', $control['Control']['id']), null, __('Are you sure you want to delete # %s?', $control['Control']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Controles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Control'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estandares'), array('controller' => 'estandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estandar'), array('controller' => 'estandares', 'action' => 'add')); ?> </li>
	</ul>
</div>
