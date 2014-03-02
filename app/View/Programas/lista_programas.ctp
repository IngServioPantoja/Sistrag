<?php echo $this->Form->select("programa_id",
						   		array($select_entrada),
						   		array("required" => "required", 
						   			'empty'=>false,
						   			'class' => 'select'
						   		)
						   	); 
?>

<?php 
$this->Js->get('#programa_id')->event('change',
	$this->Js->request(
	    array(
	        'controller'=>'areas','action' => 'lista_areas',
	    ),
	    array(
	        'update'=>'#div_area',
	        'async' => true,
	        'method' => 'post',
	        'dataExpression'=>true,
	        'data'=> $this->Js->serializeForm(array(
	            'isForm' => false,
	            'inline' => true
	        ))
	    )
	)
);
echo $this->Js->writeBuffer(); ?>	