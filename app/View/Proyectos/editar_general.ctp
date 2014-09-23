<?PHP 
$user=NUll;
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<?php

			?>
			<li>
				<span class="icon-list" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:12px;"></span>
				<?php 
				echo $this->Html->link(__('Documentos'), array('controller'=>'proyectos','action' => 'documentos',$proyecto['Proyecto']['id'])); 
				?></li>
				<?php
				if($current_user['nivel_id'] == '1' || $current_user['nivel_id'] == '2' || $current_user['nivel_id'] == '3' || $current_user['nivel_id'] == '5') 
				{
				?>
				<li>
				<span class="icon-cloudy" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Subir documento'), array('controller'=>'documentos','action' => 'subir_documento',$proyecto['Proyecto']['id'])); 
				?></li>
				<?php
				}
				if($current_user['nivel_id'] == '1' || $current_user['nivel_id'] == '2' || $current_user['nivel_id'] == '3') 
				{
				?>
				<li class="panel_menu_actual">
				<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Datos generales'), array('action' => 'editar_general',$proyecto['Proyecto']['id'])); 
				?></li><li>
				<span class="icon-group" style="color:#ddd;text-shadow:0px 0px 4px #222;"></span>
				<?php 
				echo $this->Html->link(__('Integrantes'), array('action' => 'editar_integrantes',$proyecto['Proyecto']['id']));
				?>
				</li>
				<?php
				}else
				{
				?>
				<li class="panel_menu_actual">
				<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Datos generales'), array('action' => 'detallar_general',$proyecto['Proyecto']['id'])); 
				?></li><li>
				<span class="icon-group" style="color:#ddd;text-shadow:0px 0px 4px #222;"></span>
				<?php 
				echo $this->Html->link(__('Integrantes'), array('action' => 'detallar_integrantes',$proyecto['Proyecto']['id']));
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
							Generalidades
						</span>
					</div>
					<?php echo $this->Form->create('Proyecto'); ?>
						<?php echo $this->Form->input('id'); ?>
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
											<?php echo $this->Form->input('codigo',array('label'=>false)); ?>
										</div>
									</div>
									<div class="div_doble">
										<label for="ProyectoNombre" class="div_left">
											<strong>Titulo proyecto:</strong>
										</label>
										<div class="input_unico">
											<?php echo $this->Form->input('titulo',array('label'=>false,'cols'=>'20','rows'=>'3')); ?>
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
											<?php echo $this->Form->input('programa',array('label'=>false,'id'=>'programa','class'=>'inputCorto')); ?>
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
													<?php echo $this->Form->input('area_id',array('label'=>false,'id'=>'area_id','class'=>'inputCorto')); ?>
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
														<?php echo $this->Form->input('linea_id',array('label'=>false,'class'=>'inputCorto')); ?>
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
	$('#navicon-suitcase').css( "background", "#7a0400" );
	$('#marcicon-suitcase').css( "color", "#7a0400" );
</script>