<?php 
$user=NUll;
if(!$this->request->is('ajax'))
{
?> 	
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			
			<?php
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') 
			{
			?>
			<li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Proyectos'), array('action' => 'index')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Registrar Proyecto'), array('action' => 'add')); 
			}
				?>
			</li>
		</ul>
	</div>
	<section class="panel_internal">
		<div class="crud">
			<div class="crud_fila_principal">
				<div class="back">
					<?php
					echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
								array('escape' => false));
					?>

				</div>
				Proyectos a evaluar
			</div>
			<div id="contenedor_datos">
				<?php
				}
				?>						
					<div class="crud_fila_secundaria">
				<?php
					if(isset($encontrado)) 
					{
					?>
						<div class="no_hay_registros">
							<span>No se encontraron registros</span>
						</div>
				<?php
					}
				?>

				<div class="table-responsive">
					<table class="table" id="table">
						<thead>
							<tr>
								<th>
									Programa:
								</th>
								<th>
									Titulo:
								</th>
								<th>
									Integrantes:
								</th>
								<th>
									Asesor:
								</th>
								<th>
									Área y línea de investigación:
								</th>
								<th>
									Acciónes
								</th>
							</tr>	
						</thead>
						<tfoot>
							<tr>
								<th>
									Programa:
								</th>
								<th>
									Titulo:
								</th>
								<th>
									Integrantes:
								</th>
								<th>
									Asesor:
								</th>
								<th>
									Área y línea de investigación:
								</th>
								<th>
									Acciónes
								</th>
							</tr>
						</tfoot>	
						<tbody>
						<?php
						foreach ($proyectos as $proyecto)
						{
						?>
							<tr >
								<td>
									<?php echo h($proyecto['Programa']['nombre']); ?>
								</td>
								<td>
									<?php echo h($proyecto['Proyecto']['titulo']); ?>
								</td>
								<td>
								<?php
								foreach ($proyecto['Persona'] as $persona) 
								{
									if($persona['PersonasProyecto']['rol_id']==3)
									{

									?>
										<span>
									<?php
										echo $persona['nombre']." ".$persona['apellido'];
									?>
										</span>
									<?php
									}
								}
								?>
								</td>
								<td>
								<?php
								foreach ($proyecto['Persona'] as $persona) 
								{
									if($persona['PersonasProyecto']['rol_id']==2)
									{

									?>
									<span>
									<?php
										echo $persona['nombre']." ".$persona['apellido'];
									?>
									</span>
									</br>
									<?php
									}
								}
								?>	
								</td>
								<td>
									<?php echo h($proyecto['Area']['nombre'])	; ?>
									</br>
									<?php echo h($proyecto['Linea']['nombre'])	; ?>
								</td>
								<td>
									<?php
									echo $this->Html->link(
									    '
									    <button type="button" class="btn btn-default btn-lg use-tooltip" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
											<span class="glyphicon glyphicon-list-alt"></span>
										</button>
										',
									    array('controller'=>'proyectos', 'action'=>'documentos/'.$proyecto['Proyecto']['id']),
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
<?php
if(!$this->request->is('ajax'))
{
?>						
			</div>
		</div>
	</section>
</section>
<?php
}
?>
<script>
	$('#navicon-suitcase').css( "color", "#7a0400" );
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