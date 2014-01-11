<?php echo $this->Html->script('jquery'); ?>
<?php
if($estado_entrada==1){
?>
<?php echo $this->Form->select("entrada",
						   		array($select_entrada),
						   		array("required" => "required", 'value' => '0', 'id' => 'tipo_entrada','autocomplete' =>'off')
						   	); 
}
else{
	echo "Seleccionar un tipo de entrada";
}
?>	
<?php echo $this->Js->writeBuffer(); ?>