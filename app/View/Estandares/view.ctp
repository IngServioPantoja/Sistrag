<div class="estandares view">
<h2><?php  echo __('Estandar: '); echo h($estandar['Tiposestandar']['nombre']); echo __(' de ');

echo h($estandar['Estandar']['nombre']);

echo __(' del programa de '); echo h($estandar['Programa']['nombre']);

?></h2>
	
</div>
<br/>
<?php $user=NUll;
?> 
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>

		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
										<?php endif; ?>

	</ul>
</div>

<fieldset>
	<legend>Compocicion del estadnar</legend>
	<table>
		<tr>
			<th>
				Orden
			</th>
			<th>
				Item
			</th>
			<th>
				Padre
			</th>
		</tr>
			<?php
			foreach($itemsestandar as $i => $v){

			?>
		<tr>
			<td>
				
				<?php echo $v["ItemsEstandar"]["orden"];?>
            </td>
            <td>
            	<?php echo $v["Item"]["nombre"]; ?>
            </td>
            <td>
                <?php
                echo $v["ItemsEstandar"]["items_estandar_id"]; 

            ?>
        	</td>
        	<td>
				<?php 
					$ida=$v["ItemsEstandar"]["id"];
					$idb=h($estandar['Estandar']['id']);
				?>
        	</td>
<?php //hasta esta parte se muestra la compocicion del estandar ahora proseguiremos en caso de que se requiera agregar un nuevo item?>
		</tr>
			<?php
			}
			?>
	</table>
</fieldset>
<br/>


<!-- ***************CONTROLES***************

	<div class="related">
	<h3><?php echo __('Related Controles'); ?></h3>
	<?php if (!empty($estandar['Control'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Fecha'); ?></th>
		<th><?php echo __('Rol Id'); ?></th>
		<th><?php echo __('Estandar Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($estandar['Control'] as $control): ?>
		<tr>
			<td><?php echo $control['id']; ?></td>
			<td><?php echo $control['fecha']; ?></td>
			<td><?php echo $control['rol_id']; ?></td>
			<td><?php echo $control['estandar_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'controles', 'action' => 'view', $control['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'controles', 'action' => 'edit', $control['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'controles', 'action' => 'delete', $control['id']), null, __('Are you sure you want to delete # %s?', $control['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Control'), array('controller' => 'controles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

*********************************DOCUMENTOS****************************************


<div class="related">
	<h3><?php echo __('Related Documentos'); ?></h3>
	<?php if (!empty($estandar['Documento'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Fecha Guardado'); ?></th>
		<th><?php echo __('Enlace'); ?></th>
		<th><?php echo __('Estandar Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($estandar['Documento'] as $documento): ?>
		<tr>
			<td><?php echo $documento['id']; ?></td>
			<td><?php echo $documento['fecha_guardado']; ?></td>
			<td><?php echo $documento['enlace']; ?></td>
			<td><?php echo $documento['estandar_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'documentos', 'action' => 'view', $documento['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'documentos', 'action' => 'edit', $documento['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'documentos', 'action' => 'delete', $documento['id']), null, __('Are you sure you want to delete # %s?', $documento['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Documento'), array('controller' => 'documentos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

******************************* ITEMS************************************

<div class="related">
	<h3><?php echo __('Related Items'); ?></h3>
	<?php if (!empty($estandar['Item'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Extencion'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($estandar['Item'] as $item): ?>
		<tr>
			<td><?php echo $item['id']; ?></td>
			<td><?php echo $item['nombre']; ?></td>
			<td><?php echo $item['extencion']; ?></td>
			<td><?php echo $item['descripcion']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'items', 'action' => 'delete', $item['id']), null, __('Are you sure you want to delete # %s?', $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>



	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>


-->
