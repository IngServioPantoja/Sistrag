<?php

$this->layout = false;
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-sistrag-azul">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title" id="myModalLabel">Reporte programa de : <strong><?php echo $programa['Programa']['nombre'];?></strong></h4>
    </div>
    <div class="modal-body contenedor-grafica" id="container" >
    </div>
    <div class="modal-body contenedor-grafica" id="container-linea">
    </div>
    <div class="modal-footer">
    </div>
  </div>
</div>
<script>
var nombrePrograma="<?php echo $programa['Programa']['nombre']; ?>";
$(function () {
     $('#container').highcharts({
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Trabajos de grado por estado de proyecto'
        },
        xAxis: {
            categories: [
                'Trabajos de grado'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad de trabajos de grado'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span></br><table class="pull-left">',
            pointFormat: '<tr><td style="color:{series.color};padding:0"><strong>{series.name}: </strong></td>' +
                '<td style="padding:0">{point.y:.1f}</td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: <?php echo $reporte; ?>
    });
    // Reporte por línea
});
</script>



