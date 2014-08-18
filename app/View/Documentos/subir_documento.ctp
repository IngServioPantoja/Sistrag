<?php 
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
				<li class="panel_menu_actual">
				<span class="icon-cloudy" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Subir documento'), array('controller'=>'documentos','action' => 'subir_documento',$proyecto['Proyecto']['id'])); 
				?></li>
				<?php
				}
				if($current_user['nivel_id'] == '1' || $current_user['nivel_id'] == '2' || $current_user['nivel_id'] == '3') 
				{
				?>
				<li>
				<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Datos generales'), array('controller'=>'proyectos','action' => 'editar_general',$proyecto['Proyecto']['id'])); 
				?></li><li>
				<span class="icon-group" style="color:#ddd;text-shadow:0px 0px 4px #222;"></span>
				<?php 
				echo $this->Html->link(__('Integrantes'), array('controller'=>'proyectos','action' => 'editar_integrantes',$proyecto['Proyecto']['id']));
				?>
				</li>
				<?php
				}else
				{
				?>
				<li>
				<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
				<?php 
				echo $this->Html->link(__('Datos generales'), array('controller'=>'proyectos','action' => 'detallar_general',$proyecto['Proyecto']['id'])); 
				?></li><li>
				<span class="icon-group" style="color:#ddd;text-shadow:0px 0px 4px #222;"></span>
				<?php 
				echo $this->Html->link(__('Integrantes'), array('controller'=>'proyectos','action' => 'detallar_integrantes',$proyecto['Proyecto']['id']));
				?>
				</li>
				<?php
				}
				?>
		</ul>
	</nav>
	<section class="panel_internal">
		<table class="crud">
			<tr>
				<td>
					<?php echo $this->Form->create('Documento',array('type' => 'file')); ?>
					<div class="crud_fila_principal">
						<span>Documento: 
						<?php 
						echo $proyecto['Proyecto']['titulo'];
						?>
						</span>
					</div>
					<div class="crud_fila_secundaria">
							<fieldset class='ficha_add'>
								<div>
									<fieldset>
										<legend>
											Subir documento
										</legend>
									<?php
									echo $this->Form->input('documentoxml',array('type' => 'file',"label" => false));
									?>
									</fieldset>
								</div>
								<div>
									<fieldset>
										<legend>
											Tipo de documento
										</legend>
										<?php echo $this->Form->input('estandar_id',array('label' =>false,'class'=>'inputCorto')); ?>	
									</fieldset>
								</div>
							</fieldset>
					</div>
					<?php echo $this->Form->end(__('Subir')); ?>
				</td>
			</tr>
		</table>
	</section>
</section>
<script>
	$('#navicon-suitcase').css( "background", "#7a0400" );
	$('#marcicon-suitcase').css( "color", "#7a0400" );
</script>