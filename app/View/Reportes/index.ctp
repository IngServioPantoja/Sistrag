<?php 
$user=NUll;
?> 	
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<?php
			if($current_user['id'] == $user['User']['id']|| $current_user['nivel_id'] == '1') 
			{
			?>
			<li class="panel_menu_actual">
				<span class="glyphicon glyphicon-stats" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php 
				echo $this->Html->link(__('Reportes'), array('action' => 'index')); 
			}
			?>
			</li>
		</ul>
	</div>
	<section class="panel_internal">
		<div class="crud">
			<div class="crud_fila_principal">
				<div class="back">
					<?php
					echo $this->Html->link($this->Html->image("iconos/back64.png", array('height' => '', 'width' => '22px','title'=>'Volver')),$referer,
								array('escape' => false));
					?>

				</div>
				Reportes
			</div>
			<div id="contenedor_datos">
				<div class="crud_fila_secundaria">
					<div class="container pd-10">
						<div class="row contenedor-reportes">
					      <div class="col-sm-6 col-md-4">
						    <a href="
							    <?php 
							    echo $this->Html->url(array(
							    	"controller" => "reportes",
							    	"action" => "docentes"
								));
								?>"
								>
						        <div class="thumbnail article-reporte" style="border-radius:100%;padding:20px;">
						          <?php 
						          	echo $this->Html->image("recursos/docente.png", array('height' => '200px', 'width' => '200px','title'=>'Reportes por docente'));
						          ?>
						          <div class="caption">
						            <h2 class="bg-primary pd-5 br-5">Reportes por docente</h3>
						            <p>Encontrará reportes por cantidad de trabajos en que es jurado o asesor</p>
							      </div>
							      </br></br>
						        </div>
						    </a>
					      </div>
					      <div class="col-sm-6 col-md-4">
						    <a href="
							    <?php 
							    echo $this->Html->url(array(
							    	"controller" => "reportes",
							    	"action" => "investigaciones"
								));
								?>"
								>
						        <div class="thumbnail article-reporte" style="border-radius:100%;padding:20px;">
						          <?php 
						          	echo $this->Html->image("recursos/investigacion.png", array('height' => '200px', 'width' => '200px','title'=>'Reportes por área y línea'));
						          ?>
						          <div class="caption">
						            <h2 class="bg-primary pd-5 br-5">Reportes por área y línea de investigación</h3>
						            <p>Encontrará reportes por área y líneas de investigación</p>
									</br></br>
						          </div>
						        </div>
						    </a>
					      </div>
					      <div class="col-sm-6 col-md-4">
					      	<a href="
							    <?php 
							    echo $this->Html->url(array(
							    	"controller" => "reportes",
							    	"action" => "estados"
								));
								?>"
								>
								<div class="thumbnail article-reporte" style="border-radius:100%;padding:20px;">
									<?php 
									echo $this->Html->image("recursos/ciclo.png", array('height' => '200px', 'width' => '200px','title'=>'Reportes por ciclo de vida'));
									?>
									<div class="caption">
										<h2 class="bg-primary pd-5 br-5">Reportes por estado</h3>
										<p>Encontrará reportes estado de los proyectos (Propuesta,Proyecto,Informe final)</p>
										</br></br>
									</div>
								</div>
							</a>				     
					     </div>
					    </div>
					</div>
				</div>					
			</div>
		</div>
	</section>
</section>