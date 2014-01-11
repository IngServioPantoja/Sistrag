<META HTTP-EQUIV="REFRESH" CONTENT="12">
<html>
    <head>
        <title>
            Sistrág: Sistema de información para el control de trabajos de grado I.U.CESMAG.
        </title>
        <?php 
			echo $this->Html->css(array ('layout','normalize','style','extjs')); 
            echo $this->Html->script(array('jquery',));
            echo $this->Js->writeBuffer(array('cache'=>true));
        ?>
        <meta name="viewport" 
          content="width=device-width, initial-scale=1, maximum-scale=1" />
    </head>
    <body id="body_layout">
        <header class="layout_header">
            <div class="layout_title">
                <h1>
                   SISTRÁG: Control de trabajos de grado
                </h1>
                <h2>
                    <?php echo $this->Session->flash(); ?> 
                                <?php  if($logged_in){?> 
                      Bienvenido <?php echo $current_user['username']; ?> <?php echo $this->Html->link('Salir',array('controller'=>'users','action'=>'logout'));} 
                      else{
                    echo $this->Html->link('login',array('controller'=>'users','action'=>'login'));}?>
                </h2>
            </div>
            
        </header>
      
        <!--<section class="layout_footer">-->
            <!-- Barra de estado -->
            <?php //echo $this->Session->flash(); ?> 
            <?php  //if($logged_in){?> 
 <!-- Bienvenido <?php //echo $current_user['username']; ?> <?php //echo $this->Html->link('logout',array('controller'=>'users','action'=>'logout'));} -->
  //else{
//echo $this->Html->link('login',array('controller'=>'users','action'=>'login'));}?>
        </section> -->

            <nav class="layout_nav">
                <?php
                    if($this->Session->check("Menu")==true){
                        echo "Menu<br />";
                        foreach($this->Session->read("Menu") as $i => $v){
                            echo $this->html->link($i, $v)."<br />";
                        }
                    } else {
                        //echo $this->html->link("Acceder","/menus/mnuMain/");
                    }

                    //foreach($this->Session->read("servio") as $i => $v){
                      //      echo $v["User"]["username"];
                       // }
                       //con esta imprimo el arregle 
                        
                ?>
            </nav>
            <section class="layout_contenido">
                <section>
                    <?php 
                        echo $content_for_layout; 
                    ?>
                </section>
            </section>
	<footer class="layout_footer">
  Servio Pantoja - Francisco Rojas
</footer>
</body>
</html>