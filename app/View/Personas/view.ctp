<div class="personas view">
<h2><?php  echo __('Persona '); echo '# ',h($persona['Persona']['id']); ?>
	<br/><t><?php echo  __('Nombre:  '); echo h($persona['Persona']['nombre']);?> </t>
</h2><br/>
 <?php echo __('Privilegios de '), h($persona['Tiposusuario']['nombre']); ?>
</div>
			<br/>

<?php $user=NUll;
?> 
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Personas'), array('action' => 'index')); ?> </li>

	</ul>
</div>
<!--
<table class="crud">
	<tr>
		<td>
			<div class="crud_fila_principal">

<div class="related">
	<h3><?php echo __('Usuarios relacionados'); ?></h3>
		</div>	
			   </div>
	<?php if (!empty($persona['User'])): ?>


<div class="crud_fila_secundaria">
				<table class="crud_fila_secundaria_contenido">
					<tr class="crud_fila_secundaria_contenido_fila_primaria">
						<th class="th_id"><?php echo __('Id'); ?></th>
						<th><?php echo __('Username'); ?></th>
						<th><?php echo __('Password'); ?></th>
						<th><?php echo __('Persona Id'); ?></th>
						<th><?php echo __('Nivel Id'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>


	<?php
		$i = 0;
		foreach ($persona['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['persona_id']; ?></td>
			<td><?php echo $user['nivel_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
			
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>

			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


-->
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



