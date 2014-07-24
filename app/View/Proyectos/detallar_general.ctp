<?PHP 
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
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Documentos'), array('controller'=>'proyectos','action' => 'documentos',$proyecto['Proyecto']['id'])); 
				?></li><li class="panel_menu_actual">
				<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Datos generales'), array('action' => 'editar_general',$proyecto['Proyecto']['id'])); 
				?></li><li>
				<span class="icon-group" style="color:#ddd;text-shadow:0px 0px 4px #222;"></span>
				<?php 
				echo $this->Html->link(__('Integrantes'), array('action' => 'editar_integrantes',$proyecto['Proyecto']['id'])); 
				?>				
			<?php
			}
			?>
			</li>
		</ul>
	</div>
	<section class="panel_internal">
 		<div class="crud">
					<div class="crud_fila_principal">
						<span>
							Generalidades
						</span>
					</div>
					<div class="crud_fila_secundaria">
						<figure class="fondoAgregar">
							<?php
							echo $this->Html->image('recursos/escudo400.png', array('width' => '200px'));
							?>
						</figure>
						<article class='fichaAgregar'>
							<div class='entradas'>
								<div class="row">
									<label for="ProyectoCodigo" class="col-xs-12 col-sm-8">
										<strong>Codigo proyecto:</strong>
									</label>
									<div class="col-xs-12 col-sm-4">
										<?php echo $proyecto['Proyecto']['codigo'];?>
									</div>
								</div>
								<div class="row">
									<label for="ProyectoNombre" class="col-xs-12 col-sm-12">
										<strong>Titulo proyecto:</strong>
									</label>
								</div>
								<div class="row">
									<label for="facultad" class="col-xs-0 col-sm-1">
									</label>
									<div class="col-xs-12 col-sm-10">
										<?php echo $proyecto['Proyecto']['titulo'];?>
									</div>
									<label for="facultad" class="col-xs-0 col-sm-1">
									</label>
								</div>
								<div class="row">
									<label for="facultad" class="col-xs-12 col-sm-6">
										<strong>Facultad:</strong>
									</label>
									<div class="col-xs-12 col-sm-6">
										<?php echo $proyecto['Facultad']['nombre'];?>
									</div>
								</div>
								<div class="row">
									<label class="col-xs-12 col-sm-6">
										<strong>Programa académico:</strong>
									</label>
									<div class="col-xs-12 col-sm-6">
										<?php echo $proyecto['Programa']['nombre'];?>
									</div>
								</div>
								<div class="row">
									<label class="col-xs-12 col-sm-6">
										<strong>Área de investigación:</strong>
									</label>
									<div class="col-xs-12 col-sm-6">
										<?php echo $proyecto['Area']['nombre'];?>
									</div>
								</div>
								<div class="row">
									<label class="col-xs-12 col-sm-6">
										<strong>Línea de investigación:</strong>
									</label>
									<div class="col-xs-12 col-sm-6">
										<?php echo $proyecto['Linea']['nombre'];?>
									</div>
								</div>
							</div>
						</article>
					</div>
		</div>
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
?>
<script>
	$('#navicon-suitcase').css( "color", "#7a0400" );
</script>