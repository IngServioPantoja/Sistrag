<div class="notificaciones view">
<h2><?php echo __('Notificacion'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($notificacion['Notificacion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha'); ?></dt>
		<dd>
			<?php echo h($notificacion['Notificacion']['fecha']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parametro Estado Id'); ?></dt>
		<dd>
			<?php echo h($notificacion['Notificacion']['parametro_estado_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parametro'); ?></dt>
		<dd>
			<?php echo $this->Html->link($notificacion['Parametro']['nombre'], array('controller' => 'parametros', 'action' => 'view', $notificacion['Parametro']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($notificacion['Notificacion']['url']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Notificacion'), array('action' => 'edit', $notificacion['Notificacion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Notificacion'), array('action' => 'delete', $notificacion['Notificacion']['id']), null, __('Are you sure you want to delete # %s?', $notificacion['Notificacion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Notificaciones'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notificacion'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Parametros'), array('controller' => 'parametros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parametro'), array('controller' => 'parametros', 'action' => 'add')); ?> </li>
	</ul>
</div>
