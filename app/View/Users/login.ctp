
<fieldset id='login'>
	<?php
	echo $this->Form->create();
	?>
	<div id='titulo'>
		<h2>Acceso al sistema</h2>
	</div>
	<div id='formulario'>
		<table>
			<tr>
				<td rowspan='4'>
					<figure>	
						<?php
						echo $this->Html->image('iconos/login200.png', array('alt' => 'Login','height' => '', 'width' => '100px'));
						?>
					</figure>
				</td>
				<td>
					<span>Usuario:</span>
				</td>
			</tr>
			<tr>
				<td>
					<?php
			echo $this->Form->input('username',array('label' => false, 'id'));
					?>
				</td>
			</tr>
			<tr>
				<td>
					<span>Contraseña:</span>
				</td>
			</tr>
			<tr>
				<td>
					<?php
					echo $this->Form->input('password',array('label' => false));
					?>
				</td>
			</tr>
		</table>
	</div>
	<div id='submit'>
	<?php
	echo $this->Form->end('۞ Ingresar');
	?>			
	</div>
</fieldset>
