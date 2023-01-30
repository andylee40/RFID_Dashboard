<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
body{ width: 80%; 
      margin:0 10% 0 10%;
      background-color:white}

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: true,
  panY: true,
  wheelY: "zoomXY",
  pinchZoomX:true,
  pinchZoomY:true
}));

    
// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererX.new(root, { minGridDistance: 50 }),
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererY.new(root, {}),
  tooltip: am5.Tooltip.new(root, {})
}));

    
//座標軸文字  
xAxis.children.push(
  am5.Label.new(root, {
    text: "進食次數",
    x: am5.p25,
    centerX:am5.p50
  })
);    
    
yAxis.children.unshift(
  am5.Label.new(root, {
    rotation: -90,
    text: "飲水次數",
    y: am5.p50,
    centerX: am5.p50
  })
);
    
// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series0 = chart.series.push(am5xy.LineSeries.new(root, {
  calculateAggregates: true,
  name:"正常",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "ay",
  valueXField: "ax",
  legendLabelText: "{name}",
  legendRangeLabelText: "{name}",
  tooltip: am5.Tooltip.new(root, {
    labelText: "進食: {valueX} 飲水:{valueY}"
  })
}));


// Add bullet
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/#Bullets
series0.bullets.push(function() {
  var graphics = am5.Triangle.new(root, {
//     stroke : "#ffbb00",
    fill: series0.set("fill", am5.color("#228B22")),
    width: 15,
    height: 13
  });
  return am5.Bullet.new(root, {
    sprite: graphics,
  });
});


// Create second series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series1 = chart.series.push(am5xy.LineSeries.new(root, {
  calculateAggregates: true,
  name:"異常",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "by",
  valueXField: "bx",
  legendLabelText: "{name}",
  legendRangeLabelText: "{name}",
  tooltip: am5.Tooltip.new(root, {
    labelText: "進食: {valueX} 飲水:{valueY}"
  })
}));

series0.strokes.template.set("strokeOpacity", 0);
series1.strokes.template.set("strokeOpacity", 0);
// series1.stroke = "#ffbb00";
// bullet.stroke = am5core.color("#ffbb00");
// bullet.fill = am5core.color("#ffbb00");

// Add bullet
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/#Bullets
series1.bullets.push(function() {
  var graphics = am5.Triangle.new(root, {
    fill: series1.set("fill", am5.color(0xff0000)),
    width: 15,
    height: 13,
    rotation: 180
  });
  return am5.Bullet.new(root, {
    sprite: graphics
  });
});

// trend series
// var trendSeries0 = chart.series.push(am5xy.LineSeries.new(root, {
//   xAxis: xAxis,
//   yAxis: yAxis,
//   valueYField: "y",
//   valueXField: "x",
//   stroke: series0.get("stroke")
// }));

// trendSeries0.data.setAll([
//   { x: 1, y: 2 },
//   { x: 12, y: 11 }
// ])

// var trendSeries1 = chart.series.push(am5xy.LineSeries.new(root, {
//   xAxis: xAxis,
//   yAxis: yAxis,
//   valueYField: "y",
//   valueXField: "x",
//   stroke: series1.get("stroke")
// }));

// trendSeries1.data.setAll([
//   { x: 1, y: 1 },
//   { x: 12, y: 19 }
// ])

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
chart.set("cursor", am5xy.XYCursor.new(root, {
  xAxis: xAxis,
  yAxis: yAxis,
  snapToSeries: [series0, series1]
}));

// Add scrollbars
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
    
// chart.set("scrollbarX", am5.Scrollbar.new(root, {
//   orientation: "horizontal"
// }));

// chart.set("scrollbarY", am5.Scrollbar.new(root, {
//   orientation: "vertical"
// }));

var data=[{"ax": 5,"ay": 150},{"bx": 2,"by": 200},{"ax": 6,"ay": 155},{"bx": 7,"by": 220},{"ax": 8,"ay": 160},{"bx": 9,"by": 280},{"ax": 13,"ay": 120},{"bx": 18,"by": 300},{"ax": 20,"ay": 150},{"bx": 18,"by": 200},]

    
var legend = chart.children.push(am5.Legend.new(root, {centerX: am5.percent(50),x: am5.percent(50),y: am5.percent(98)}));
legend.data.setAll(chart.series.values);    

    
series0.data.setAll(data);
series1.data.setAll(data);
// series1.set("fill", am5.color(0xff0000));

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series0.appear(100);
series1.appear(100);

trendSeries0.appear(1000);
trendSeries1.appear(1000);

chart.appear(100, 100);

}); // end am5.ready()


</script>

<!-- HTML -->
<div style="margin-top:1em;text-align:center;font-size:25px">昨日豬隻行為資料分佈</div>
<div id="chartdiv"></div>