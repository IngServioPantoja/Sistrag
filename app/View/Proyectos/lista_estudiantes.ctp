<?php echo $this->Html->script('jquery'); ?>
<?php //print_r($estudiantes);?>
<fieldset>
	<legend>
		Estudiantes
	</legend>
	<div id="integrantes">
							integrantes
						</div>
	<table>
		<tr>
			<td>
				Identificacion
			</td>
			<td>
				Nombre
			</td>
			<td>
				Apellido
			</td>
			<td>
				Accion
			</td>
		</tr>
	<?php foreach ($estudiantes as $estudiante): ?>
	
	<tr>

		<td>

			<?php echo h($estudiante['Persona']['id']); ?>
		</br></br>
			<?php echo h($estudiante['Persona']['identificacion']); ?>&nbsp;</td>
		<td><?php echo $var1=h($estudiante['Persona']['nombre']); ?>&nbsp;</td>
		<td><?php echo $var2=h($estudiante['Persona']['apellido']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->create('PersonasProyecto'); ?>
			<div class='pna_div_agr'>
			<?php echo $this->Form->input('persona_id',array('type'=>'text','label'=>false,'class'=>'pna_ipt_agr','id'=>'pna_ipt_agr','readonly'=>'readonly','value'=>$estudiante['Persona']['id'],));   ?>
			</div>
			
			<?php echo $this->Js->link('test','/personasproyectos/pre_render_agregar/'.$var1.'/'.$var2, 
				array('before'=>$this->Js->alert('entre'),
					'success'=>$this->Js->alert('sucesee'),
					'update'=>'#integrantes', 
					'evalScripts' => true));
			 ?>
			
			<?php echo $this->Form->end(); ?>
		</td>
	<?php
		echo $this->Form->hidden('persona_id',array('value'=> $estudiante['Persona']['id']));
		echo $this->Form->hidden('proyecto_id',array('value'=>'1'));
		echo $this->Form->hidden('rol_id',array('valude'=>'3'));
	?>
</tr>


<?php endforeach; ?>
	</table>
<?php
$this->Js->get('.pna_ipt_agr')->event('click',
	$this->Js->request(
	    array(
	        'controller'=>'personasproyectos',
	        'action'=>'pre_render_agregar',
	    ),
	    array(
	        'update'=>'#integrantes',
	        'before' => $this->Js->alert('entre'),
	        'complete' => $this->Js->alert('complete'),
	        'async' => true,
	        'method' => 'post',
	        'dataExpression'=>true,
	        'data'=> $this->Js->serializeForm(array(
    'isForm' => true,
    'inline' => true ))
	    )
	)
);
?>
</fieldset>
<?php echo $this->Js->writeBuffer(); ?>