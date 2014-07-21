<?php echo $this->Form->select('estandar_id',
   		array($estandares),
   		array('empty'=>false,"required" => "required", 'id' => 'estandar_id','autocomplete' =>'off',"class"=>"inputCorto",'name'=>'data[Control][estandar_id]')
   	); 
?>