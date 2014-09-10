<?php 

$usuario=$this->Session->read("Usuario"); ?>
<!-- <!doctype html> -->

<!-- Al parecer solof alta cuadrar meno de director , decano y el otro-->
<html lang='es_Es'>
    <head>
        <title>
            Sistrág: Sistema de información para el control de trabajos de grado I.U.CESMAG.
        </title>
        <meta charset="utf-8"/>
        <?php 
            echo $this->Html->meta('favicon.ico','app/webroot/img/iconos/favicon.ico',array('type' => 'icon'));
			echo $this->Html->css(array ('normalize','extjs')); 
            echo $this->Html->script(array('jquery','jquery.autosize'));
            echo $this->Js->writeBuffer(array('cache'=>true));
        ?>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        
    </head>
    <body>
        <header>
            <div id="logo" <?php if($logged_in)
            { ?> class="headerLogin" <?php } ?>>
                <figure>
                    <?php
                        echo $this->Html->link($this->Html->image('iconos/logo64.png', array('title' => 'Home','height' => '', 'width' => '32px')), array('controller'=>'notificaciones','action' => 'index'),
                                array('escape' => false));
                    ?>
                    <figcaption>
                        <h2>SISTRÁG</h2>    
                    </figcaption>
                </figure>
                <div id="logo_skew_right">         
                    &nbsp;
                </div>
            </div>
            <?php
            if(!$logged_in)
            {
            ?>
            <div class="layout_titleLogout">
                <h1 class="titulo">
                   Sistema de información para el control de trabajos de grado
                </h1>
            </div>
            <?php
            }
            else
            {
            ?>
            <div class="layout_title">
                <h1 class="titulo">
                   Sistema de información para el control de trabajos de grado
                </h1>
            </div>  
            <?php
            }
            ?>
            <?php 
                echo $this->Session->Flash(); 
            ?>
            <?php  if($logged_in){ ?> 
            <div id="layout_usuario">
                <?php 
                $destino = WWW_ROOT."img/img_subida/usuarios/".$usuario['Persona']['id']."".DS;
                if (file_exists($destino))
                {
                $urlImagen="img_subida/usuarios/".$usuario['Persona']['id']."/1_400.png";
                }
                else
                {
                $urlImagen="recursos/escudo400.png";
                }   
   
                echo $this->Html->link($this->Html->image($urlImagen, array('height' => '', 'width' => '25px','title'=>$usuario['Nivel']['nombre'].": ".$usuario['Persona']['nombre']." ".$usuario['Persona']['apellido'])), array('controller'=>'personas', 'action' => 'editarContrasena', $usuario['Persona']['id']),
                array('escape' => false)); 

                ?>
                <?php 
                echo $this->Html->link('',array('controller'=>'users','action'=>'logout'),array('class' =>'icon-off','id'=>'salir','title'=>'Salir'));
                    }
                ?>
            </div>
            <?php
            if(!$logged_in)
            {
            ?>
            <div id="layout_menu_inicio">
                <nav>
                    <ul>
                        <li id='primer_a_menu_inicio'>
                            <div id="logo_skew_left">      
                                &nbsp;
                            </div>
                            <?php
                                echo $this->Html->link('Inicio',array('controller'=>'users','action'=>'login'));                         
                            ?>
                        </li>
                        <li>
                            <?php
                                echo $this->Html->link('Desarrolladores',array('controller'=>'users','action'=>'autores'));                         
                            ?>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php
            }
            ?>
        </header>
            
                <?php
                if($this->Session->check("Menu")==true)
                {
                ?>
                    <nav class="layout_nav">
                        <div>
                            <ul>
                                <div id="lista">
                                    Menu
                                </div>
                                <?php
                                foreach($this->Session->read("Menu") as $i)
                                {
                                ?>
                                    <li>
                                        <?php 
                                        
                                        if($i['id']==26)
                                        {
                                            if($nuevasNotificaciones>0)
                                            {
                                                echo $this->Html->link(
                                                $this->Html->tag('span', "", array('class' => $i['icono'],'id'=>'nav'.$i['icono'])).
                                                $this->Html->tag('span', $i['titulo'],array('class' => 'titulo')). "",
                                                    $i['vinculo'],
                                                    array('escape' => false,'class'=>'notificado')
                                                 );
                                            ?>
                                                <div class="divNotificacion">
                                                    <?php echo $nuevasNotificaciones; ?>
                                                </div>
                                            <?php
                                            }else
                                            {
                                                echo $this->Html->link(
                                                $this->Html->tag('span', "", array('class' => $i['icono'],'id'=>'nav'.$i['icono'])).
                                                $this->Html->tag('span', $i['titulo'],array('class' => 'titulo')). "",
                                                    $i['vinculo'],
                                                    array('escape' => false)
                                                 );    
                                            }
                                        }else
                                        {
                                            echo $this->Html->link(
                                            $this->Html->tag('span', "", array('class' => $i['icono'],'id'=>'nav'.$i['icono'])).
                                            $this->Html->tag('span', $i['titulo'],array('class' => 'titulo')). "",
                                                $i['vinculo'],
                                                array('escape' => false)
                                             );    
                                        }
                                        ?> 
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </nav>
                <?php
                } 
                ?> 
            <?php
            if(!$logged_in)
            {
            ?>
            <section class="layout_contenido_inicial">
                    <?php 
                        echo $content_for_layout; 
                    ?>
            </section>
            <?php
            }else{
            ?>
            <section class="layout_contenido">
                <?php 
                    echo $content_for_layout; 
                ?>
            </section>
            <?php 
            }
            ?>

	<footer class="layout_footer">
    <div>
        <?php 
        echo $this->Html->link(
            $this->Html->tag('span', "", array('class' => "icon-facebook2")),
            "https://www.facebook.com/servioandres.pantojarosero",
                array('escape' => false,'target'=>'_blank','title'=>'Facebook Servio Pantoja')
        );
        ?> 
        <span>Servio Pantoja</span>
        <?php 
        echo $this->Html->link(
            $this->Html->tag('span', "", array('class' => "icon-twitter")),
            "https://twitter.com/ServioPantoja",
                array('escape' => false,'target'=>'_blank','title'=>'Twitter Servio Pantoja')
        );
        ?> 
         
        <?php 
        echo $this->Html->link(
            $this->Html->tag('span', "", array('class' => "icon-github")),
            "https://github.com/IngServioPantoja/Sistrag",
                array('escape' => false,'target'=>'_blank','title'=>'Repositorio Sistrag'));
        ?>  
    </div>
    <div>
        <?php 
        echo $this->Html->link(
            $this->Html->tag('span', "", array('class' => "icon-twitter")),
            "https://twitter.com/PFranciscoRojas",
                array('escape' => false,'target'=>'_blank','title'=>'Twitter Francisco Rojas')
        );
        ?>
        <span>Francisco Rojas</span>
        <?php 
        echo $this->Html->link(
            $this->Html->tag('span', "", array('class' => "icon-facebook2")),
            "https://www.facebook.com/francisco.rojas.54943600",
                array('escape' => false,'target'=>'_blank','title'=>'Facebook Francico Rojas')
        );
        ?>
    </div>  
</footer>
<script>
    $('.use-tooltip').tooltip();
</script>
<?php
  echo $this->Html->script(array('highcharts','highcharts-3d','modules/exporting'));
?>
<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>