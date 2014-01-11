<?php
//echo "vista activa!";
	/*foreach($nivs as $i => $v){
		//echo $i." ".$v."<br />";
		echo $this->html->link($i,$v)."<br>";
	}*/
	

if(is_array($nivs)){
    foreach($nivs as $i => $v){
        foreach($v as $j => $w){
            foreach($w as $k => $x){
                if(is_array($x)){
                    foreach($x as $l => $y){
                        if(is_array($y)){
                            foreach($y as $m => $z){
                                echo "<strong>***".$i." ".$j." ".$k." ".$l." ".$m." ".$z."</strong><br />";
                            }
                        } else {
                            echo "<strong>".$i." ".$j." ".$k." ".$l." ".$y."</strong><br />";
                        }
                    }
                } else {
                    echo $i." ".$j." ".$k." ".$x."<br />";
                }
            }
        }
    }
}
//print_r($datos);
?>