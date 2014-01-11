<div class="evaluaciones view">
<h2><?php  echo __('Evaluacion'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evaluacion['Evaluacion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Itemsestandar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evaluacion['Itemsestandar']['orden'], array('controller' => 'itemsestandares', 'action' => 'view', $evaluacion['Itemsestandar']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Concepto'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evaluacion['Concepto']['nombre'], array('controller' => 'conceptos', 'action' => 'view', $evaluacion['Concepto']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comentarios'); ?></dt>
		<dd>
			<?php echo h($evaluacion['Evaluacion']['comentarios']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Evaluacion'), array('action' => 'edit', $evaluacion['Evaluacion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Evaluacion'), array('action' => 'delete', $evaluacion['Evaluacion']['id']), null, __('Are you sure you want to delete # %s?', $evaluacion['Evaluacion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Evaluaciones'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evaluacion'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itemsestandares'), array('controller' => 'itemsestandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itemsestandar'), array('controller' => 'itemsestandares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conceptos'), array('controller' => 'conceptos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Concepto'), array('controller' => 'conceptos', 'action' => 'add')); ?> </li>
	</ul>
</div>
