<div id="container4" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">
$(function () {
    // Create the chart
    $('#container4').highcharts({
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
              text: 'PRODUCTO'
          }
        },
        yAxis: {
            title: {
                text: 'CANTIDAD VENDIDA'
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
            name: 'PRODUCTO',
            colorByPoint: true,
            data: [<?php
                  include("../conexion.php");
                  $consulta="SELECT p.Idproducto, p.Tipo_producto, p.Nombre, sum(l.Cantidad) as total FROM detalle_pedido l , producto p where l.Producto_IdProducto=p.IdProducto GROUP BY l.Producto_IdProducto ORDER BY sum(l.Cantidad) DESC LIMIT 5;";
                  $result=$connection->query($consulta);
                  echo $connection->error;
                  while ($fila = $result->fetch_object()) {?>
                  {
                      name: "<?php echo $fila->Nombre; ?>",
                      y: <?php echo $fila->total; ?>
                  },
                  <?php } ?>
                  ]
        }],
    });
});
</script>
