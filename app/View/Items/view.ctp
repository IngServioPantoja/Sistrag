<div class="items view">
	<h2><?php  echo __('Item:  '); echo h($item['Item']['nombre']); ?>
	<br/>
	<?php echo  __('Extension de caracteres:  '); echo h($item['Item']['extencion_caracteres']); ?> </t>
<br/>
	<?php echo  __('Extension de lineas:  '); echo h($item['Item']['extencion_lineas']); ?> </t>
<br/>
 <?php echo  __('Descripcion:  '); echo h($item['Item']['descripcion']); ?>
</div>
			
</h2>


<br/>
<?php $user=NUll;
?> 	
	
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		
		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?> </li>
	
	</ul>
</div>
<br/>
<table class="crud">
	<tr>
		<td>
			<div class="crud_fila_principal">

<div class="related">
	<h3><?php echo __('Estandares relacionados'); ?></h3>
		</div>	
			   </div>
	<?php if (!empty($item['Estandar'])): ?>


<div class="crud_fila_secundaria">
				<table class="crud_fila_secundaria_contenido">
					<tr class="crud_fila_secundaria_contenido_fila_primaria">
						<th class="th_id"><?php echo __('Id'); ?></th>
						<th class="th_res"><?php echo __('Nombre'); ?></th>
						<th><?php echo __('Programa Id'); ?></th>
						<th><?php echo __('Tiposestandar Id'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>


	<?php
		$i = 0;
		foreach ($item['Estandar'] as $estandar): ?>
		<tr>
			<td><?php echo $estandar['id']; ?></td>
			<td><?php echo $estandar['nombre']; ?></td>
			<td><?php echo $estandar['programa_id']; ?></td>
			<td><?php echo $estandar['tiposestandar_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'estandares', 'action' => 'view', $estandar['id'])); ?>
								 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>

				<?php echo $this->Html->link(__('Edit'), array('controller' => 'estandares', 'action' => 'editar_estandar', $estandar['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'estandares', 'action' => 'delete', $estandar['id']), null, __('Are you sure you want to delete # %s?', $estandar['id'])); ?>
				<?php endif; ?>

			</td>
		</tr>
	<?php endforeach; ?>
	<?php endif; ?>
	</table>

<!--
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
-->