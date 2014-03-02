<?php 
$user=NUll;
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			
				<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'|| $current_user['nivel_id'] == '2'|| $current_user['nivel_id'] == '3') {?>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Usuarios'), array('action' => 'index')); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Registrar Usuario'), array('action' => 'add')); }
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
							Registrar Usuario
						</span>
					</div>
					<?php echo $this->Form->create('Persona',array('type' => 'file')); ?>
						<div class="crud_fila_secundaria">
								<figure class="fondoAgregar">
									<?php
									echo $this->Html->image('recursos/escudo400.png', array('width' => '200px'));
									?>
								</figure>
							<article class='fichaAgregar'>
								<div class='entradas'>
									<div>
										<div>
											<strong><label for="PersonaAvatar">Avatar:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('avatar',array('type' => 'file',"label" => false,"class"=>"inputFile")); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="PersonaIdentificacion">Identificación:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('identificacion',array('label'=>false,"autocomplete"=>"off")); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="PersonaNombre">Nombres:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('nombre',array('label'=>false,"autocomplete"=>"off")); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="PersonaApellido">Apellidos:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('apellido',array('label'=>false,"autocomplete"=>"off")); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="PersonaEmail">E-Mail:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('email',array('label'=>false,"pattern"=>"[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9.-]+","autocomplete"=>"off")); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="PersonaTipousuario_id">Tipo de usuario:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('tiposusuario_id',array('label'=>false,"id"=>"tiposusuario_id","class"=>"inputCorto")); ?>
										</div>
									</div>
									<div id="asociacion">
									</div>
									<?php echo $this->Form->create('User'); ?>
									<div>
										<div>
											<strong><label for="PersonaNivel_id">Nivel de acceso:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('nivel_id',array('label'=>false,"id"=>"nivel_id","class"=>"inputCorto")); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="UserUsername">Username:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('username',array("label"=>false,"autocomplete"=>"off")); ?>
										</div>
									</div>		
									<div>
										<div>
											<strong><label for="UserPassword">Contraseña:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('rpassword',array('label'=>false,"autocomplete"=>"off","type"=>"password")); ?>
										</div>
									</div>	
									<div>
										<div>
											<strong><label for="UserPasswordconfirmacion">Confirmar contraseña:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('password',array('label'=>false,"autocomplete"=>"off","id"=>"UserPasswordconfirmacion")); ?>
										</div>
									</div>	
								</div>
							</article>
						</div>
					<?php echo $this->Form->end(__('Registrar')); ?>
				</td>
			</tr>
		</table>
	</section>
</section>
<script>
$('textarea').autosize();
function resizeInput() {
    $(this).attr('size', $(this).val().length+1);
}
$('#PersonaAddForm').submit(function validarPassword()
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
<?php
$this->Js->get('#tiposusuario_id')->event('change',
	$this->Js->request(
	    array(
	        'action' => 'lista_asociaciones',
	    ),
	    array(
	        'update'=>'#asociacion',
	        'async' => true,
	        'method' => 'post',
	        'dataExpression'=>true,
	        'data'=> $this->Js->serializeForm(array(
	            'isForm' => false,
	            'inline' => true
	        ))
	    )
	)
);
?>