
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
				<td>
					<span>Usuario:</span>
				</td>
				<td>
					<?php
			echo $this->Form->input('username',array('label' => false));
					?>
				</td>
			</tr>
			<tr>
				<td>
					<span>Contraseña:</span>
				</td>
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
	echo $this->Form->end('Ingresar');
	?>			
	</div>
</fieldset>
