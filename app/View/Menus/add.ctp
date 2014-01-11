<div class="menus form">
<?php echo $this->Form->create('Menu'); ?>
	<fieldset>
		<legend><?php echo __('Add Menu'); ?></legend>
	<?php
		echo $this->Form->input('texto');
		echo $this->Form->input('vinculo');
		echo $this->Form->input('icono');
		echo $this->Form->input('estado');
		echo $this->Form->input('menu_id');
		echo $this->Form->input('Nivel');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Niveles'), array('controller' => 'niveles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Nivel'), array('controller' => 'niveles', 'action' => 'add')); ?> </li>
	</ul>
</div>
