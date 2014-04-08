<?php 
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php echo $this->Html->link(__('Documentos'), array('controller'=>'proyectos','action' => 'documentos', $proyecto['Proyecto']['id'])); ?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php echo $this->Html->link(__('Subir documento'), array('action' => 'subir_documento', $proyecto['Proyecto']['id'])); ?>
			</li>
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
