<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

</head>
<?php $user=NUll;
?> 	
<section class="panel_frame">
	<nav class="panel_menu">
		<ul>
			
				<?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): {?>
			<li>
				<img src="img/iconos/agregar16.png">
				<?php echo $this->Html->link(__('Agregar Facultad'), array('action' => 'add')); }?></li><li class="panel_menu_actual">
				<?php endif; ?>
				<img src="img/iconos/listar16.png">
				<?php echo $this->Html->link(__('Listar facultades'), array('action' => 'index')); ?>
			</li>
		</ul>
	</nav>
	<section class="panel_internal">
	<table class="crud">
		<tr>
			<td>
				<div class="crud_fila_principal">
					Facultades
				</div>
				<div class="crud_fila_secundaria">
					<table class="crud_fila_secundaria_contenido">
						<tr class="crud_fila_secundaria_contenido_fila_primaria">
							<th class="th_id"><?php echo $this->Paginator->sort('id'); ?></th>
							<th class="th_res"><?php echo $this->Paginator->sort('nombre'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
						<?php foreach ($facultades as $facultad): ?>
						<tr>
							<td><?php echo h($facultad['Facultad']['id']); ?>&nbsp;</td>
							<td><?php echo h($facultad['Facultad']['nombre']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link(__('View'), array('action' => 'view', $facultad['Facultad']['id'])); ?>
								 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
								<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $facultad['Facultad']['id'])); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $facultad['Facultad']['id']), null, __('Are you sure you want to delete # %s?', $facultad['Facultad']['id'])); ?>
								<?php endif; ?>
					
							</td>
						</tr>
						<?php endforeach; ?>
					</table>
					<table>
						<tr  >
						<td class="crud_fila_secundaria_contenido">
						  	<p>
							<?php
							echo $this->Paginator->counter(array(
							'format' => __('Pagina {:page} de {:pages}, observando {:current} registros de un total de {:count}')
							));
							?>	</p>
							<div class="paging">
							<?php

								echo $this->Paginator->prev('< ' . __('Anterior '), array(), null, array('class' => 'prev disabled'));
								echo $this->Paginator-> counter(array('separator' => ' de un total de  '));
								echo $this->Paginator->next(__('siguiente ') . ' >', array(), null, array('class' => 'next disabled'));
							?>
							</div>
							</td></tr>

									</table>
									
									
									</div>
								</td>

							</tr>
						</table>
	</section>
</section>

