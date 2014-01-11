<div class="evaluaciones form">
<?php echo $this->Form->create('Evaluacion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Evaluacion'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('itemestandar_id');
		echo $this->Form->input('concepto_id');
		echo $this->Form->input('comentarios');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Evaluacion.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Evaluacion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Evaluaciones'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Itemsestandares'), array('controller' => 'itemsestandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itemsestandar'), array('controller' => 'itemsestandares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conceptos'), array('controller' => 'conceptos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Concepto'), array('controller' => 'conceptos', 'action' => 'add')); ?> </li>
	</ul>
</div>
