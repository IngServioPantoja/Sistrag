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
				<span class="glyphicon glyphicon-stats" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php 
				echo $this->Html->link(__('Reportes'), array('action' => 'index')); 
			}
			?>
		</ul>
	</div>
	<section class="panel_internal">
 		<div class="crud">
			<div class="crud_fila_principal" id="principal_proyecto">
				<div class="back">
					<?php
					echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
								array('escape' => false));
					?>

				</div>
				<span class="principal_titulo">
					Docentes		
				</span>
			</div>
			<div class="crud_fila_secundaria table-responsive">
				<table id="tabla_fechas" class="table" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th>Identificación</th>
				            <th>Nombre</th>
				            <th>Programa</th>
				            <th>Cargo</th>
				            <th>Reportes</th>
				        </tr>
				    </thead>
				    <tfoot>
				        <tr>
				            <th>Identificación</th>
				            <th>Nombre</th>
				            <th>Programa</th>
				            <th>Cargo</th>
				            <th>Reportes</th>
				        </tr>
				    </tfoot>
				    <tbody>
				    	<?php
				    		foreach ($personas as $persona) 
				    		{
				    	?>

				    		<tr>
				    			<td>
				    				<?php
				    					echo $persona['Persona']['identificacion'];
				    				?>
				    			</td>
				    			<td>
				    				<?php
				    					echo $persona['Persona']['nombre']." ".$persona['Persona']['apellido'];
				    				?>
				    			</td>
				    			<td>
				    				<?php
				    					echo $persona['Programa']['nombre'];
				    				?>
				    			</td>
				    			<td>
				    				<?php
				    					echo $persona['TipoUsuario']['nombre'];
				    				?>
				    			</td>
				    			<td>
									<?php
										echo $this->Form->create('Reporte');
										echo $this->Form->hidden('id',array('value'=>$persona['Persona']['id']));
										
										echo $this->Js->submit("Ver reporte", 
											array(
											    'url'=> array(
											    	'controller'=>'reportes',
											    	'action'=>'detalleReporteDocente'
										    ),
										    'update' => '#myModal',
										    'div' => false,
										    'type' => 'post',
										    'async' => false,
										    'class'=>'verReporte btn btn-default btn-lg use-tooltip',
										    'data'=> $this->Js->serializeForm(
										    	array(
										            'isForm' => false,
										            'inline' => true
									        	)
									        )
										));

										echo $this->Form->end();
									?>
				    			</td>
				    		</tr>
				    	<?php
				    		}

				    	?>
				    </tbody>
				</table>
			</div>
		</div>
 	</section>
</section>
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script>
	$('#navicon-stats').css( "background", "#7a0400" );
	$('#marcicon-stats').css( "color", "#7a0400" );
	$(document).ready(function () {
		$(".verReporte").click(function(){
			$('#myModal').modal('show');
		}

		);
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