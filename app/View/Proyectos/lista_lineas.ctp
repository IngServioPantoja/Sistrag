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
