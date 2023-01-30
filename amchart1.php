<?php
    $start=str_replace('-','/',$_POST['start']);
    $end=str_replace('-','/',$_POST['end']);
    $id=$_POST['idd'];
    $sql="select time_index,sumtime,median from
        (select * from(select a.time_index time_index2,round(avg(sumtime),1) median from
        (SELECT
              e1.time_index, e1.sumtime
         FROM
             (SELECT  time_index, sumtime, @rnk:=if(@pre=time_index, @rnk+1, 1) rnk, @pre:=time_index
             FROM RFID_drink, (SELECT @rnk:=0, @pre:=null)init
             ORDER by time_index, sumtime)e1 
             JOIN 
             (SELECT time_index, count(*) cnt FROM RFID_drink GROUP by time_index) e2
             using(time_index)
        WHERE e1.rnk in (cnt/2+0.5, cnt/2, cnt/2+1))  a
        group by time_index) b

        left JOIN RFID_drink
        on b.time_index2 = RFID_drink. time_index
        where id='".$id."') c  where time_index between '".$start."' and '".$end."'";
//     echo $sql;
    $servername = "localhost";
    $username = "root";
    $password = "mypassword";
    $dbname = "HangLung";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) 
        {
          die("Connection failed: " . $conn->connect_error);
        }
    $conn -> set_charset("utf8");
    $result = mysqli_query($conn, $sql);
    $conn->close();
    while($row = mysqli_fetch_assoc($result)) 
        {
//         $scatter[]=array("time_index" => $row['time_index'],"sumtime" => $row['sumtime']);
//         $line[]=array("time_index" => $row['time_index'],"median" => $row['median']);
        $array[] = $row;
        };
    $data=json_encode($array, JSON_UNESCAPED_UNICODE);
//     $sca=json_encode($scatter, JSON_UNESCAPED_UNICODE);
//     $lin=json_encode($line, JSON_UNESCAPED_UNICODE);
//     print_r($sca);
//     print_r($lin);
?>
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>
<div id="chartdiv"></div>
<script>
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = <?=$data;?>;
chart.dateFormatter.dateFormat = "yyyy/MM/dd";


var title = chart.titles.create();
title.text = "飲水行為追蹤";
title.fontSize = 25;
title.align="left";
title.marginBottom = 50;

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;
dateAxis.renderer.labels.template.rotation = -30;
// dateAxis.baseInterval = {
//   "timeUnit": "month",
//   "count": 1
// };
dateAxis.dateFormats.setKey("day", "yyyy/MM/dd");



var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
function createSeries(field, name) {
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "time_index";
  series.name = name;
  series.tooltipText = "{dateX}: [b]{valueY}[/]";
  series.strokeWidth = 2;
  series.smoothing = "monotoneX";
  
  var bullet = series.bullets.push(new am4charts.CircleBullet());
  bullet.circle.stroke = am4core.color("#fff");
  bullet.circle.strokeWidth = 2;
  
  return series;
}


function createSeriesdash(field, name) {
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "time_index";
  series.name = name;
  series.tooltipText = "{dateX}: [b]{valueY}[/]";
  series.strokeWidth = 2;
  series.strokeDasharray = "3,3";
  series.smoothing = "monotoneX";
  
//   var bullet = series.bullets.push(new am4charts.CircleBullet());
//   bullet.circle.stroke = am4core.color("#fff");
//   bullet.circle.strokeWidth = 2;
  
  return series;
}

createSeries("sumtime", "飲水次數");
createSeriesdash("median", "飲水次數中位數");


chart.legend = new am4charts.Legend();
chart.legend.marginTop = "20";
chart.cursor = new am4charts.XYCursor();
</script>