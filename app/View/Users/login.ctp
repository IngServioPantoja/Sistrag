<fieldset id='login'>
	<?php
	echo $this->Form->create();
	?>
	<div id='titulo'>
		<h2>Acceso al sistema</h2>
	</div>
	<div id='formulario'>
		<div>
			<figure>	
				<?php
				echo $this->Html->image('iconos/login200.png', array('alt' => 'Login','height' => '', 'width' => '100px'));
				?>
			</figure>
		</div>
		<div>
			<span>Usuario:</span>
			</br>
			<?php
				echo $this->Form->input('username',array('label' => false, 'id'));
			?>
			</br>
			<span>Contraseña:</span>
			</br>
			<?php
				echo $this->Form->input('password',array('label' => false));
			?>
		</div>
	</div>
		<?php
			echo $this->Form->end('• Ingresar •');
		?>			
</fieldset>
