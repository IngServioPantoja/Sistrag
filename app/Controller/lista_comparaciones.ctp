<?php
	echo $this->Form->select(
		'id_primero', $documentos,array('id'=>'documento','autocomplete' =>'off','empty'=>false,'value'=>$proyecto['Documento']['id'],'class' => 'form-control col-sm-6' )
	);
	?>
	<?php
	echo $this->Form->select(
		'id_segundo', $documentos,array('id'=>'documento','autocomplete' =>'off','empty'=>false,'value'=>$proyecto['Documento']['id'],'class' => 'form-control col-sm-6' )
	);
?>	