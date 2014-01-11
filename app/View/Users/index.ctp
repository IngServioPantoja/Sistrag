<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

</head>
<?php $user=null;
?>
	
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>		 <?php   if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>

		<li><?php echo $this->Html->link(__('Agregar Usuario'), array('action' => 'add')); ?></li>
								<?php endif; ?>

	</ul>
</div>
<br/>



<table class="crud">
	<tr>
		<td>
			<div class="crud_fila_principal">
			<?php echo __('Usuarios'); ?>
			</div>
			<div class="crud_fila_secundaria">
				<table class="crud_fila_secundaria_contenido">
					<tr class="crud_fila_secundaria_contenido_fila_primaria">
						<th class="th_id"><?php echo $this->Paginator->sort('id'); ?></th>
						<th>username</th>
						<th><?php echo $this->Paginator->sort('nivel_id'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					<?php
$i=0;
foreach($users as $user):
$class=null;
if($i++ %2==0){
	$class='class="altrow"';
}
?>
<tr <?php echo $class;?>>
<td><?php echo $user['User']['id'];?>&nbsp;</td>
<td><?php echo $user['User']['username'];?>&nbsp;</td>	
<td>
			<?php echo $this->Html->link($user['Nivel']['nombre'], array('controller' => 'niveles', 'action' => 'view', $user['Nivel']['id'])); ?>
		</td>
<td class="actions">
<?php echo $this->Html->link('View',array('action'=>'view',$user['User']['id']));?>
 <?php if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1'): ?>
<?php echo $this->Html->link('Edit',array('action'=>'edit',$user['User']['id']));?>
<?php echo $this->Form->postLink('Delete',array('action'=>'delete',$user['User']['id']));?>
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





