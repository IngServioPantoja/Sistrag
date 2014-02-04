<?php
print_r($descomposiciones);
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Documentos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Personas Proyectos'), array('controller' => 'personas_proyectos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personas Proyecto'), array('controller' => 'personas_proyectos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php 
//print_r($proyecto);
?>
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<li>
				<?php
				echo $this->Html->image('iconos/listar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php echo $this->Html->link(__('Documentos'), array('action' => 'index', $proyecto['Proyecto']['id'])); ?></li><li class="panel_menu_actual">
				<?php
				echo $this->Html->image('iconos/agregar32.png', array('alt' => 'Login','height' => '', 'width' => '16px'));
				?>
				<?php echo $this->Html->link(__('Subir documento'), array('action' => 'subir_documento', $proyecto['Proyecto']['id'])); ?>
			</li>
		</ul>
	</nav>
	<section class="panel_internal">
		<table class="crud">
			<tr>
				<td>
					<?php echo $this->Form->create('Documento',array('type' => 'file')); ?>
					<div class="crud_fila_principal">
						<span>Documento: </span>
						<?php 
						echo $proyecto['Proyecto']['nombre'];
						?>
					</div>
					<div class="crud_fila_secundaria">
						<!--
							<div class="frame_cargando">
								<div id="circular3dG">
									<div id="circular3d_1G" class="circular3dG">
									</div>
									<div id="circular3d_2G" class="circular3dG">
									</div>
									<div id="circular3d_3G" class="circular3dG">
									</div>
									<div id="circular3d_4G" class="circular3dG">
									</div>
									<div id="circular3d_5G" class="circular3dG">
									</div>
									<div id="circular3d_6G" class="circular3dG">
									</div>
									<div id="circular3d_7G" class="circular3dG">
									</div>
									<div id="circular3d_8G" class="circular3dG">
									</div>
								</div>
								<p class="cargando">Cargando</p>
							</div>
						-->
						
					</div>
					<?php echo $this->Form->end(__('Subir')); ?>
				</td>
			</tr>
		</table>
	</section>
</section>
<?php

foreach ($descomposiciones as $descomposicion) 
		    {
		        echo $descomposicion['titulo']."</br>";
		        foreach ($descomposicion['contenido'] as $item) 
		        {	
		        	if($item['tipo']=="Imagen")
		        	{	
		        		echo "<---->";
echo $this->Html->image('/app/webroot/files/documentos/'.$item['elementos'], array('alt' => 'Login','height' => '', 'width' => '300px'));		        	}
		            echo $item['tipo']."</br>";
		            echo $item['elementos']."</br>";
		        }
		    }

?>