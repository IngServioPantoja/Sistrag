<?php echo $this->Html->script('jquery'); ?>

<body>
<div class="proyectos form">
	<?php echo $this->Form->create('Proyecto'); ?>
		<fieldset>
			<legend><?php echo __('Add Proyecto'); ?></legend>
		<?php
			echo $this->Form->input('nombre');
		?>
		</fieldset>
	<?php 
		echo $this->Form->submit('Guardar cambios');
	?>

</div>
</body>
