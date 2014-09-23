<?PHP 
$user=NUll;
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<li class="panel_menu_actual">
				<span class="glyphicon glyphicon-stats" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php 
				echo $this->Html->link(__('Reportes'), array('action' => 'index')); 
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
					Programas académico		
				</span>
			</div>
			<div class="crud_fila_secundaria table-responsive">
				<table id="tabla_fechas" class="table" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th>Facultad</th>
				            <th>Programa</th>
				            <th>Reportes</th>
				        </tr>
				    </thead>
				    <tfoot>
				        <tr>
				            <th>Facultad</th>
				            <th>Programa</th>
				            <th>Reportes</th>
				        </tr>
				    </tfoot>
				    <tbody>
				    	<?php
				    		foreach ($programas as $programa) 
				    		{
				    	?>

				    		<tr>
				    			<td>
				    				<?php
				    					echo $programa['Facultad']['nombre'];
				    				?>
				    			</td>
				    			<td>
				    				<?php
				    					echo $programa['Programa']['nombre'];
				    				?>
				    			</td>
				    			<td>
									<?php
										echo $this->Form->create('Reporte');
										echo $this->Form->hidden('id',array('value'=>$programa['Programa']['id']));
										
										echo $this->Js->submit("Ver", 
											array(
											    'url'=> array(
											    	'controller'=>'reportes',
											    	'action'=>'detalleReportePrograma'
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
	$('#navicon-stats').css( "background", "#7a0400" );
	$('#marcicon-stats').css( "color", "#7a0400" );
	});
</script>