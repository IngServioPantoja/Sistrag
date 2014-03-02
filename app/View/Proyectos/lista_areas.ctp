<div class="div_doble">
	<div class="div_left">
		<label>
			<strong>Área de investigación:</strong>
		</label>
	</div>
	<div class="div_right">
	<?php
	if(count($select_areas)>0)
	{
		echo $this->Form->select('area_id',array($select_areas),array('empty'=>false,'label'=>false,'id'=>'area_id','class'=>'inputCorto'));
	}else
	{
		echo "no hay areas";
	}
	?>
	</div>
</div>
<div id="div_linea" class="div_doble">
	<div class="div_doble">
		<div class="div_left">
			<label for="linea_id">
				<strong>Línea de investigación:</strong>
			</label>
		</div>
		<div class="div_right">
		<?php
		if(count($select_lineas)>0)
		{
			echo $this->Form->select('linea_id',array($select_lineas),array('empty'=>false,'label'=>false,'class'=>'inputCorto'));
		}else
		{
		?>
			No hay Líneas
		<?php
		}
		?>
		</div>
	</div>
</div>
<?php
$this->Js->get('#area_id')->event('change',
	$this->Js->request(
	    array(
	        'controller'=>'proyectos','action' => 'lista_lineas',
	    ),
	    array(
	        'update'=>'#div_linea',
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