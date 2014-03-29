<?php 
$user=NUll;
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<?php
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') 
			{
			?>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('title' => 'Listar Estandares','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Estandar'), array('action' => 'index')); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('title' => 'Registrar Estandar','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Registrar entandar'), array('action' => 'add')); 
			}
				?>
			</li>
		</ul>
	</div>
	<section class="panel_internal">
		<table class="crud">
			<tr>
				<td>
					<div class="crud_fila_principal">
						<div class="back">
							<?php
							echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
										array('escape' => false));
							?>
						</div>
						<span>
							Registrar estandar
						</span>
					</div>
					<?php 
					echo $this->Form->create('Estandar'); 
						echo $this->Form->input('id'); 
					?>
						<div class="crud_fila_secundaria">
							<figure class="fondoAgregar">
								<?php
								echo $this->Html->image('recursos/escudo400.png', array('width' => '200px'));
								?>
							</figure>
							<article class='fichaAgregar'>
								<div class='entradas'>
									<div>
										<div>
											<strong><label for="EstandarNombre">Título:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('nombre',array('label'=>false,"autocomplete"=>"off",'required'=>'required')); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="EstandarTipoestandar_id">Tipo:</label></strong>
										</div>
										<div>
										<?php 
										echo $this->Form->input('tiposestandar_id',array('label'=>false,'class'=>'inputCorto'));
										?>
										</div>
									</div>
									<div class="div_doble">
										<div>
											<label for="facultad" class="div_left">
												<strong>Facultad:</strong>
											</label>
										</div>
										<div class="div_right">
										<?php echo $this->Form->select("facultad",
									   		array($facultades),
									   		array("required" => "required", 
									   			'empty'=>false,"class"=>"inputCorto")
									   		); 
										?>
										</div>
									</div>
									<div id="div_programa">
										<div class="div_left">
											<label>
												<strong>Programa:</strong>
											</label>
										</div>
										<div class="div_right" id="divPrograma">
										<?php echo $this->Form->input('programa_id',array('label'=>false,'id'=>'programa','class'=>'inputCorto')); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="PersonaApellido">Inicio Vigencia:</label></strong>
										</div>
										<div>
										<?php 
										echo $this->Form->date('inicio vigencia',array('label'=>false,"autocomplete"=>"off",'required'=>'required')); 
										?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="PersonaEmail">Fin Vigencia:</label></strong>
										</div>
										<div>
										<?php 
										echo $this->Form->date('fin vigencia',array('label'=>false,"autocomplete"=>"off")); 
										?>
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
$this->Js->get('#EstandarFacultad')->event('change',
	$this->Js->request(
	    array(
	        'controller'=>'estandares','action' => 'lista_programas',
	    ),
	    array(
	        'update'=>'#divPrograma',
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
	$('#navicon-file-settings').css( "background", "#7a0400" );
	$('#marcicon-file-settings').css( "color", "#7a0400" );
	$('textarea').autosize();
	function resizeInput() 
	{
	    $(this).attr('size', $(this).val().length+1);
	}
	$('input[type="text"]')
	    .keyup(resizeInput)
	    .each(resizeInput);
</script>