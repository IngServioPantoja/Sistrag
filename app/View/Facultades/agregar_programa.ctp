<?php 
$user=NUll;
?>
<section class="panel_frame">
	<nav class="panel_menu">
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
				echo $this->Html->link(__('Facultad'), array('action' => 'view',$facultad['Facultad']['id'])); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Programas asociados'), array('action' => 'programas_asociados',$facultad['Facultad']['id'])); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Agregar programa'), array('action' => 'agregar_programa',$facultad['Facultad']['id'])); 
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
						<?php echo $this->Form->create('Busqueda'); ?>
						<span>
							Agregar programa
						</span>
					</div>
					<?php echo $this->Form->create('Programa'); ?>
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
											<b>Facultad asociada:</b>
										</div>
										</br>
										<div>
										<?php echo $this->Form->input('facultad_id',array('label'=>false,'value'=>$facultad['Facultad']['id'])); ?>
										</div>
									</div>
									<div>
										<div>
											<b>Nombre programa:</b>
										</div>
										<div>
										<?php echo $this->Form->input('nombre',array('label'=>false)); ?>
										</div>
									</div>
									<div>
										<div>
											<b>Descripción:</b>
										</div>
										<div class="divTextarea">
											<?php echo $this->Form->input('descripcion',array('type'=> 'textarea','label'=>false,'div'=>false,'rows'=>'8')); ?>
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
$('textarea').autosize();
function resizeInput() {
    $(this).attr('size', $(this).val().length+1);
}
$('input[type="text"]')
    .keyup(resizeInput)
    .each(resizeInput);
</script>