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
			<li>
				<span class="icon-list" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:12px;"></span>
				<?php 
				echo $this->Html->link(__('Puntos de control'), array('action' => 'cronogramas')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>				
				<?php 
				echo $this->Html->link(__('Registrar'), array('action' => 'add'));
				?>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
	<section class="panel_internal">
		<table class="crud">
		<tr>
			<td>
				<div class="crud_fila_principal">
					<span>
						Consultar punto de control
					</span>
				</div>
				<div class="crud_fila_secundaria">
					<figure class="fondoAgregar">
						<?php
						echo $this->Html->image('recursos/escudo400.png', array('width' => '150px'));
						?>
					</figure>
					<article class='fichaAgregar'>
						<div class='entradas'>
							<div>
								<div>
									<strong><label for="PersonaIdentificacion">Fecha:</label></strong>
								</div>
								<div>
								<?php echo h($control['Control']['fecha']); ?>
								</div>
							</div>
							<div>
								<div>
									<strong><label for="PersonaApellido">Rol:</label></strong>
								</div>
								<div>
								<?php echo h($control['Rol']['nombre']); ?>
								</div>
							</div>
							<div>
								<div>
									<strong><label for="PersonaEmail">Programa:</label></strong>
								</div>
								<div>
								<?php echo $control['Estandar']['Programa']['nombre']; ?>
								</div>
							</div>
							<div>
								<div>
									<strong><label for="Estandar_id">Estandar:</label></strong>
								</div>
								<div id="estandar">
								<?php echo $control['Estandar']['Tiposestandar']['nombre'].": ".$control['Estandar']['nombre']; ?>
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
	$('#navicon-calendar').css( "background", "#7a0400" );
	$('#marcicon-calendar').css( "color", "#7a0400" );
</script>