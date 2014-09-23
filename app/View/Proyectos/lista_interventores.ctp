<?php
if(count($Interventores)>0)
{
?>
<?php
}else
{
?>
<div class="resultado_busqueda">
	No hay resultados que coincidan con la búsqueda
</div>
<?php
}
?>
<?php
	foreach ($Interventores as $interventor) 
	{	
		?>
		<article class='ficha_index'>

			<a href="personas/view/<?php  echo $interventor['Persona']['id'];?>">
				<figure>
					<?php
					$destino = WWW_ROOT."img/img_subida/usuarios/".$interventor['Persona']['id']."".DS."/1_400.png";
					if (file_exists($destino))
					{
						$urlImagen="img_subida/usuarios/".$interventor['Persona']['id']."/1_400.png";
					}
					else
					{
						$urlImagen="recursos/escudo400.png";
					}
					echo $this->Html->image($urlImagen, array('alt' => 'Login','height' => '200px', 'width' => '200px'));
					?>
				</figure>
			</a>
			<?php
			if($interventor['Persona']['tiposusuario_id']==1 || $interventor['Persona']['tiposusuario_id']==2 || $interventor['Persona']['tiposusuario_id']==3)
			{
			?>
			<span class="relacion_integrante" id="cargo_interventor">
				<div class="interventor_acciones">
					<ul class="lista_agregar_interventor">
						<?php 
						echo $this->Form->create('PersonasProyecto',array('controlles'=>'personasproyectos','action' => 'add')); 
						echo $this->Form->hidden('persona_id',array('value'=>$interventor['Persona']['id']));
						echo $this->Form->hidden('proyecto_id',array('value'=>$Proyecto));
						?>
						<li>
							Agregar jurado
							<?php
							echo $this->Form->submit('1',array('div'=>false,'class'=>'submit_oculto','name'=>'data[PersonasProyecto][rol_id]'));
							?>
						</li><li>
							Agregar asesor
							<?php
							echo $this->Form->submit('2',array('div'=>false,'class'=>'submit_oculto','name'=>'data[PersonasProyecto][rol_id]'));
							?>
						</li>
						<?php
						echo $this->Form->end();
						?>
					</ul>
					<span class="icon-library" id="proyectoIcono">
					</span>
				</div>
			</span>
			<?php
			}
			else if($interventor['Persona']['tiposusuario_id']==4)
			{
			?>
			<span class="relacion_integrante" id="cargo_interventor">
				<div class="interventor_acciones">
					<ul class="lista_agregar_interventor">
						<?php 
						echo $this->Form->create('PersonasProyecto',array('controlles'=>'personasproyectos','action' => 'add')); 
						echo $this->Form->hidden('persona_id',array('value'=>$interventor['Persona']['id']));
						echo $this->Form->hidden('proyecto_id',array('value'=>$Proyecto));
						?>
						<li>
							Agregar jurado
							<?php
							echo $this->Form->submit('1',array('div'=>false,'class'=>'submit_oculto','name'=>'data[PersonasProyecto][rol_id]'));
							?>
						</li><li>
							Agregar asesor
							<?php
							echo $this->Form->submit('2',array('div'=>false,'class'=>'submit_oculto','name'=>'data[PersonasProyecto][rol_id]'));
							?>
						</li>
						<?php
						echo $this->Form->end();
						?>
					</ul>
					<span class="icon-user-md" id="proyectoIcono">
					</span>
				</div>
			</span>
			<?php
			}else if($interventor['Persona']['tiposusuario_id']==5)
			{
			?>
			<span class="relacion_integrante" id="cargo_interventor">
				<div class="interventor_acciones">
					<ul class="lista_agregar_interventor">
						<?php 
						echo $this->Form->create('PersonasProyecto',array('controlles'=>'personasproyectos','action' => 'add')); 
						echo $this->Form->hidden('persona_id',array('value'=>$interventor['Persona']['id']));
						echo $this->Form->hidden('proyecto_id',array('value'=>$Proyecto));
						?>
						<li class="estudiante">
							Agregar estudiante
							<?php
							echo $this->Form->submit('3',array('div'=>false,'class'=>'submit_oculto','name'=>'data[PersonasProyecto][rol_id]'));
							?>
						</li>
						<?php
						echo $this->Form->end();
						?>
					</ul>
					<span class="icon-graduate" id="proyectoIcono">
					</span>
				</div>
			</span>
			<?php
			}
			?>
			<a href="personas/view/<?php  echo $interventor['Persona']['id'];?>">
				<div class='ficha_datos'>
					<table>
						<tr>
							<th colspan="2">
								<span>
									Identificación:
								</span>
							</th>
						</tr>
						<tr>
							<td colspan="2">
								<span>
									<?php echo h($interventor['Persona']['identificacion']); ?>
								</span>
							</td>
						</tr>
						<tr>
							<th colspan="2">
								<span>
									Nombre:
								</span>
							</th>
						</tr>
						<tr>
							<td colspan="2">
								<span>
									<?php echo h($interventor['Persona']['nombre']." ".$interventor['Persona']['apellido']); ?>
								</span>
							</td>
						</tr>
						<tr>
							<th colspan="2">
								<span>
									<?php
									if($interventor['Persona']['tiposusuario_id']==1)
									{
									?>
									Institucion
									</br></br>
									<?php
									}
									else if($interventor['Persona']['tiposusuario_id']==2)
									{
									?>
									Facultad:
									<?php
									}else if($interventor['Persona']['tiposusuario_id']==3 || $interventor['Persona']['tiposusuario_id']==4 || $interventor['Persona']['tiposusuario_id']==5)
									{
									?>
									Programa:
									<?php
									}
									?>
								</span>
							</th>
						</tr>
						<tr>
							<td colspan="2">
								<span>
								<?php
									if($interventor['Persona']['tiposusuario_id']==1)
									{
									?>
									<?php
									}
									else if($interventor['Persona']['tiposusuario_id']==2)
									{
									echo h($interventor['Facultad']['nombre']);
									}else if($interventor['Persona']['tiposusuario_id']==3 || $interventor['Persona']['tiposusuario_id']==4 || $interventor['Persona']['tiposusuario_id']==5)
									{
									echo h($interventor['Programa']['nombre']); 
									}
									?>
								</span>
							</td>
						</tr>
					</table>
				</div>
			</a>
		</article>
		<?php
	}
?>
<?php
$this->Js->get('#valor')->event('keyup',
	$this->Js->request(
	    array(
	        'action'=>'lista_interventores',
	    ),
	    array(
	        'update'=>'#contenedor_interventores',
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