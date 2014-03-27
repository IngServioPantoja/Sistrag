<div class="estandares form">

	<fieldset>
		<legend>Datos generales Estandar</legend>
	<?php
		echo "</br>";
		echo "Estandar ".$Estandar["Estandar"]["nombre"];
		echo "</br>";
		echo "Tipo de estandar ".$Estandar["Tiposestandar"]["nombre"];
		echo "</br>";
		echo "Programa ".$Estandar["Programa"]["nombre"];
		echo "</br>";
	?>
	</fieldset>
	<fieldset>
	<legend>Compocicion del estadnar</legend>

	<table>
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
				$idb=$Estandar["Estandar"]["id"];


				echo $this->Form->postLink(__('Delete'), 
					array('action' => 'delete_itemsestandares/'.$ida.'/'.$idb),array('confirm'=> __('Are you sure you want to delete ? %s',$v["Item"]["nombre"]),'escape'=>false));
				?>


        	</td>
			
<?php //hasta esta parte se muestra la compocicion del estandar ahora proseguiremos en caso de que se requiera agregar un nuevo item?>


			</td>
		</tr>
			<?php
			}
			?>
	</table>

</fieldset>
<fieldset>
	<legend>Agregar un nuevo items</legend>
	<?php echo $this->Form->create('ItemsEstandar'); ?>	
		<?php 
		$litemsestandar[0]='Documento base'; 
		?>
		<table>
			<tr>
				<th>
					Item
				</th>
				<th>
					Orden
				</th>
				<th>
					Padre 
				</th>
			</tr>
			<tr>
				<td>
					<?php
			            echo $this->Form->select("item_id", $items,array("required" => "required"));
			            echo $this->Form->hidden("estandar_id", array(
		                "value" => $Estandar["Estandar"]["id"]
		            ));
		            ?>
				</td>
				<td>
					<?php echo $this->Form->number("orden", array("label" => false, "value" => 0, "min" => 0)); ?>
				</td>
				<td>
					<?php
			            
					echo $this->Form->select("items_estandar_id", $litemsestandar,array("default" => 0,"required" => "required"));
		            ?>
				</td>
			</tr>
		</table>
	<?php echo $this->Form->end(__('Agregar')); ?>
</fieldset>

</div>
<?php
print_r($itemsestandar);
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Estandar.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Estandar.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Estandares'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Programas'), array('controller' => 'programas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programa'), array('controller' => 'programas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tiposestandares'), array('controller' => 'tiposestandares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tiposestandar'), array('controller' => 'tiposestandares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Controles'), array('controller' => 'controles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Control'), array('controller' => 'controles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documentos'), array('controller' => 'documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documento'), array('controller' => 'documentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<select required>
<option value="">Please select</option>
<option value="first">First</option>
</select>
