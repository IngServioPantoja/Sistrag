<?php
	if(count($documentos)>0)
	{
		echo $this->Form->select(
			'Documento][id_primero]', $documentos,array('id'=>'documento','autocomplete' =>'off','empty'=>false,'class' => 'form-control col-sm-6' )
		);
		?>
		<?php
		echo $this->Form->select(
			'Documento][id_segundo]', $documentos,array('id'=>'documento','autocomplete' =>'off','empty'=>false,'class' => 'form-control col-sm-6' )
		);
?>
<script>
	$(".boton-actualizar").fadeIn("slow");
	</script>
<?php
	}else
	{
?>
	No se han encontrado documentos
	<script>
	$(".boton-actualizar").fadeOut("slow");
	</script>
<?php
	}
?>	