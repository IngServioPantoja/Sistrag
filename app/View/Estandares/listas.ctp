<?php
	echo $this->Form->select(
		'Busqueda][valor', array($listas
			),array('id'=>'valor','autocomplete' =>'off','empty'=>false)
	);

?>
<?php
$this->Js->get('#valor')->event('change',
	$this->Js->request(
	    array(
	        'action'=>'index'
	    ),
	    array(
	        'update'=>'#contenedor_datos',
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

?>
<?php echo $this->Js->writeBuffer(); ?>