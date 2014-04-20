<?php echo $this->Form->select('documento',
						   		array($documentos),
						   		array('empty'=>false,"required" => "required", 'id' => 'documento','autocomplete' =>'off',"class"=>"inputCorto")
						   	); 
?>
