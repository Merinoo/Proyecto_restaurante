<div id="container2" style="width: 1230px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">
$(function () {
    // Create the chart
    $('#container2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
          type: 'category',
          title: {
              text: 'TIPO PRODUCTOS'
          }
        },
        yAxis: {
            title: {
                text: 'CANTIDAD DE PRODUCTOS'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: ''
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b><br/>'
        },
        series: [{
            name: 'Tipo PRODUCTOS',
            colorByPoint: true,
            data: [<?php
                  include("../conexion.php");
                  $result=$connection->query("SELECT COUNT(*) AS SUMA,Tipo_producto FROM producto GROUP BY Tipo_producto; ");
                  echo $connection->error;
                  while ($fila = $result->fetch_object()) {?>
                  {
                      name: "<?php echo $fila->Tipo_producto ?>",
                      y: <?php echo $fila->SUMA; ?>
                  },
                  <?php } ?>
                  ]
        }],
    });
});
</script>
