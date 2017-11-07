<?php
$json = json_decode(file_get_contents('svm-test-data.json'));
$res = [['x','label0','label1']];
foreach ($json as $j) {
  $label = $j[0];
  $x = $j[1];
  $y = $j[2];
  if ($label == 0) {
    $res[] = [$x, $y, null];
  } else {
    $res[] = [$x, null, $y];
  }
}
$dat1 = json_encode($res);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var dat1 = google.visualization.arrayToDataTable(
          <?php echo $dat1; ?>
        );
        var options = {
          title: '',
          hAxis: {title: 'y', minValue: 0, maxValue: 1},
          vAxis: {title: 'x', minValue: 0, maxValue: 1},
          legend: '',
          pointSize: 6,
          series: {
            0: { pointShape: 'square' },
            1: { pointShape: 'circle' },
          }
        };
        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
        chart.draw(dat1, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>

