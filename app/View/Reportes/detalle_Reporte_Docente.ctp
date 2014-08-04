<?php

$this->layout = false;

?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-sistrag-azul">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h3 class="modal-title" id="myModalLabel">Reporte: <strong><?php echo $persona['Persona']['nombre']." ".$persona['Persona']['apellido'];?></strong></h3>
    </div>
    <div class="modal-body contenedor-grafica" id="container">
      
    </div>
    <div class="modal-footer">
    </div>
  </div>
</div>

<script type="text/javascript">
    var Trabajos =['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas'];

$(function () {
    $('#container').highcharts({

        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 25,
                depth: 40
            },
            marginTop: 80,
            marginRight: 40
        },

        title: {
            text: 'Trabajos asesorados y evaluados'
        },

        xAxis: {
            categories: <?php echo $estandares;?>
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Cantidad de trabajos de grado'
            }
        },

        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
        },

        plotOptions: {
            column: {
                stacking: 'normal',
                depth: 40
            }
        },

        series: [{
            name: 'Asesor',
            data: [3, 3, 4]
        },
        {
            name: 'Jurado',
            data: [3, 1, 6]
        }]
    });
});
</script>

