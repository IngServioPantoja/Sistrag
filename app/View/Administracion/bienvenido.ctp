<?php 
$user=NUll;

?> 	
<section class="panel_frame">
	<div class="panel_menu">
		<ul>
			<li class="panel_menu_actual">
				<span class="glyphicon glyphicon-home" style="color:#ddd;text-shadow:0px 0px 4px #222; font-size:14px;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php 
				echo $this->Html->link(__('    Inicio'), array('action' => 'bienvenido')); 
				?>
			</li>
			</li>
		</ul>
	</div>
	<section class="panel_internal">
		<div class="bs-example">
      <div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li style="border:solid 1px #000;" data-target="#carousel-example-captions" data-slide-to="0" class=""></li>
        </ol>
        <div class="carousel-inner">
          <div class="item active">
            </br>
            </br>
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
            </br>
          </div>
      </div>
    </div>
  <script>
$('.carousel').carousel({
  interval: 8000  
});
  </script>
	</section>
</section>