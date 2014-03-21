<div class="div_doble">
	<div class="div_left">
		<label>
			<strong>Programa académico:</strong>
		</label>
	</div>
	<div class="div_right">
	<?php 
	if(count($select_programas)>0)
	{
		echo $this->Form->select('Proyecto][programa',array($select_programas),array('empty'=>false,'label'=>false,'id'=>'programa','class'=>'inputCorto'));
	}else
	{
		echo "No hay programas";
	}
	 
	?>
	</div>
</div>
<div id="div_area" class="div_doble">
	<div class="div_left">
		<label>
			<strong>Área de investigación:</strong>
		</label>
	</div>
	<div class="div_right">
	<?php
	if(count($select_areas)>0)
	{
		echo $this->Form->select('Proyecto][area_id',array($select_areas),array('empty'=>false,'label'=>false,'id'=>'area_id','class'=>'inputCorto','value'=>'1'));
	}else
	{
		echo "No hay Areas";
	}
	?>
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
			if(count($select_areas)>0)
			{
				echo $this->Form->select('Proyecto][linea_id',array($select_lineas),array('empty'=>false,'label'=>false,'class'=>'inputCorto')); 
			}else
			{
				echo "No hay Líneas";
			}
			?>
		</div>
	</div>
</div>
<?php
$this->Js->get('#programa')->event('change',
	$this->Js->request(
	    array(
	        'controller'=>'proyectos','action' => 'lista_areas',
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
$this->Js->get('#area_id')->event('change',
	$this->Js->request(
	    array(
	        'action' => 'lista_lineas',
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