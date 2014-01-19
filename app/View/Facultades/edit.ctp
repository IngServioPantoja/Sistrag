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
			<li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Facultad'), array('action' => 'index')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Programas asociados'), array('action' => 'programas_asociados')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Agregar programa'), array('action' => 'add')); 
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
						<span>
							Modificar facultad
						</span>
					</div>
					<?php echo $this->Form->create('Facultad'); ?>
						<div class="crud_fila_secundaria">
								<figure class="fondoAgregar">
									<?php
									echo $this->Html->image('recursos/escudo400.png', array('max-width' => '100%','height' => '100%'));
									?>
								</figure>
							<article class='fichaAgregar'>

								<div class='entradas'>
									<div>
										<div>
											<b>Nombre facultad:</b>
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
											<?php echo $this->Form->input('descripcion',array('type'=> 'textarea','label'=>false,'div'=>false)); ?>
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
    $("#element").expandingTextarea();
</script>