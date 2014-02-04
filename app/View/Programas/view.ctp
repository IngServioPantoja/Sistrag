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
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Programa'), array('action' => 'view',$programa['Programa']['id'])); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Áreas asociadas'), array('action' => 'areas_asociadas',$programa['Programa']['id'])); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Agregar Área'), array('action' => 'agregar_area',$programa['Programa']['id'])); 
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
							<article class='ficha_view'>
								<figure>
									<?php
									echo $this->Html->image('recursos/escudo400.png', array('alt' => 'Login','height' => '', 'width' => '200px'));
									?>
									<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
										<div class="ficha_acciones">
									<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'edit', $programa['Programa']['id']),
									array('escape' => false)); 
									?>
									<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $programa['Programa']['id']), array('escape' => false), __('¿Esta seguro que desea borrar la facultad de %s?', $programa['Programa']['nombre'])); ?>
										</div>
									<?php endif; ?>
								</figure>
								<div class='ficha_datos'>
									<table>
										<tr>
											<th colspan="2">
												<span>
													Identificación:
												</span>	
												<span>
													<?php echo h($programa['Programa']['id']); ?>
												</span>	
											</th>
										</tr>
										<tr>
											<th colspan="2">
												<span>
													Codigo SNIES:
												</span>	
												<span>
													<?php echo h($programa['Programa']['codigo SNIES']); ?>
												</span>	
											</th>
										</tr>										<tr>
											<th colspan="2">
												<span>
													Facultad:
												</span>	
												<span>
													<?php echo h($programa['Facultad']['nombre']); ?>
												</span>	
											</th>
										</tr>
										<tr>
											<th colspan="2">
												<span>
													Nombre programa:
												</span>
											</th>
										</tr>
										<tr>
											<td colspan="2">
												<span>
													<?php echo h($programa['Programa']['nombre']); ?>
												</span>
											</td>
										</tr>
										<tr>
											<th colspan="2">
												<span>Áreas asociadas: </span>
												<span><?php echo " ".h($programa['Programa']['areas']); ?></span>
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
													<?php echo h($programa['Programa']['descripcion']); ?>
												</p>
											</td>
										</tr>
									</table>
								</div>
							</article>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</section>
</section>