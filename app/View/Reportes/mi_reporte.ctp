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
					Reporte: <?php echo $persona['Persona']['nombre']." ".$persona['Persona']['apellido']; ?>
				</span>
			</div>
			<div class="crud_fila_secundaria table-responsive">
				<?php
				$nombrePersona=$persona['Persona']['nombre']." ".$persona['Persona']['apellido'];
				?>
				<div class="modal-dialog modal-lg">
				  <div class="modal-content">
				    <div class="modal-body contenedor-grafica" id="container">
				    </div>
				  </div>
				</div>
				<script type="text/javascript">
			    var nombrePersona="<?php echo $nombrePersona; ?>";
				$(function () {
				    $('#container').highcharts({

				        chart: {
				            type: 'column',
				            options3d: {
				                enabled: true,
				                alpha: 15,
				                beta: 15,
				                viewDistance: 25,
				                depth: 40
				            },
				            marginTop: 80,
				            marginRight: 40
				        },

				        title: {
				            text: 'Trabajos asesorados y evaluados'
				        },

				        xAxis: {
				            categories: <?php echo $roles;?>
				        },

				        yAxis: {
				            allowDecimals: false,
				            min: 0,
				            title: {
				                text: 'Cantidad de trabajos de grado'
				            }
				        },

				        tooltip: {
				            headerFormat: '<b>{point.key}</b><br>',
				            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
				        },

				        plotOptions: {
				            column: {
				                stacking: 'normal',
				                depth: 40
				            }
				        },

				        series: [{
				            name: nombrePersona,
				            data: <?php echo $reporte; ?>
				        }]
				    });
				});
				</script>
			</div>
		</div>
 	</section>
</section>
<script>

	$('#navicon-suitcase').css( "background", "#7a0400" );
	$('#marcicon-suitcase').css( "color", "#7a0400" );

</script>