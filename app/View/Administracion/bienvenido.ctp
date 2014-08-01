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
				<span class="glyphicon glyphicon-home" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php 
				echo $this->Html->link(__('    Inicio'), array('action' => 'bienvenido')); 
				?>
			</li>
			<?php 
			}
			?>
			</li>
		</ul>
	</div>
	<section class="panel_internal">
			<h1 class="text-center">
				Bienvenid@ a
			</h1>
			</br></br>
			<?php
				echo $this->Html->image('recursos/logo.png', array('title' => 'Home','height' => '', 'width' => '20%','class'=>'img-responsive img-circle pulse','style'=>'display:block;margin:0 auto;'))
			?>
			</br>
			</br>
			<h1 class="text-center">
				SISTRÁG 
				</br></br>
				<small>
					Sistema de información para el control de trabajos de grado
				</small>
			</h1>
			</br>
			</br>
	</section>
</section>