<?php 
$user=NUll;
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<li>
			<?php
			echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
			?>
			<?php 
			echo $this->Html->link(__('Listar programas'), array('action' => 'index')); 
			?></li>
			<?php
			if($current_user['nivel_id'] == '1'|| $current_user['nivel_id'] == '2') 
			{
			?>
			<li class="panel_menu_actual">
			<?php
			echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
			?>

			<?php 
			echo $this->Html->link(__('Agregar Programa'), array('action' => 'add')); 
			}
			?>
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
											<b>Codigo SNIES:</b>
										</div>
										<div>
										<?php echo $this->Form->input('codigo SNIES',array('label'=>false)); ?>
										</div>
									</div>
									<div>
										<div>
											<b>Facultad asociada:</b>
										</div>
										</br>
										<div>
										<?php echo $this->Form->input('facultad_id',array('label'=>false)); ?>
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
					<?php echo $this->Form->end(__('Guardar')); ?>
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