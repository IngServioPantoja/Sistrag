<?php
/*foreach($datos as $i => $v)
	{
		echo $i." ".$v."</br>";	
	}
	*/

// Preguntamos si es un array
if(is_array($datos))
	{
		foreach($datos as $i => $v)
			{
				foreach($v as $j => $w)
					{
						foreach($w as $k => $x)
							{
								if(is_array($x))
									{
										foreach($x as $l => $y)
											{
												if(is_array($y))
													{
														foreach($y as $m => $z)
															{
																echo "<strong>***".$i." ".$j." ".$k." ".$l." ".$m." ".$z."</strong><br/>";	
															}
													}
											}
											
											
										echo "<strong>".$i." ".$j." ".$k." ".$l." ".$y."</strong><br/>";		
									}
								else{
										echo $i." ".$j." ".$k." ".$x."<br/>";	
									}
								
									
							}	
							
					}
				
			}
	}
	//print_r()$datos);

?>