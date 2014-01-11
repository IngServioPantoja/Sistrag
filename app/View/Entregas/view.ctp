<div class="entregas view">
<h2><?php  echo __('Entrega'); ?></h2>
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
		<dt><?php echo __('Fecha Estado'); ?></dt>
		<dd>
			<?php echo h($entrega['Entrega']['fecha_estado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rol'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entrega['Rol']['nombre'], array('controller' => 'roles', 'action' => 'view', $entrega['Rol']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Documento Id'); ?></dt>
		<dd>
			<?php echo h($entrega['Entrega']['documento_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entrega['Estado']['id'], array('controller' => 'estados', 'action' => 'view', $entrega['Estado']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Estados'), array('controller' => 'estados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estado'), array('controller' => 'estados', 'action' => 'add')); ?> </li>
	</ul>
</div>
