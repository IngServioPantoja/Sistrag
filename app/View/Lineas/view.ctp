<?php 
$user=NUll;
?> 	
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			
			<?php   
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'|| $current_user['nivel_id'] == '2') 
			{
			?>
			<li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Línea de investigación'), array('action' => 'view',$linea['Linea']['id'])); 
			}
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
							<a href="lineas/view/<?php  echo $linea['Linea']['id'];?>">
								<article class='ficha_view'>
									<figure>
										<?php
										echo $this->Html->image('recursos/escudo400.png', array('alt' => 'Login','height' => '', 'width' => '200px'));
										?>
										<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
											<div class="ficha_acciones">
										<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'edit', $linea['Linea']['id']),
										array('escape' => false)); 
										?>
										<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $linea['Linea']['id']), array('escape' => false), __('¿Esta seguro que desea borrar la facultad de %s?', $linea['Linea']['nombre'])); ?>
											</div>
										<?php endif; ?>
									</figure>
							</a>
							<a href="lineas/view/<?php  echo $linea['Linea']['id'];?>">
									<div class='ficha_datos'>
										<table>
											<tr>
												<th colspan="2">
													<span>
														Identificación:
													</span>	
													<span>
														<?php echo h($linea['Linea']['id']); ?>
													</span>	
												</th>
											</tr>
											<tr>
												<th colspan="2">
													<span>
														Nombre Línea:
													</span>
												</th>
											</tr>
											<tr>
												<td colspan="2">
													<span>
														<?php echo h($linea['Linea']['nombre']); ?>
													</span>
												</td>
											</tr>
											<tr>
												<th colspan="2">
													<span>Área asociada: </span>
													<span><?php echo " ".h($linea['Area']['nombre']); ?></span>
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
														<?php echo h($linea['Linea']['descripcion']); ?>
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