<?php echo $this->Html->script('jquery'); ?>
<div class="proyectos form">
	
		<fieldset>
			<legend>Datos generales del proyecto</legend>
		<?php 
			echo $proyecto['Proyecto']['nombre']; 
		?>
		</fieldset>
		<fieldset>
			<legend>
				Integrantes
			</legend>
			<table>
			<div id="integrantes">
						<tr>
							<td> id &nbsp;</td>
							<td> nombre &nbsp;</td>
							<td> apellido &nbsp;</td>
							<td class="actions">
								action
							</td>
						</tr>
					<?php foreach ($proyecto['Persona'] as $integrante): ?>
						<tr>
							<td><?php echo h($integrante['id']); ?>&nbsp;</td>
							<td><?php echo h($integrante['nombre']); ?>&nbsp;</td>
							<td><?php echo h($integrante['apellido']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link(__('View'), array('action' => 'view', $integrante['id'])); ?>
							</td>
						</tr>
					<?php endforeach; ?>
					<?php //print_r($integrante); ?>
			</div>
			<table>
				<tr>
					<th>
						Nombre integrante
					</th>
					<th>

					</th>
				</tr>
				<tr>
					<td><?php echo $this->Form->create('Integrante'); ?>
						<?php echo $this->Form->input('nombre', array('type' => 'text','label'=>false,'id'=>'prueba','autocomplete' =>'off')); ?>
						<?php echo $this->Form->hidden('proyecto_id', array('value'=>$proyecto['Proyecto']['id'])); ?>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div id="lista">
							lista!!
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
<?php
$this->Js->get('#prueba')->event('keyup',
	$this->Js->request(
	    array(
	        'action'=>'lista_estudiantes',
	    ),
	    array(
	        'update'=>'#lista',
	        //'before' => $this->Js->alert('entre'),
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
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>

			<li><?php echo $this->Html->link(__('List Proyectos'), array('action' => 'index')); ?></li>
		</ul>
	</div>
</div>
<?php echo $this->Js->writeBuffer(); ?>