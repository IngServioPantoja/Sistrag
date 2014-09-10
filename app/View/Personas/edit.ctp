<?php 
$user=NUll;
?> 	
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<?php   
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'|| $current_user['nivel_id'] == '2'|| $current_user['nivel_id'] == '3') 
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
				<span class="glyphicon glyphicon-pencil" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php 
				echo $this->Html->link(__('Modificar usuario'), array('action' => 'edit',$persona['Persona']['id'])); 
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
							Modificar usuario
						</span>
					</div>
					<?php echo $this->Form->create('Persona',array('type' => 'file')); ?>
					<?php echo $this->Form->input('id'); ?>
						<div class="crud_fila_secundaria">
								<figure class="fondoAgregar">
									<?php
									echo $this->Html->image('recursos/escudo400.png', array('width' => '220px'));
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
										<?php echo $this->Form->input('identificacion',array('label'=>false,"autocomplete"=>"off",'required'=>'required')); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="PersonaNombre">Nombres:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('nombre',array('label'=>false,"autocomplete"=>"off",'required'=>'required')); ?>
										</div>
									</div>
									<div>
										<div>
											<strong><label for="PersonaApellido">Apellidos:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('apellido',array('label'=>false,"autocomplete"=>"off",'required'=>'required')); ?>
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
										<?php echo $this->Form->input('tiposusuario_id',array('label'=>false,"id"=>"tiposusuario_id","class"=>"inputCorto",'required'=>'required','empty'=>'seleccionar')); ?>
										</div>
									</div>
									<div id="asociacion">
										<div>
											
										</div>
										<div>
											
										</div>
									</div>
									<?php echo $this->Form->create('User'); ?>
									<?php echo $this->Form->input('id'); ?>
									<div>
										<div>
											<strong><label for="PersonaNivel_id">Nivel de acceso:</label></strong>
										</div>
										<div>
										<?php echo $this->Form->input('nivel_id',array('label'=>false,"id"=>"nivel_id","class"=>"inputCorto")); ?>
										</div>
									</div>
								</div>
							</article>
						</div>
					<?php echo $this->Form->end(__('Submit')); ?>
				</td>
			</tr>
		</table>
	</section>
</section>
<script>
$('#navicon-group').css( "background", "#7a0400" );
$('#marcicon-group').css( "color", "#7a0400" );
$('textarea').autosize();
function resizeInput() {
    $(this).attr('size', $(this).val().length+1);
}
$('input[type="text"]')
    .keyup(resizeInput)
    .each(resizeInput);
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