<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

</head>
<?php $user=NUll;
?> 
	
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
					 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>

		<li><?php echo $this->Html->link(__('Agregar Estandar'), array('action' => 'add')); ?></li>
					<?php endif; ?>

	</ul>
</div>
<br/>



<table class="crud">
	<tr>
		<td>
			<div class="crud_fila_principal">
			<?php echo __('Estandares'); ?>
			</div>
			<div class="crud_fila_secundaria">
				<table class="crud_fila_secundaria_contenido">
					<tr class="crud_fila_secundaria_contenido_fila_primaria">
						<th class="th_id"><?php echo $this->Paginator->sort('id'); ?></th>
						<th class="th_res"><?php echo $this->Paginator->sort('nombre'); ?></th>
						<th><?php echo $this->Paginator->sort('programa_id'); ?></th>
						<th><?php echo $this->Paginator->sort('tiposestandar_id'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($estandares as $estandar): ?>
	<tr>
		<td><?php echo h($estandar['Estandar']['id']); ?>&nbsp;</td>
		<td><?php echo h($estandar['Estandar']['nombre']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($estandar['Programa']['nombre'], array('controller' => 'programas', 'action' => 'view', $estandar['Programa']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($estandar['Tiposestandar']['nombre'], array('controller' => 'tiposestandares', 'action' => 'view', $estandar['Tiposestandar']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $estandar['Estandar']['id'])); ?>
								 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>

			<?php echo $this->Html->link(__('Edit'), array('action' => 'editar_estandar', $estandar['Estandar']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $estandar['Estandar']['id']), null, __('Are you sure you want to delete # %s?', $estandar['Estandar']['id'])); ?>
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



