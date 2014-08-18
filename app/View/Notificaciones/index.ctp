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
				<span class="glyphicon glyphicon-exclamation-sign" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:12px;"></span>
				<?php 
				echo $this->Html->link(__('Notificaciones'), array('action' => 'cronogramas')); 
				?>
			</li>
			<?php
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
					Notificaciones			
				</span>
			</div>
			<div class="crud_fila_secundaria table-responsive">
				<table id="tabla_fechas" class="table" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th>Fecha</th>
				            <th>Evento</th>
				            <th>Estado</th>
				            <th>Enlace</th>
				        </tr>
				    </thead>
				    <tfoot>
				        <tr>
				            <th>Fecha</th>
				            <th>Evento</th>
				            <th>Estado</th>
				            <th>Enlace</th>
				        </tr>
				    </tfoot>
				    <tbody>
				    	<?php
				    		foreach ($notificaciones as $notificacion) 
				    		{
				    	?>

				    		<tr>
				    			<td>
				    				<?php
				    					echo $notificacion['Notificacion']['fecha'];
				    				?>
				    			</td>
				    			<td>
				    				<?php
				    					echo $notificacion['ParametroNotificacion']['nombre'];
				    				?>
				    			</td>
				    			<td>
				    				<?php 
										echo $notificacion['ParametroEstado']['nombre']; 
									?>
				    			</td>
								<td>
									
									<?php
									echo $this->Html->link(
									    '
									    <button type="button" class="btn btn-default btn-lg use-tooltip" data-toggle="tooltip" data-placement="top" title="Ver">
											<span class="glyphicon glyphicon-eye-open"></span>
										</button>
										',
									    array('controller'=>$notificacion['Notificacion']['url_controlador'], 'action'=>$notificacion['Notificacion']['url_action']."/".$notificacion['Notificacion']['url_valor']),
									    array('escape' => FALSE,'class'=>'enlace','idnotificacion'=>$notificacion['Notificacion']['id'])
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
			"aaSorting": [[ 0, "desc" ]]
	    } );
		//ya actualiza ahora crearemo slink...


			$(".enlace").click(function(event) {
			  event.preventDefault();
			  var id=$(this).attr("idnotificacion");
			  var url=$(this).attr("href");
			  var respuesta=$.ajax
				(
					{
					  type: 'post',
			          dataType: 'json',
			          url: "<?php echo $this->Html->url(array('action' => 'actualizar_notificacion')); ?>",
					  data: 'id='+id,
					  beforeSend: function() {
						

					  }
					}
				);	

				respuesta.always(
					function() 
					{
						window.location = url;

					}
				);




			});
	});

</script>