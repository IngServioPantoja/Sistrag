<?php 
$user=NUll;
?> 	
<section class="panel_frame">
	<nav class="panel_menu">
		<ul>
			
				<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') {?>
			<li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Área de investigación'), array('action' => 'view',$area['Area']['id'])); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Líneas asociadas'), array('action' => 'lineas_asociadas',$area['Area']['id'])); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Agregar Línea'), array('action' => 'agregar_linea',$area['Area']['id'])); }
				?>
			</li>
		</ul>
	</nav>
	<section class="panel_internal">
		<table class="crud">
			<tr>
				<td>
					<div class="crud_fila_principal">
						<span>
							I.U.CESMAG.
						</span>
					</div>
					<div id="contenedor_datos">
						<div class="crud_fila_secundaria">
							<a href="areas/view/<?php  echo $area['Area']['id'];?>">
								<article class='ficha_view'>
									<figure>
										<?php
										echo $this->Html->image('recursos/escudo400.png', array('alt' => 'Login','height' => '', 'width' => '200px'));
										?>
										<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
											<div class="ficha_acciones">
										<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'edit', $area['Area']['id']),
										array('escape' => false)); 
										?>
										<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $area['Area']['id']), array('escape' => false), __('¿Esta seguro que desea borrar la facultad de %s?', $area['Area']['nombre'])); ?>
											</div>
										<?php endif; ?>
									</figure>
							</a>
							<a href="areas/view/<?php  echo $area['Area']['id'];?>">
									<div class='ficha_datos'>
										<table>
											<tr>
												<th colspan="2">
													<span>
														Identificación:
													</span>	
													<span>
														<?php echo h($area['Area']['id']); ?>
													</span>	
												</th>
											</tr>
											<tr>
												<th colspan="2">
													<span>
														Nombre facultad:
													</span>
												</th>
											</tr>
											<tr>
												<td colspan="2">
													<span>
														<?php echo h($area['Area']['nombre']); ?>
													</span>
												</td>
											</tr>
											<tr>
												<th colspan="2">
													<span>Líneas asociadas: </span>
													<span><?php echo " ".h($area['Area']['lineas']); ?></span>
												</th>
											</tr>
											<tr>
												<th colspan="2">
													<span>
														Descripción:
													</span>
												</th>
											</tr>
											<tr>
												<td colspan="2">
													<p>
														<?php echo h($area['Area']['descripcion']); ?>
													</p>
												</td>
											</tr>
										</table>
									</div>
								</article>
							</a>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</section>
</section>