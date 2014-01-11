<?php echo $this->Form->create('Item'); ?>
<fieldset>
	<legend>Nuevo</legend>
	<table>
		<tr>
			<td>
				Nombre
			</td>
			<td>
				<?php echo $this->Form->input('nombre',array('label' => false)); ?>
			</td>
		</tr>
		<tr>
			<td>
				Extención caracteres
			</td>
			<td>
				<?php echo $this->Form->input('extencion_caracteres',array('label' => false,'min'=>'1')); ?>
			</td>
		</tr>
		<tr>
			<td>
				Extención líneas
			</td>
			<td>
				<?php echo $this->Form->input('extencion_lineas',array('label' => false,'min'=>'1')); ?>
			</td>
		</tr>
		<tr>
			<td>
				Descripción
			</td>
			<td>
				<?php echo $this->Form->input('descripcion',array('label' => false)); ?>
			</td>
		</tr>
		<tr>
			<td>
				Facultad
			</td>
			<td>
				<?php echo $this->Form->input('facultad',array('label' => false, 'id' => 'sel_facultad', 'required' => 'required', 'value' => 0,'class' => 'select')); ?>
			</td>
		</tr>
		<tr>
			<td>
				Programa
			</td>
			<td>
				<div id='td_programas'>
					<?php echo $this->Form->input('programa_id',array('label' => false,'class' => 'select')); ?>
				</div>
			</td>
		</tr>
	</table>
</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
<?php
$this->Js->get('#sel_facultad')->event('change',
	$this->Js->request(
	    array(
	        'controller' => 'programas', 'action' => 'lista_programas',
	    ),
	    array(
	        'update'=>'#td_programas',
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

