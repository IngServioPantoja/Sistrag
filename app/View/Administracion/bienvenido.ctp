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
          <li style="border:solid 1px #aaa;" data-target="#carousel-example-captions" data-slide-to="1" class="active"></li>
          <li style="border:solid 1px #aaa;" data-target="#carousel-example-captions" data-slide-to="2" class=""></li>
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
          <div class="item" style="position:relative;">
            <h1 class="text-center" style="background-color:rgba(255,255,255,0.9);border-radius:20px;padding:20px; border:3px solid #006;">
              <strong>Modulo de administración de usuarios: </strong>
              <small>
                Liste, filtre, registre, consulte, modifique y elimine usuarios del sistemas
              </small>
            </h1>
            <?php
              echo $this->Html->image('recursos/personas.png', array('title' => 'Home','height' => '70%', 'width' => '70%','class'=>'img-responsive img-thumbnail pulse','style'=>'display:block;margin:0 auto;'))
            ?>
          </div>
          <div class="item" style="position:relative;">
            </br></br></br>
            <?php
              echo $this->Html->image('recursos/personas.png', array('title' => 'Home','height' => '70%', 'width' => '70%','class'=>'img-responsive img-thumbnail pulse','style'=>'display:block;margin:0 auto;'))
            ?>
            </br>
            <h1 class="text-center" style="position:absolute;top:20px;left:10%;right:10%; background-color:rgba(255,255,255,0.9);border-radius:20px;padding:20px; border:3px solid #006;">
              <strong>Modulo de administración de estandares</strong>
              </br></br>
              <small>
                Liste, filtre, registre, consulte, modifique y elimine usuarios del sistemas
              </small>
            </h1>
          </div>
        <a class="left carousel-control" href="#carousel-example-captions" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-captions" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
    </div>
  <script>
$('.carousel').carousel({
  interval: 8000  
});
  </script>
	</section>
</section>