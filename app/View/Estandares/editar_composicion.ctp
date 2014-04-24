<?php 
$user=NUll;
$litemsestandar[0]='Documento base'; 
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<?php
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') 
			{
			?>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('title' => 'Listar Estandares','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Estandar'), array('action' => 'index')); 
				?></li><li>
				<?php
				echo $this->Html->image('iconos/update40.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Actualizar datos'), array('controller'=>'estandares','action' => 'editar_estandar',$estandar['Estandar']['id'])); 
				?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/update40.png', array('title' => 'Registrar Estandar','height' => '', 'width' => '16px'));
				?>
				<?php 
				echo $this->Html->link(__('Modificar estructura'), array('action' => 'editar_composicion',$estandar['Estandar']['id'])); 
			}
				?>
			</li>
		</ul>
	</div>
	<section class="panel_internal">
		<table class="crud">
			<tr>
				<td>
					<div class="crud_fila_principal">
						<div class="back">
							<?php
							echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
										array('escape' => false));
							?>
						</div>
						<span>
							<?php
								echo $estandar["Estandar"]["id"]." ".$estandar["Tiposestandar"]["nombre"].": ";
								echo $estandar["Estandar"]["nombre"]." ";
								echo $estandar["Programa"]["nombre"];
							?>
						</span>
					</div>
					<?php 
					echo $this->Form->create('ItemsEstandar'); 
					echo $this->Form->input('id'); 
					?>
						<div class="crud_fila_secundaria">
							<figure class="fondoAgregar">
								<?php
								echo $this->Html->image('recursos/escudo400.png', array('width' => '200px'));
								?>
							</figure>
							<article class='ficha_index' id="fichaIndexInformacionGeneral">
								<span class="estandar">
									Estructura
								</span>	
								<div class="itemsDocumento">
									<div class="tituloItemsDocumento">
										<div class="orden">Orden</div><div class="item">
										Item</div><div class="lineas">
										Líneas</div><div class="caracteres">
										Caracteres</div>
									</div>
									<?php
									//idb es el estandar a borrar
									$idb=$estandar["Estandar"]["id"];
									$estandarId=$estandar["Estandar"]["id"];
									$existe=0;
									foreach($itemsestandar as $item => $v)
									{$existe=1;
									?>
										<div class="contenidoItemsDocumento" id="<?php echo $v["Item"]["id"]; ?>" >
											<?php
											//ida es la relación
											$ida=$v["Item"]["id"];
											echo $this->Js->link('','/estandares/delete_itemsestandares/'.$ida, 
												array(
													'confirm'=>"Realmente desea borrar el item '".$v["Item"]["nombre"]."'",
													'success' => $this->Js->get("#$ida")->effect('fadeOut'),
													'class'=>'icon-cancel estructuraEliminarItem'
												)
											);
											?>
											<div class="orden"><?php echo $v["ItemsEstandar"]["orden"];?></div><div class="item">
											<?php echo $v["Item"]["nombre"]; ?></div><div class="lineas">
											<?php echo $v["Item"]["extencion_lineas"]; ?></div><div class="caracteres">
											<?php echo $v["Item"]["extencion_caracteres"]; ?></div>
										</div>
									<?php
									}
									if($existe==1)
									{
									?>
									<div class="submit">
										<?php
										echo $this->Html->link("Maquetar documento y descargar", array('action' => 'maquetarDocumento',$estandarId),array('confirm'=> __("¿Realmente desea maquetar el estandar para ".$estandar["Tiposestandar"]["nombre"]." ".$estandar["Estandar"]["nombre"]." ".$estandar["Programa"]["nombre"]."? recuerde que una vez realizada esta operación estara dispone para su descarga y sobreeescribira el anterior estandar"),'escape' => false,'title'=>'Modificar Estandar','class'=>'submitVinotinto'));
										?>
									</div>
									<?php 
									}	
									?>
								</div>
							</article>
<!-- Aqui empieza el article de agregar items-->
						<article class='ficha_index articleAgregarItem' id="fichaIndexInformacionGeneral">
							<span class="estandar">
								Agregar items
							</span>	
							<div class="itemsDocumento" id="itemsAgregar">
								<?php 
								echo $this->Form->create('Item'); 
								echo $this->Form->hidden('programa_id',array('value'=>$estandar["Programa"]["id"])); 
								?>
								<div class="agregarItemTitulo">
									Item:
								</div>
								<div class="agregarItemEntrada">
									<?php 
									echo $this->Form->text("nombre", array("label" => false,'Placeholder'=>'Ingrese titulo del item')); 
									?>
								</div>
								<div class="agregarItemTitulo">
									Caracteres:
								</div>
								<div class="agregarItemEntrada">
									<?php 
									echo $this->Form->number("extencion_caracteres", array("label" => false, "value" => 0, "min" => 0,'max'=>'100000','class'=>'number_corto')); 
									?>
								</div>
								<div class="agregarItemTitulo">
									Líneas:
								</div>
								<div class="agregarItemEntrada">
									<?php 
									echo $this->Form->number("extencion_lineas", array("label" => false, "value" => 0, "min" => 0,'max'=>'1000','class'=>'number_corto')); 
									?>
								</div>
								<?php 
								echo $this->Form->create('ItemsEstandar'); 
								echo $this->Form->hidden('estandar_id',array('value'=>$estandar["Estandar"]["id"])); 
								?>
								<div class="agregarItemTitulo">
									Orden:
								</div>
								<div class="agregarItemEntrada">
									<?php 
									echo $this->Form->number("orden", array("label" => false, "value" => 0, "min" => 0,'max'=>'20','class'=>'number_corto')); 
									?>
								</div>
								<div class="agregarItemTitulo" title="Si selecciona esta opcion el numero no se mostrara en el documento">
									Numero:
								</div>
								<div class="agregarItemEntrada">
									<?php 
									echo $this->Form->checkbox("numero", array('title'=>'Si selecciona esta opcion el numero no se mostrara en el documento')); 
									?>
								</div>
								<div class="agregarItemTitulo">
									Padre:
								</div>
								<div class="agregarItemEntrada">
									<?php
			            			echo $this->Form->select("items_estandar_id", $litemsestandar,array("default" => 0,"required" => "required",'empty'=>false,'class'=>'inputCorto'));
						            ?>
								</div>
								<?php 
									echo $this->Form->submit(
									    'Agregar item', array('confirm'=> __("¿Realmente desea maquetar el estandar para ".$estandar["Tiposestandar"]["nombre"]." ".$estandar["Estandar"]["nombre"]." ".$estandar["Programa"]["nombre"]."? recuerde que una vez realizada esta operación estara dispone para su descarga y sobreeescribira el anterior estandar"),
									    array('class' => 'submitVinotinto')
									); 
							    ?>							
							</div>
						</article>
					</div>
				</td>
			</tr>
		</table>
	</section>
</section>
<script>
	$('#navicon-file-settings').css( "background", "#7a0400" );
	$('#marcicon-file-settings').css( "color", "#7a0400" );
</script>