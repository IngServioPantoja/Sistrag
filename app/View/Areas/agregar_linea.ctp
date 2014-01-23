<?php 
$user=NUll;
?>
<section class="panel_frame">
	<nav class="panel_menu">
		<ul>
			<?php   
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'|| $current_user['nivel_id'] == '2') 
			{
			?>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Área de investigación'), array('action' => 'view',$area['Area']['id'])); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Líneas asociadas'), array('action' => 'lineas_asociadas',$area['Area']['id'])); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Agregar Línea'), array('action' => 'agregar_linea',$area['Area']['id'])); 
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
							Agregar Línea de investigación
						</span>
					</div>
					<?php echo $this->Form->create('Linea'); ?>
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
											<b>área asociada:</b>
										</div>
										</br>
										<div>
										<?php echo $this->Form->input('area_id',array('label'=>false,'value'=>$area['Area']['id'])); ?>
										</div>
									</div>
									<div>
										<div>
											<b>Nombre Línea:</b>
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