<?php 
?>
<?php
	if(count($documentos)<=0)
	{
?>
No se han encontrado documentos
<script>
$(".botones-acciones").fadeOut("slow");
</script>
<?php
	}else
	{
		echo $this->Form->select('documento',
			array($documentos),
			array('empty'=>false,"required" => "required", 'id' => 'documento','autocomplete' =>'off',"class"=>"inputCorto")
		); 
?>
<script>
$(".botones-acciones").fadeIn("slow");
</script>
<?php
	}

?>
