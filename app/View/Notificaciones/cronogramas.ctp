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
			<li class="panel_menu_actual">
				<span class="icon-list" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:12px;"></span>
				<?php 
				echo $this->Html->link(__('Puntos de control'), array('action' => 'cronogramas')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>				
				<?php 
				echo $this->Html->link(__('Registrar'), array('action' => 'add'));
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
					<div class="crud_fila_principal" id="principal_proyecto">
						<div class="back">
							<?php
							echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
										array('escape' => false));
							?>

						</div>
						<span class="principal_titulo">
							Fechas de control			
						</span>
					</div>
					<div class="crud_fila_secundaria">
						<table id="tabla_fechas" cellspacing="0" width="100%">
						    <thead>
						        <tr>
						            <th>Programa</th>
						            <th>Fecha</th>
						            <th>Documento</th>
						            <th>Receptor</th>
						            <th>Acciones</th>
						        </tr>
						    </thead>
						    <tfoot>
						        <tr>
						            <th>Programa</th>
						            <th>Fecha</th>
						            <th>Documento</th>
						            <th>Receptor</th>
						            <th>Acciones</th>
						        </tr>
						    </tfoot>
						    <tbody>
						    	<?php
						    		foreach ($controles as $control) 
						    		{
						    	?>

						    		<tr>
						    			<td>
						    				<?php
						    					echo $control['Estandar']['Programa']['nombre'];
						    				?>
						    			</td>
						    			<td>
						    				<?php
						    					echo $control['Control']['fecha'];
						    				?>
						    			</td>
						    			<td>
						    				<?php
						    					echo $control['Estandar']['nombre'];
						    				?>
						    			</td>
						    			<td>
						    				<?php
						    					echo $control['Rol']['nombre'];
						    				?>
						    			</td>
						    			<td>
						    				<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $control['Control']['id'])); ?>
											<?php echo $this->Html->link(__('Modificar'), array('action' => 'edit', $control['Control']['id'])); ?>
						    			</td>
						    		</tr>

						    	<?php
						    		}

						    	?>
						    </tbody>
						</table>
					</div>
				</td>
			</tr>
		</table>
 	</section>
</section>
<script>
	$('#navicon-suitcase').css( "background", "#7a0400" );
	$('#marcicon-suitcase').css( "color", "#7a0400" );
	$(document).ready(function () {
		var tabla=
		$('#tabla_fechas').dataTable( {
			"dom": '<"top"f>rt<"bottom"p><"clear">',
			"oLanguage": {
			"sSearch": "Busqueda",
			"sLengthMenu": '_MENU_',
			"sInfoEmpty": "No se han encontrado registros",
			"sZeroRecords": "No se han encontrado registros"
			},
	    } );

	});
</script>