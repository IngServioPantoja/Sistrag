<?php
//print_r($descomposiciones);
?>
<?php 
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<li>
			<?php
			echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
			?>
			<?php echo $this->Html->link(__('Documentos'), array('controller'=>'proyectos','action' => 'documentos', $proyecto['Proyecto']['id'])); ?></li><li>
			<span class="icon-cloudy" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
			<?php echo $this->Html->link(__('Subir documento'), array('action' => 'subir_documento', $proyecto['Proyecto']['id'])); 
			?></li><li class="panel_menu_actual">
			<span class="icon-file-settings" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>
			<?php echo $this->Html->link(__('Documento'), array('action' => 'mostrar_documento', $proyecto['Documento']['id'])); 
			?>
			</li>
		</ul>
	</nav>
	<section class="panel_internal">
		<div class="crud">
			<?php echo $this->Form->create('Documento',array('type' => 'file')); ?>
			<div class="crud_fila_principal">
				<div class="contenedor_integrantes">
					<div class="back">
						<?php
						echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
									array('escape' => false));
						?>
					</div>
					<span class="principal_titulo"> 
					<?php 
					echo $proyecto['TiposEstandar']['nombre'];
					?>
					<?php 
					echo $proyecto['Documento']['fecha_guardado'];
					?>
					:
					<?php 
					echo $proyecto['Proyecto']['titulo'];
					?>
					</span>
				</div>
				<div class="contenedor_integrantes">
					<div class="unidad_integrantes">
						<span class="icon-graduate icono_izquierda_pequeño">
						</span>
						<?php
						foreach ($proyecto['Integrantes'] as $integrante) 
						{
							if($integrante['PersonasProyecto']['rol_id']==3)
							{
						?>
						<span>
						<?php
								echo " *";
								echo $integrante['Persona']['nombre'];
								echo " ";
								echo $integrante['Persona']['apellido'];
						?>
						</span>
						<?php
							}
						}
						?>
					</div>
					<div class="unidad_integrantes">
						<span class="icon-batman icono_izquierda_pequeño">
						</span>
						<?php
						foreach ($proyecto['Integrantes'] as $integrante) 
						{
							if($integrante['PersonasProyecto']['rol_id']==2)
							{
								echo " *";
								echo $integrante['Persona']['nombre'];
								echo " ";
								echo $integrante['Persona']['apellido'];

							}
						}
						?>
					</div>
					<div class="unidad_integrantes">
						<span class="icon-auction icono_izquierda_pequeño">
						</span>
						<?php
						foreach ($proyecto['Integrantes'] as $integrante) 
						{
							if($integrante['PersonasProyecto']['rol_id']==1)
							{
								echo " *";
								echo $integrante['Persona']['nombre'];
								echo " ";
								echo $integrante['Persona']['apellido'];
							}
						}
						?>
					</div>
				</div>	
				<div class="contenedor_integrantes">
					<?php echo $this->Form->create('Proyecto'); ?>
					<?php echo $this->Form->input('id',array('value'=>$proyecto['Proyecto']['id'])); ?>
					<div class="unidad_integrantes">
						<?php
						echo $this->Form->select(
							'tipodocumento', $tiposestandares,array('id'=>'tiposestandares','autocomplete' =>'off','empty'=>false,'value'=>$proyecto['TiposEstandar']['id'])
						);
						?>
					</div>
					<div class="unidad_integrantes" id="lista_documentos">
						<?php
						echo $this->Form->select(
							'documento', $documentos,array('id'=>'documento','autocomplete' =>'off','empty'=>false,'value'=>$proyecto['Documento']['id'])
						);
						?>
					</div>
					<div class="unidad_integrantes" id="lista_documentos">
						<?php echo $this->Form->submit(
						    'Mostrar', 
						    array('class' => 'submitGrisRedondoDelgado' )
						); 
					    ?>	
					</div>
					<?php echo $this->Form->end(__('')); ?>
				</div>
			</div>
			<div class="crud_fila_secundaria">
				<?php
				foreach ($descomposiciones as $descomposicion)
				{
					if($descomposicion['contenido']!=null)
    				{
    			?>
						<article class='marcoPrincipal' id="<?php echo "item".$descomposicion['item_documento_id']; ?>">
							<div class="headerVinotinto" onClick="encoger(this)" id="<?php echo $descomposicion['item_documento_id']; ?>" style="cursor:pointer;">
								<div class="tituloModulo">
									<span id="<?php echo "marcador".$descomposicion['item_documento_id']; ?>" class="marcador">v</span>
									<span>
		       						<?php
		       						echo $descomposicion['titulo'];
									?>
									</span>
								</div>
							</div>
							<div class="marcoSecundario" id="<?php echo "contenido".$descomposicion['item_documento_id']; ?>">
								<div class="headerGris">
									<div class="tituloSubmoduloLeft">
										<div class="tituloUnidad">
											<span>
											Líneas:
											</span>
										</div>
										<div 
											<?php if($descomposicion['extencion_lineas']>=ceil($descomposicion['caracteres']/85))
											{?>class="tituloUnidad extencionAprobado" 
											<?php 
											}else{?> class="tituloUnidad extencionNoAprobado" 
											<?php 
											} ?>
											>
											<span>
											<?php echo ceil($descomposicion['caracteres']/85); ?>
											</span>
										</div>
									</div>
									<div class="tituloSubmoduloRight">
										<div class="tituloUnidad">
											<span>
											Caracteres:
											</span>
										</div>
										<div <?php if($descomposicion['extencion_caracteres']>=$descomposicion['caracteres'])
											{?>class="tituloUnidad extencionAprobado" 
											<?php 
											}else{?> class="tituloUnidad extencionNoAprobado" 
											<?php 
											} ?>
											>
											<span>
											<?php echo $descomposicion['caracteres']; 
											?>
											</span>
										</div>
									</div>
								</div>
								<div class="contenidoItem" id="<?php echo "txt".$descomposicion['item_documento_id']; ?>">
						<?php
						if (isset($descomposicion['contenido'])) 
						{
							foreach ($descomposicion['contenido'] as $item) 
		        			{
		        				if($item['tipo']==2)
					        	{	
					    		?>
									<p class="parrafo">
								<?php
									echo $item['elementos'];
								?>
									</p>
					    		<?php
					        	}
					        	else if($item['tipo']==3)
					        	{	
					    		?>
									<p class="figura">
								<?php
									echo $item['elementos'];
								?>
									</p>
					    		<?php
					        	}
					        	else if($item['tipo']==4)
					        	{	
					    		?>
									<p class="fuente">
								<?php
									echo $item['elementos'];
								?>
									</p>
					    		<?php
					        	}
					        	else if($item['tipo']==5)
					        	{	
					    		?>
									<p class="piePagina">
								<?php
									echo $item['elementos'];
								?>
									</p>
					    		<?php
					        	}
					        	else if($item['tipo']==6)
					        	{
					        		echo $this->Html->image('/app/webroot/files/documentos/'.$item['elementos'], array('class'=>'img zoomeable'));
					        	}
					        	else if($item['tipo']==7)
					        	{	
					    		?>
									<p class="tabla">
								<?php
									echo $item['elementos'];
								?>
									</p>
					    		<?php
					        	}
		        			}
		        		?>
								</div>
							</div>
		        		<?php
						}
						?>
						</article>
				<?php
					}
				}
				?>
			</div>
			<?php
				if($proyecto['Documento']['enviado']==0)
				{
			?>
			<div class="contenedorAzul">
				<?php echo $this->Form->create('Entrega',array('controller'=>'entregas','action'=>'add')); ?>
				<?php echo $this->Form->hidden('documento_id',array('value'=>$proyecto['Documento']['id'])); ?>
				<?php echo $this->Form->hidden('proyecto_id',array('value'=>$proyecto['Proyecto']['id'])); ?>
				<?php
					echo $this->Form->select(
						'rol_id', $roles,array('id'=>'rol','autocomplete' =>'off','empty'=>false)
					);
				?>
				<?php 
				echo $this->Form->submit(
				    'Enviar', 
				    array('class' => 'submitGrisRedondoDelgado','id'=>'submitCortoRight','div'=>false)
				); 
			    ?>	
			</div>
			<?php
				}
			?>
			<span id="bot">
			</span>
		</div>
	</section>
</section>
<div class="goTop">
	<a href="" title="Subir">
		<span class="icon-arrow-up" style="font-size:16px;">
		</span>
	</a>
	<?php
		echo $this->Form->select(
			'anclasItems', $anclasItems,array('id'=>'anclasItems','autocomplete' =>'off','empty'=>false,'title'=>'Ir a')
		);
	?>
	<a href="#bot" title="Bajar">
		<span class="icon-arrow-down" style="font-size:16px;">
		</span>
	</a>
</div>
<?php
$this->Js->get('#tiposestandares')->event('change',
	$this->Js->request(
	    array(
	        'controller'=>'documentos','action' => 'lista_documentos',
	    ),
	    array(
	        'update'=>'#lista_documentos',
	        'async' => true,
	        'method' => 'post',
	        'dataExpression'=>true,
	        'data'=> $this->Js->serializeForm(array(
	            'isForm' => false,
	            'inline' => true
	        ))
	    )
	)
);
?>
<script>
	

	function encoger(obj)
	{
		afectado=obj.id;
		var vista=$('#txt'+afectado).css( "display");
	if (vista=='none')
		{
			$('#txt'+afectado).slideDown(1000, function()
				{
					$('#marcador'+afectado).text("v");
				}
			);
							
		}
	else
		{
			$('#txt'+afectado).slideUp(1000,function()
				{
					$('#marcador'+afectado).text("-");
				}
			);
		}
	}
	
	$(function() 
	{
		$('#navicon-suitcase').css( "background", "#7a0400" );
		$('#marcicon-suitcase').css( "color", "#7a0400" );
		$("#anclasItems").change(function() 
			{
			window.location = "#item"+this.value;
  			}
		);
	});
</script>