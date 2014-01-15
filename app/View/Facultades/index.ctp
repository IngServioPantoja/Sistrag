<?php 
$user=NUll;
?> 	
<section class="panel_frame">
	<nav class="panel_menu">
		<ul>
			
				<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') {?>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Listar facultades'), array('action' => 'index')); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Agregar Facultad'), array('action' => 'add')); }
				?>
			</li>
		</ul>
	</nav>
	<section class="panel_internal">
		<table class="crud">
			<tr>
				<td>
					<div class="crud_fila_principal">
						Facultades
					</div>
					<div class="crud_fila_secundaria white">
						<?php foreach ($facultades as $facultad): ?>
						<a href="facultades/view/<?php  echo $facultad['Facultad']['id'];?>">
							<article class='ficha_index'>
								<figure>
									<?php
									echo $this->Html->image('img_subida/usuarios/1/1_400.jpg', array('alt' => 'Login','height' => '', 'width' => '200px'));
									?>
									<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
										<div class="ficha_acciones">
									<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'edit', $facultad['Facultad']['id']),
									array('escape' => false)); 
									?>
									<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $facultad['Facultad']['id']), array('escape' => false), __('¿Esta seguro que desea borrar la facultad de %s?', $facultad['Facultad']['nombre'])); ?>
										</div>
									<?php endif; ?>
								</figure>
						</a>
						<a href="facultades/view/<?php  echo $facultad['Facultad']['id'];?>">
								<div class='ficha_datos'>
									<table>
										<tr>
											<th>
												<span>
													Identificación
												</span>	
											</th>
											<td>
												<span>
													<?php echo h($facultad['Facultad']['id']); ?>
												</span>	
											</td>
										</tr>
										<tr>
											<th colspan="2">
												<span>
													Nombre
												</span>
											</th>
										</tr>
										<tr>
											<td colspan="2">
												<span>
													<?php echo h($facultad['Facultad']['nombre']); ?>
												</span>
											</td>
										</tr>
										<tr>
											<th colspan="2">
												<span>Programas asociados</span>
											</th>
										</tr>
										<tr>
											<td colspan="2">
												
											</td>
											<td>
												
											</td>
										</tr>
									</table>
								</div>
							</article>
						</a>
						<?php endforeach; ?>
						<table>
							<tr  >
							<td class="crud_fila_secundaria_contenido">
							  	<p>
								<?php
								echo $this->Paginator->counter(array(
								'format' => __('Pagina {:page} de {:pages}, observando {:current} registros de un total de {:count}')
								));
								?>	</p>
								<div class="paging">
								<?php

									echo $this->Paginator->prev('< ' . __('Anterior '), array(), null, array('class' => 'prev disabled'));
									echo $this->Paginator-> counter(array('separator' => ' de un total de  '));
									echo $this->Paginator->next(__('siguiente ') . ' >', array(), null, array('class' => 'next disabled'));
								?>
								</div>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</section>
</section>

