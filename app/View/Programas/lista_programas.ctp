<?php echo $this->Html->script('jquery'); ?>
<?php echo $this->Form->select("programa_id",
						   		array($select_entrada),
						   		array("required" => "required", 
						   			'empty'=>false,
						   			'class' => 'select'
						   		)
						   	); 
?>	
<?php echo $this->Js->writeBuffer(); ?>