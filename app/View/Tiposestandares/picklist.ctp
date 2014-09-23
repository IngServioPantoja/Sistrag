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
<input type="submit" class="submit" style="padding:10px 20px;">
<script type="text/javascript">
    $(function () {
        $('#basic').puipicklist(
            {  
                standarControls: false,
                dualList: false,
                dragdrop:false,
                showSourceControls: true
            }  
        ); 
        $('.submit').puibutton();
    });
</script>