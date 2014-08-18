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
				echo $this->Html->link(__('Registrar usuario'), array('action' => 'add')); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
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
							Cambiar contraseña
						</span>
					</div>
						<div class="crud_fila_secundaria">
							<figure class="fondoAgregar">
								<?php
								echo $this->Html->image('recursos/escudo400.png', array('width' => '220px'));
								?>
							</figure>
							<article class='fichaAgregar'></br></br></br></br></br>
								<div class='entradas'>
									<?php echo $this->Form->create('User'); ?>
									<?php echo $this->Form->input('id'); ?>
									<div>
										<div>
											<strong><label for="UserPassword">Contraseña:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('rpassword',array('label'=>false,"autocomplete"=>"off","type"=>"password",'value'=>'','required'=>'required')); ?>
										</div>
									</div>	
									<div>
										<div>
											<strong><label for="UserPasswordconfirmacion">Confirmar contraseña:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('password',array('label'=>false,"autocomplete"=>"off","id"=>"UserPasswordconfirmacion",'value'=>'','required'=>'required')); ?>
										</div>
									</div>
								</div></br></br></br></br>
							</article>
						</div>
					<?php echo $this->Form->end(__('Actualizar')); ?>
				</td>
			</tr>
		</table>
	</section>
</section>
<script>

$('#UserEditarContrasenaForm').submit(function validarPassword()
	{
		var password= $('#UserPasswordconfirmacion').val();
		var rpassword= $('#UserRpassword').val();
		if(rpassword===password)
		{
			return true;
		}
		else
		{
			alert("Las contraseñas no coinciden por favor intente de nuevo");
			return false
		}
	}
);
</script>