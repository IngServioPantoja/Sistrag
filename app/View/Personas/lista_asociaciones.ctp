<?php
if($select_entrada!=NULL && isset($select_entrada))
{
?>
<div>
	<strong>
		<label for="Persona<?php echo $asociacion;?>"><?php echo $asociacion;?></label>
	</strong>
</div>
<div>
<?php
	if(isset($foreign))
	{
		echo $this->Form->select("Persona][".$foreign,
	   		array($select_entrada),
	   		array('empty'=>false,"required" => "required", 'id' => $foreign,'autocomplete' =>'off',"class"=>"inputCorto")
	   	);
	}
?>
<?php  
?>
</div>
<?php
}
?>
