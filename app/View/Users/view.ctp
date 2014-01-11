<div class="users view">
<h2><?php  echo __('Usuario '); echo ': ',h($user['User']['username']); ?>

</div>
			<br/>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Usuarios'), array('action' => 'index')); ?> </li>

	</ul>
</div>

