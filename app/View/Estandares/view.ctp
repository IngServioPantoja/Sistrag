<?php 
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
				<?php
				echo $this->Html->image('iconos/listar32.png', array('title' => 'Listar Estandares','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Estandar'), array('action' => 'index')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/update40.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Actualizar datos'), array('controller'=>'estandares','action' => 'editar_estandar',$estandar['Estandar']['id'])); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/update40.png', array('title' => 'Registrar Estandar','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Modificar estructura'), array('action' => 'editar_composicion',$estandar['Estandar']['id'])); 
			}
				?>
			</li>
		</ul>
	</div>
	<section class="panel_internal">
		<table class="crud">
			<tr>
				<td>
					<div class="crud_fila_principal">
						<div class="back">
							<?php
							echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
										array('escape' => false));
							?>
						</div>
						<span class="principal_titulo">
							Consultar estandar
						</span>
					</div>
					<div id="contenedor_datos">
						<div class="crud_fila_secundaria">
							<div class="div_estandar_programa">
								<span class="programa">
								<span class="icon-file-settings icono_izquierda_pequeño">
								</span>	
								<?php
									echo h($estandar['Tiposestandar']['nombre']).": ";
									echo h($estandar['Estandar']['nombre']);
									?>
								</span>
								<div class="ficha_acciones_estandar" id="acciones_estandar">
									<?php 
									echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete',$estandar['Estandar']['id']), array('escape' => false,'title'=>'Eliminar Estandar'), __('¿Esta seguro que desea borrar el estandar para: '.$estandar['Tiposestandar']['nombre']." ".$estandar['Estandar']['nombre']."?")); 
									?>
								</div>
								</br></br>
								<article class='ficha_index' id="fichaIndexInformacionGeneral">
									<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'){ ?>
									<div class="ficha_acciones" id="acciones_estandar">
										<?php 
										echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'editar_estandar',$estandar['Estandar']['id']),
								array('escape' => false,'title'=>'Modificar Estandar'));
								?>
									</div>
									<?php 
									} 
									?>
										<span class="estandar">
											Información general
										</span>	
										<table class="informacion_proyecto">
											<tr>
												<td colspan="2">
													
												</td>
											</tr>
											<tr class="tr_border_bottom_blue" title="Programa académico">
												<td>
													<span class="icon-library icono_16px azulOscuro">
													</span>
												</td>
												<td>
													<span>
														<?php
															echo h($estandar['Programa']['nombre']);
														?>
													</span>
												</td>
											</tr>
											<tr class="estandar_vigencia_inicio" title="Vigencia inicio">
												<td >
													<span>
														<?php
															echo $this->Html->image("iconos/calendariogreen64.png", array('height' => '', 'width' => '32px'))
														?>
													</span>	
												</td>
												<td>
													<strong>
														<?php
															echo h($estandar['Estandar']['inicio vigencia']);
														?>
													</strong>	
												</td>
											</tr>
											<tr class="estandar_vigencia_fin" title="Vigencia fin">
												<td>
													<span>
														<?php
															echo $this->Html->image("iconos/calendariorojo64.png", array('height' => '', 'width' => '32px'))
														?>
													</span>	
												</td>
												<td>
													<strong>
														<?php
															echo h($estandar['Estandar']['fin vigencia']);
														?>
													</strong>	
												</td>
											</tr>
											<tr>
												<td colspan="2">
												</td>
											</tr>
										</table>
								</article>
								<article class='ficha_index' id="fichaIndexInformacionGeneral">
									<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'){ ?>
									<div class="ficha_acciones" id="acciones_estandar">
										<?php 
										echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'editar_composicion',$estandar['Estandar']['id']),array('escape' => false,'title'=>'Modificar composición'));
										?>
									</div>
									<?php 
									} 
									?>
									<span class="estandar">
										Estructura
									</span>	
									</br></br>
									<div class="itemsDocumento">
										<div class="tituloItemsDocumento">
											<div class="orden">Orden</div><div class="item">
											Item</div><div class="lineas">
											Líneas</div><div class="caracteres">
											Caracteres</div>
										</div>
										<?php
										foreach($itemsestandar as $item => $v)
										{
										?>
											<div class="contenidoItemsDocumento">
											<div class="orden"><?php echo $v["ItemsEstandar"]["orden"];?></div><div class="item">
											<?php echo $v["Item"]["nombre"]; ?></div><div class="lineas">
											<?php echo $v["Item"]["extencion_lineas"]; ?></div><div class="caracteres">
											<?php echo $v["Item"]["extencion_caracteres"]; ?></div>
											</div>
										<?php
										}
										?>
									</div>
								</article>
								<div class="descargar_plantilla" title="Descargar maqueta XML">
									<a>
										<span>
											Descargar Estandar
										</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</section>
</section>
<script>
	$('#navicon-file-settings').css( "background", "#7a0400" );
	$('#marcicon-file-settings').css( "color", "#7a0400" );
</script>