<?php
if($select_entrada!=NULL)
{
?>
<div>
	<strong>
		<label for="Persona<?php echo $asociacion;?>"><?php echo $asociacion;?></label>
	</strong>
</div>
<div>
<?php echo $this->Form->select($foreign,
						   		array($select_entrada),
						   		array('empty'=>false,"required" => "required", 'id' => $foreign,'autocomplete' =>'off',"class"=>"inputCorto")
						   	); 
?>
</div>
<?php
}
?>
