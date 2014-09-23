<?php 
$user=NUll;
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<?php
			if($current_user['nivel_id'] == '1' || $current_user['nivel_id'] == '2' || $current_user['nivel_id'] == '3') 
			{
			?>
			<li>
				<span class="icon-list" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:12px;"></span>
				<?php 
				echo $this->Html->link(__('Puntos de control'), array('action' => 'cronogramas')); 
				?></li><li class="panel_menu_actual">
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
						Registrar punto de control
					</span>
				</div>
				<?php echo $this->Form->create('Control'); ?>
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
									<?php echo $this->Form->date('fecha',array('label'=>false,"autocomplete"=>"off",'required'=>'required','min'=>date('Y-m-d'))); ?>
									</div>
								</div>
								<div>
									<div>
										<strong><label for="PersonaApellido">Rol:</label></strong>
									</div>
									<div>
									<?php echo $this->Form->input('rol_id',array('label'=>false,"autocomplete"=>"off","class"=>"inputCorto")); ?>
									</div>
								</div>
								<div>
									<div>
										<strong><label for="PersonaEmail">Programa:</label></strong>
									</div>
									<div>
									<?php echo $this->Form->select("programa",
									   		array($programas),
									   		array('empty'=>false,"required" => "required",'autocomplete' =>'off',"class"=>"inputCorto",'id'=>'programa')
									   	); 
									?>
									</div>
								</div>
								<div>
									<div>
										<strong><label for="Estandar_id">Estandar:</label></strong>
									</div>
									<div id="estandar">
									<?php echo $this->Form->select("estandar_id",
									   		array($estandares),
									   		array('empty'=>false,"required" => "required",'autocomplete' =>'off',"class"=>"inputCorto")
									   	); 
									?>
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
$('#navicon-calendar').css( "background", "#7a0400" );
$('#marcicon-calendar').css( "color", "#7a0400" );
</script>
<?php
$this->Js->get('#programa')->event('change',
	$this->Js->request(
	    array(
	        'action' => 'estandar_programa',
	    ),
	    array(
	        'update'=>'#estandar',
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