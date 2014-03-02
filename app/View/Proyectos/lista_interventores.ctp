<?php
	foreach ($proyecto['Integrantes'] as $integrante) 
	{	
		if($integrante['PersonasProyecto']['rol_id']==2)
		{
		?>
		<article class='ficha_index'>
			<a href="personas/view/<?php  echo $integrante['Persona']['id'];?>">
				<figure>
					<?php
					$destino = WWW_ROOT."img/img_subida/usuarios/".$integrante['Persona']['id']."".DS;
					if (file_exists($destino))
					{
						$urlImagen="img_subida/usuarios/".$integrante['Persona']['id']."/1_400.png";
					}
					else
					{
						$urlImagen="recursos/escudo400.png";
					}
					echo $this->Html->image($urlImagen, array('alt' => 'Login','height' => '200px', 'width' => '200px'));
					?>
						<div class="ficha_acciones">
					<?php echo $this->Html->link($this->Html->image("iconos/update50.png", array('height' => '', 'width' => '25px')), array('action' => 'edit', $integrante['Persona']['id']),
					array('escape' => false)); 
					?>
					<?php echo $this->Form->postLink($this->Html->image("iconos/eliminar50.png", array('height' => '', 'width' => '25px')), array('action' => 'delete', $integrante['Persona']['id']), array('escape' => false), __('¿Esta seguro que desea borrar el usuario %s?', $integrante['Persona']['nombre']." ".$integrante['Persona']['apellido'])); ?>
						</div>
				</figure>
			</a>
			<a href="personas/view/<?php  echo $integrante['Persona']['id'];?>">
				<div class='ficha_datos'>
					<table>
						<tr>
							<th colspan="2">
								<span>
									Nombres y apellidos:
								</span>
							</th>
						</tr>
						<tr>
							<td colspan="2">
								<span>
									<?php echo h($integrante['Persona']['nombre']." ".$integrante['Persona']['apellido']); ?>
								</span>
							</td>
						</tr>
						<tr>
							<th colspan="2">
								<span>
									Programa:
								</span>
							</th>
						</tr>
						<tr>
							<td colspan="2">
								<span>
									<?php echo h($integrante['Programa']['nombre']); ?>
								</span>
							</td>
						</tr>
					</table>
				</div>
			</a>
		</article>
		<?php
		}
	}
?>