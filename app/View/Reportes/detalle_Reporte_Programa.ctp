<?php

$this->layout = false;
$nombrePersona=$persona['Persona']['nombre']." ".$persona['Persona']['apellido'];
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-sistrag-azul">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h3 class="modal-title" id="myModalLabel">Reporte: <strong><?php echo $persona['Persona']['nombre']." ".$persona['Persona']['apellido'];?></strong></h3>
    </div>
    <div class="modal-body contenedor-grafica" id="container">
    </div>
    <div class="modal-body contenedor-grafica" id="container-linea">
    </div>
    <div class="modal-footer">
    </div>
  </div>
</div>

<script type="text/javascript">
var nombrePersona="<?php echo $nombrePersona; ?>";
$(function () {
     $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Trabajos de grado por Área de investigación'
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
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
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
            series: [{
                name: 'Tokyo',
                data: [49.9]
    
            }, {
                name: 'New York',
                data: [83.6]
    
            }, {
                name: 'London',
                data: [38.8]
    
            }, {
                name: 'Berlin',
                data: [42.4]
    
            }]
        });
    // Reporte por línea
    
});
</script>

