<?php
    $start=str_replace('-','/',$_POST['start']);
    $end=str_replace('-','/',$_POST['end']);
    $id=$_POST['idd'];
    $sql="SELECT t1.time_index, t1.sumtime drink,t2.sumtime food
        FROM RFID_drink t1
        LEFT JOIN RFID_food t2 
        ON t1.id=t2.id and t1.time_index=t2.time_index
        where t1.id='".$id."' and t1.time_index between '".$start."' and '".$end."'";
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
        $row['drink']=intval($row['drink']);
        $row['food']=intval($row['food']);
        $array[] = $row;
        };
    $data=json_encode($array, JSON_UNESCAPED_UNICODE);

?>
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="//cdn.amcharts.com/lib/4/themes/kelly.js"></script>
<div id="chartdiv"></div>
<script>
am4core.useTheme(am4themes_kelly);

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);
// Add data
chart.data = <?=$data;?>;
chart.dateFormatter.dateFormat = "yyyy/MM/dd";



var title = chart.titles.create();
title.text = "過去行為統計";
title.fontSize = 25;
title.align="left";
title.marginBottom = 50;


// Create axes
// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;
dateAxis.renderer.labels.template.rotation = -30;
// dateAxis.baseInterval = {
//   "timeUnit": "month",
//   "count": 1
// };
dateAxis.dateFormats.setKey("day", "yyyy/MM/dd");

var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
//valueAxis.title.text = "行為次數";

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "food";
series.dataFields.dateX = "time_index";
series.name = "進食次數";
series.tooltipText = "{name}: [bold]{valueY}[/]";
// This has no effect
// series.stacked = true;

var series2 = chart.series.push(new am4charts.ColumnSeries());
series2.dataFields.valueY = "drink";
series2.dataFields.dateX = "time_index";
series2.name = "飲水次數";
series2.tooltipText = "{name}: [bold]{valueY}[/]";
// Do not try to stack on top of previous series
// series2.stacked = true;



// Add cursor
chart.cursor = new am4charts.XYCursor();

// Add legend
chart.legend = new am4charts.Legend();
chart.legend.marginTop = "20";
</script>