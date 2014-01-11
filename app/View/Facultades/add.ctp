<div class="facultades form">

<?php echo $this->Form->create('Facultad'); ?>
	<fieldset>
		<legend><?php echo __('Add Facultad'); ?></legend>
	
	 <?php echo $this->Form->input('nombre'); ?>
	 <?php echo $this->Form->input('Descripcion',array('type'=> 'textarea')); ?>

	
<!--  <?php
	echo $this->Form->input('photo', array('type' => 'file'));
	   echo $this->Form->input('photo_dir', array('type' => 'hidden')); 

	?>
	-->

		</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<br/>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Facultades'), array('action' => 'index')); ?></li>
	</ul>
</div>
