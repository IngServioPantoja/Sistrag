<META HTTP-EQUIV="REFRESH" CONTENT="2">
<html lang='es_Es'>
    <head>
        <title>
            Sistrág: Sistema de información para el control de trabajos de grado I.U.CESMAG.
        </title>
        <meta charset="utf-8" />
        <?php 
			echo $this->Html->css(array ('layout','normalize','style','extjs','responsive')); 
            echo $this->Html->script(array('jquery',));
            echo $this->Js->writeBuffer(array('cache'=>true));
        ?>
        <meta name="viewport" 
          content="width=device-width, initial-scale=1, maximum-scale=5" />
    </head>
    <body id="body_layout">
        <header class="layout_header">
            <div id="logo">
                <figure>
                    <?php
                        echo $this->Html->image('iconos/logo64.png', array('alt' => 'Login','height' => '', 'width' => '32px'));
                    ?>
                    <figcaption>
                        <h2>SISTRÁG</h2>    
                    </figcaption>
                </figure>
                <div id="logo_skew_right">         
                    &nbsp;
                </div>
            </div>
            <div class="layout_title">
                <h1>
                   Sistema de información para el control de trabajos de grado
                </h1>
            </div>  
                <?php echo $this->Session->flash(); ?> 
                <?php  if($logged_in){ ?> 
            <div id="layout_usuario">
                <span><?php echo $current_user['username']; ?>
                <?php echo $this->Html->link('Salir',array('controller'=>'users','action'=>'logout'));}?>
                </span>
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
                                echo $this->Html->link('Iniciar Sesión',array('controller'=>'users','action'=>'login'));                         
                            ?>
                        </li>
                        <li>
                            <?php
                                echo $this->Html->link('Desarrolladores',array('controller'=>'users','action'=>'login'));                         
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
                        <ul>
                            <?php
                            echo "Menu<br />";
                            foreach($this->Session->read("Menu") as $i => $v)
                            {
                            ?>
                            <li>
                            <?php
                                echo $this->html->link($i, $v);
                            ?>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </nav>
                <?php
                } 
                else 
                {
                        //echo $this->html->link("Acceder","/menus/mnuMain/");
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
  Servio Pantoja - Francisco Rojas
</footer>
</body>
</html>