<?php 
$user=NUll;
?>
<section class="panel_frame">
	<section class="panel_internal">
		<div class="crud">
			<div class="crud_fila_principal">
				<div class="back">
					<?php
					echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
								array('escape' => false));
					?>
				</div>
				Entregas pendientes por evaluar
			</div>
			<div id="contenedor_datos">
				<div class="crud_fila_secundaria">
					<div class="table-responsive">
						<table class="table" id="table">
							<thead>
								<tr>
									<th>
										Fecha:
									</th>
									<th>
										Proyecto:
									</th>
									<th>
										Estado:
									</th>
									<th>
										Acciones:
									</th>
								</tr>	
							</thead>
							<tfoot>
								<tr>
									<th>
										Fecha:
									</th>
									<th>
										Proyecto:
									</th>
									<th>
										Estado:
									</th>
									<th>
										Acciones:
									</th>
								</tr>
							</tfoot>	
							<tbody>
							<?php
							foreach ($detalleentregas as $detalleentrega)
							{
							?>
								<tr >
									<td>
										<?php echo h($detalleentrega['Entrega']['fecha_entrega']); ?>
									</td>
									<td>
										<?php echo h($detalleentrega['Proyecto']['titulo']); ?>
									</td>
									<td>
									<?php
										echo h($detalleentrega['Estado']['nombre']);
									?>
									</td>
									<td>
										<?php
										echo $this->Html->link(
										    '
										    <button type="button" class="btn btn-default btn-lg use-tooltip" data-toggle="tooltip" data-placement="top" title="Revizar documento">
												<span class="glyphicon glyphicon-list-alt"></span>
											</button>
											',
										    array('controller'=>'documentos', 'action'=>'evaluacion_docente/'.$detalleentrega['Detalleentrega']['id']),
										    array('escape' => FALSE)
										);
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
			</div>
		</div>
	</section>
</section>
<script>
	$('.glyphicon-open').css( "background", "#7a0400" );
$(document).ready(function() {
    $('#table').dataTable( {
        "dom": '<"top"fl>rt<"bottom"pi>',
        "oLanguage": {
	  	"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_",
		"sZeroRecords": "No se encontraron resultados",
		"sInfo": "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
		"sInfoEmpty": "No existen registros",
		"sInfoFiltered": "(filtrado de un total de _MAX_ líneas)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"sUrl": "",
		"oPaginate": {
			"sFirst":    "Primero",
			"sPrevious": "Anterior",
			"sNext":     "Siguiente",
			"sLast":     "Último"
			}
		}
    } );
} );
</script>	