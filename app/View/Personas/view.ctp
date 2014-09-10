<?php 
$user=NUll;
?> 	
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'|| $current_user['nivel_id'] == '2'|| $current_user['nivel_id'] == '3') {
			?>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Usuarios'), array('action' => 'index')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Registrar Usuario'), array('action' => 'add')); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/consultar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Usuario'), array('action' => 'view',$persona['Persona']['id'])); 
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
						<span>
							Consultar usuario
						</span>
					</div>
					<div class="crud_fila_secundaria">
						<article class='fichaAgregar'>
							<figure class="consultar_img">
								<?php
								$destino = WWW_ROOT."img/img_subida/usuarios/".$persona['Persona']['id']."".DS;
								if (file_exists($destino))
								{
									$urlImagen="img_subida/usuarios/".$persona['Persona']['id']."/1_400.png";
								}
								else
								{
									$urlImagen="recursos/escudo400.png";
								}
								echo $this->Html->image($urlImagen, array('alt' => 'Login','height' => '200px', 'width' => '200px'));
								?>
							</figure>
							<div class='entradas'>
								<div>
									<div>
										<strong><label for="PersonaIdentificacion">Identificación:</label></strong>
									</div>
									<div>
									<?php echo h($persona['Persona']['identificacion']); ?>
									</div>
								</div>
								<div>
									<div>
										<strong><label for="PersonaNombre">Nombres:</label></strong>
									</div>
									<div>
									<?php echo h($persona['Persona']['nombre']); ?>
									</div>
								</div>
								<div>
									<div>
										<strong><label for="PersonaApellido">Apellidos:</label></strong>
									</div>
									<div>
									<?php echo h($persona['Persona']['apellido']); ?>
									</div>
								</div>
								<div>
									<div>
										<strong><label for="PersonaEmail">E-Mail:</label></strong>
									</div>
									<div>
									<?php echo h($persona['Persona']['email']); ?>
									</div>
								</div>
								<div>
									<div>
										<strong><label for="PersonaTipousuario_id">Tipo de usuario:</label></strong>
									</div>
									<div>
									<?php echo $persona['Nivel']['nombre']; ?>
									</div>
								</div>
								<div id="asociacion">
									<div>
										
									</div>
									<div>
										
									</div>
								</div>
								<div>
									<div>
										<strong><label for="PersonaNivel_id">Nivel de acceso:</label></strong>
									</div>
									<div>
									<?php echo $persona['Tiposusuario']['nombre']; ?>
									</div>
								</div>
							</div>
						</article>
					</div>
				</td>
			</tr>
		</table>
	</section>
</section>
<script>
$('#navicon-group').css( "background", "#7a0400" );
$('#marcicon-group').css( "color", "#7a0400" );
</script>