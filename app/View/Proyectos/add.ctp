<?PHP 
$user=NUll;
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Proyectos'), array('action' => 'index')); 
				?></li>
				<?php
				if($current_user['nivel_id'] == '1' || $current_user['nivel_id'] == '2' || $current_user['nivel_id'] == '3') 
				{
				?>
				<li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Registrar Proyecto'), array('action' => 'add')); 
				?>
				</li>
				<?php
				}
				?>
		</ul>
	</div>
	<section class="panel_internal">
 		<table class="crud">
			<tr>
				<td>
					<div class="crud_fila_principal">
						<span>
							Registrar proyecto: Generalidades
						</span>
					</div>
					<?php echo $this->Form->create('Proyecto'); ?>
						<div class="crud_fila_secundaria">
								<figure class="fondoAgregar">
									<?php
									echo $this->Html->image('recursos/escudo400.png', array('width' => '200px'));
									?>
								</figure>
							<article class='fichaAgregar'>
								<div class='entradas'>
									<div class="div_doble">
										<label for="ProyectoCodigo" class="div_left">
											<strong>Codigo proyecto:</strong>
										</label>
										<div class="div_right">
											<?php echo $this->Form->input('codigo',array('label'=>false,'required'=>'required')); ?>
										</div>
									</div>
									<div class="div_doble">
										<label for="ProyectoNombre" class="div_left">
											<strong>Titulo proyecto:</strong>
										</label>
										<div class="input_unico">
											<?php echo $this->Form->input('titulo',array('label'=>false,'cols'=>'20','rows'=>'3','required'=>'required')); ?>
										</div>
									</div>
									<div class="div_doble">
										<label for="facultad" class="div_left">
											<strong>Facultad:</strong>
										</label>
										<div class="div_right">
										<?php echo $this->Form->input('facultad',array('label'=>false,'id'=>'facultad','class'=>'inputCorto')); ?>
										</div>
									</div>
									<div id="div_programa">
										<div class="div_doble">
											<div class="div_left">
												<label>
													<strong>Programa académico:</strong>
												</label>
											</div>
											<div class="div_right">
											<?php echo $this->Form->input('programa',array('label'=>false,'id'=>'programa','class'=>'inputCorto','required'=>'required','empty'=>false)); ?>
											</div>
										</div>
										<div id="div_area" class="div_doble">
											<div class="div_doble">
												<div class="div_left">
													<label>
														<strong>Área de investigación:</strong>
													</label>
												</div>
												<div class="div_right">
													<?php echo $this->Form->input('area_id',array('label'=>false,'id'=>'area_id','class'=>'inputCorto','required'=>'required')); ?>
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
														<?php echo $this->Form->input('linea_id',array('label'=>false,'class'=>'inputCorto','required'=>'required')); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</article>
						</div>
					<?php echo $this->Form->end(__('Registrar')); ?>
				</td>
			</tr>
		</table>
 	</section>
</section>
<?php
$this->Js->get('#facultad')->event('change',
	$this->Js->request(
	    array(
	        'controller'=>'proyectos','action' => 'lista_programas',
	    ),
	    array(
	        'update'=>'#div_programa',
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
<script>
	$('#navicon-suitcase').css( "color", "#7a0400" );
</script>