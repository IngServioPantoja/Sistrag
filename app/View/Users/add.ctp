<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>Register</legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('password_confirmation',array('type'=>'password'));
        echo $this->Form->input('nivel_id');
        echo $this->Form->input('persona_id');


        
    ?>
    </fieldset>
<?php echo $this->Form->end('Submit'); ?>
</div>
<div class="actions">
<h3>Actions</h3>
<ul>
<li><?php echo $this->Html->link('List Users', array('action'=>'index'));?></li>
</ul>
</div>