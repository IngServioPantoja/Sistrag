<?php echo $this->Form->create('Tiposestandar'); ?>
<div id="panel">
    <h3>Tipos de estandar</h3>
    <div style="text-align:center; padding:3px;">
        
    </br></br>
    <section class="panel_frame">
        <section class="panel_internal" style="border:0px solid #fff">
            <div class="crud">
                <div class="crud_fila_principal">
                    <span>
                        Jerarquía por programa
                    </span>
                </div>
                    <div class="crud_fila_secundaria">
                        <figure class="fondoAgregar">
                            <?php
                            echo $this->Html->image('recursos/escudo400.png', array('width' => '200px'));
                            ?>
                        </figure>
                        <article class='fichaAgregar'>
                            <div class='entradas'>  
                                <?php echo $this->Form->create('Tiposestandar',array('controler'=>'tiposestandares','action'=>'picklist')); ?>
                                <div>
                                    <div>
                                        <strong><label for="PersonaAvatar">Programa:</label></strong>
                                    </div>
                                    <div>
                                        <?php echo $this->Form->input('programa_id',array('label'=>false,'required'=>'required','id'=>'programactual')); ?>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <strong><label for="PersonaIdentificacion">Descripción:</label></strong>
                                    </div>
                                    <?php echo $this->Form->input('nombre',array('label'=>false,'div'=>false,"autocomplete"=>"off",'required'=>'required','style'=>'width:130px;min-width: 130px !important;display:inline:block;float:none !important;','id'=>'noenter')); 
                                    ?>
                                     <button type="button" class="btn btn-success btn-sm use-tooltip" data-toggle="tooltip" data-placement="top" title="agregar" id="botonAgregar">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </div>
                                <?php echo $this->Form->end(__('')); ?>
                            </div>
                                <?php echo $this->Form->create('Tiposestandar'); ?>
                                <?php echo $this->Form->hidden('programa_id',array('value'=>$programa_padre)); ?>
                            <div style="width: auto;display: inline-block;text-align:center;" id="pickList">
                                <div id="basic" style="text-align:left;">  
                                    <select name="source[]" multiple="multiple">  
                                         <?php
                                        foreach ($tiposestandares as $tipoestandar) {
                                        ?>
                                        <option value="<?php echo $tipoestandar['Tiposestandar']['id']; ?>"><?php echo $tipoestandar['Tiposestandar']['nombre']; ?></option>  
                                        <?php
                                        }
                                        ?>
                                    </select>  
                                </div>
                                </br>
                                <input type="submit" class="Guardar" style="padding:10px 20px;">
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
<div id="basura" style="opacity:0;">
</div>
<script type="text/javascript">
    $(function () {
        $('#panel').puiaccordion();
        $('#basic').puipicklist(
            {  
                standarControls: false,
                dualList: false,
                dragdrop:false,
                showSourceControls: true
            }  
        ); 
        $('#multiple').puiaccordion({ multiple: false });
        $('.submit').puibutton();

        $('#noenter').bind('keypress', function(e) 
        {
            var code = e.keyCode || e.which;
             if(code == 13) { //Enter keycode
               e.preventDefault();
             }
        });
    });
</script>
<?php
$this->Js->get('#botonAgregar')->event('click',
    $this->Js->request(
        array(
            'action' => 'picklist',
        ),
        array(
            'update'=>'#pickList',
            'async' => true,
            'method' => 'post',
            'dataExpression'=>true,
            'data'=> $this->Js->serializeForm(array(
                'isForm' => false,
                'inline' => true
            ))
        )
    )
);
?>
<?php
$this->Js->get('#programactual')->event('change',
    $this->Js->request(
        array(
            'action' => 'componentesPrograma',
        ),
        array(
            'update'=>'#pickList',
            'async' => true,
            'method' => 'post',
            'dataExpression'=>true,
            'data'=> $this->Js->serializeForm(array(
                'isForm' => false,
                'inline' => true
            ))
        )
    )
);
?>





