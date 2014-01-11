<table class="crud">
	<tr>
		<td>
			<div class="crud_fila_principal">
				
				<h2>
					<div class="div_1">
						Items &nbsp;&nbsp;&nbsp;&nbsp;busqueda : &nbsp;&nbsp;
						Atributo&nbsp;
						<input type="text">&nbsp;&nbsp;
						Valor&nbsp;
						<input type="text">
					</div>
					<div class="div_2">
						<?php echo $this->Html->link(__('Nuevo'), array('action' => 'add')); ?>
					</div>
				</h2>
			</div>
			<div class="crud_fila_secundaria">
				<table class="crud_fila_secundaria_contenido">
					<tr class="crud_fila_secundaria_contenido_fila_primaria">
						<th class="th_id"><?php echo $this->Paginator->sort('id'); ?></th>
						<th class="th_res"><?php echo $this->Paginator->sort('nombre','Item'); ?></th>
						<th class="th_res"><?php echo $this->Paginator->sort('extencion_caracteres','Caracteres'); ?></th>
						<th class="th_res"><?php echo $this->Paginator->sort('extencion_lineas','Líneas'); ?></th>
						<th class="th_res"><?php echo $this->Paginator->sort('programa_id'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($items as $item): ?>
					<tr>
						<td><?php echo h($item['Item']['id']); ?>&nbsp;</td>
						<td><?php echo h($item['Item']['nombre']); ?>&nbsp;</td>
						<td><?php echo h($item['Item']['extencion_caracteres']); ?>&nbsp;</td>
						<td><?php echo h($item['Item']['extencion_lineas']); ?>&nbsp;</td>
						<td>
						<?php echo $this->Html->link(__(h($item['Programa']['nombre'])), 
							array(
								'controller' => 'itemsprograma',
								'action' => 'lista', 
								$item['Programa']['id']
								)
							); 
						?>
						</td>
						<td class="actions">
							<?php echo $this->Html->link(__('View'), array('action' => 'view', $item['Item']['id'])); ?>
							<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $item['Item']['id'])); ?>
							<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['id'])); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<th colspan="8">
							<?php
								echo $this->Paginator->counter(array(
								'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
								));
							?>
							<?php
								echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
								echo $this->Paginator->numbers(array('separator' => ''));
								echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
							?>
						</th>
					</tr>
				</table>
			<div>
		</td>
	</tr>
</table>