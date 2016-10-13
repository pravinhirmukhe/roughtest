<?php
$uid = $this->session->userdata('UID');
$subid = $this->session->userdata('subid_graph');
?>
<script type="text/javascript" src="<?php echo SITEURL; ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/js/amcharts.js" type="text/javascript"></script>
<script src="<?php echo SITEURL; ?>/assets/js/serial.js" type="text/javascript"></script>
<style type="text/css">
    .amcharts-graph-g1 .amcharts-graph-stroke {
        stroke-dasharray: 3px 3px;
        stroke-linejoin: round;
        stroke-linecap: round;
        -webkit-animation: am-moving-dashes 1s linear infinite;
        animation: am-moving-dashes 1s linear infinite;
    }
    @-webkit-keyframes am-moving-dashes {
        100% {
            stroke-dashoffset: -30px;
        }
    }
    @keyframes am-moving-dashes {
        100% {
            stroke-dashoffset: -30px;
        }
    }
    .lastBullet {
        -webkit-animation: am-pulsating 1s ease-out infinite;
        animation: am-pulsating 1s ease-out infinite;
    }
    @-webkit-keyframes am-pulsating {
        0% {
            stroke-opacity: 1;
            stroke-width: 0px;
        }
        100% {
            stroke-opacity: 0;
            stroke-width: 50px;
        }
    }
    @keyframes am-pulsating {
        0% {
            stroke-opacity: 1;
            stroke-width: 0px;
        }
        100% {
            stroke-opacity: 0;
            stroke-width: 50px;
        }
    }
    .amcharts-graph-column-front {
        -webkit-transition: all .3s .3s ease-out;
        transition: all .3s .3s ease-out;
    }
    .amcharts-graph-column-front:hover {
        fill: #496375;
        stroke: #496375;
        -webkit-transition: all .3s ease-out;
        transition: all .3s ease-out;
    }
    .amcharts-graph-g2 {
        stroke-linejoin: round;
        stroke-linecap: round;
        stroke-dasharray: 500%;
        stroke-dasharray: 0 \0/;    /* fixes IE prob */
        stroke-dashoffset: 0 \0/;   /* fixes IE prob */
        -webkit-animation: am-draw 40s;
        animation: am-draw 40s;
    }
    @-webkit-keyframes am-draw {
        0% {
            stroke-dashoffset: 500%;
        }
        100% {
            stroke-dashoffset: 0px;
        }
    }
    @keyframes am-draw {
        0% {
            stroke-dashoffset: 500%;
        }
        100% {
            stroke-dashoffset: 0px;
        }
    }
</style>

<?php
$sub_name = $this->site->getSubName($subid);
$d = (array) $this->db->get_where(DPP_LOG, array('UID' => $uid, 'sub_id' => $subid))->row();
//$q = mysql_query("select * from " . DPP_LOG . " where UID='$uid' and sub_id='$subid'") or error_log(mysql_error());
//$d = mysql_fetch_assoc($q);
$time_arr = array();
$data_arr = array();
if (count($d)) {
    $time_arr = json_decode($d['dpp_time']);
    $data_arr = json_decode($d['data']);
    $permonth = $this->session->userdata('perfMonth');
}
if (isset($permonth)) {
    $month_arr = explode("-", $permonth);
    //  print_r($month_arr);
    $month = $month_arr[0];
    $year = $month_arr[1];
    if (strlen($month) == 1) {
        $month = '0' . $month;
    }
    $alpha_month = date("F", strtotime('01-' . $month . '-' . $year));
} else {
    $month = date("m");
    $alpha_month = date("F");
    $year = date("Y");
//    $_SESSION['perfMonth'] = $month . '-' . $year;
    $this->session->set_userdata('perfMonth', $month . '-' . $year);
}
$graph_date_arr = array();
$p = 0;
//print_r($time_arr);
//echo date("d/m/Y",$time_arr[0]);
foreach ($time_arr as $k => $v) {
    $dpp_date = date("Y-m-d", $v);
    $dpp_month = date("m", $v);
    $dpp_year = date("Y", $v);
    if ($dpp_month == $month && $dpp_year == $year) {
        $graph_date_arr[$dpp_date] = $data_arr[$p];
    }
    $p++;
}
//print_r($graph_date_arr);
?>
<?php
$c = count($graph_date_arr);
if ($c == 0) {
    echo"<center><pre style='color: #333; margin-bottom:0px;'>" . strtoupper($sub_name) . " ($alpha_month)</pre></center>";
    echo"<br><div class='alert alert-info'><center>No DPPS Attempted.</center></div>";
    goto IGNORE;
} else {
    $c--;
    echo"<center><pre style='color: #333; margin-bottom:0px;'>" . strtoupper($sub_name) . " ($alpha_month)</pre></center>";
    $no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $str = "";
    $j = 0;
    for ($i = 1; $i <= $no_of_days; $i++) {
        if (strlen($i) == 1) {
            $i = "0$i";
        }
        $date = $year . "-" . $month . "-" . $i;
        if (isset($graph_date_arr[$date])) {
            $correct = $graph_date_arr[$date][0];
            $incorrect = $graph_date_arr[$date][1];
            //$unattempted=$graph_date_arr[$date][2];
            //$total=$correct+$incorrect+$unattempted;
            $marks = $correct * 3 - $incorrect;
            $accuracy = $graph_date_arr[$date][3];
            if ($j == 0) {
                $str.="{
                    \"date\": \"$date\",
                    \"distance\": 1,
                    \"townSize\": 25,
                    \"Correct\": $marks,
                    \"duration\": $accuracy
                    }";
            } elseif ($j == $c) {
                $str.=",{
                    \"date\": \"$date\",
                    \"distance\": 1,
                    \"townSize\": 16,
                    \"Correct\": $marks,
                    \"duration\": $accuracy,
                    \"bulletClass\": \"lastBullet\"
                    }";
            } else {
                $str.=",{
                    \"date\": \"$date\",
                    \"distance\": 1,
                    \"townSize\": 16,
                    \"Correct\": $marks,
                    \"duration\": $accuracy
                    }";
            }
            $j++;
        }
    }
}
?>
<script>
    // note, we have townName field with a name specified for each datapoint and townName2 with only some of the names specified.
    // we use townName2 to display town names next to the bullet. And as these names would overlap if displayed next to each bullet,
    // we created this townName2 field and set only some of the names for this purpse.
    var chartData = [
<?php
echo isset($str) ? $str : "";
?>
    ];
    var chart;
    AmCharts.ready(function () {
        // SERIAL CHART
        chart = new AmCharts.AmSerialChart();
        chart.addClassNames = true;
        chart.dataProvider = chartData;
        chart.categoryField = "date";
        chart.dataDateFormat = "YYYY-MM-DD";
        chart.startDuration = 1;
        chart.color = "#333";
        chart.marginLeft = 0;
        // AXES
        // category
        var categoryAxis = chart.categoryAxis;
        categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
        categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
        categoryAxis.autoGridCount = false;
        categoryAxis.gridCount = 50;
        categoryAxis.gridAlpha = 0.1;
        categoryAxis.gridColor = "#FFFFFF";
        categoryAxis.axisColor = "#555555";
        // we want custom date formatting, so we change it in next line
        categoryAxis.dateFormats = [{
                period: 'DD',
                format: 'DD'
            }, {
                period: 'WW',
                format: 'MMM DD'
            }, {
                period: 'MM',
                format: 'MMM'
            }, {
                period: 'YYYY',
                format: 'YYYY'
            }];
        // as we have data of different units, we create three different value axes
        // Distance value axis
        var distanceAxis = new AmCharts.ValueAxis();
        distanceAxis.title = "distance";
        distanceAxis.gridAlpha = 0;
        distanceAxis.axisAlpha = 0;
        chart.addValueAxis(distanceAxis);
        // latitude value axis
        var latitudeAxis = new AmCharts.ValueAxis();
        latitudeAxis.gridAlpha = 0;
        latitudeAxis.axisAlpha = 0;
        latitudeAxis.labelsEnabled = false;
        latitudeAxis.position = "right";
        chart.addValueAxis(latitudeAxis);
        // duration value axis
        var durationAxis = new AmCharts.ValueAxis();
        durationAxis.title = "Accuracy";
        // the following line makes this value axis to convert values to duration
        // it tells the axis what duration unit it should use. mm - minute, hh - hour...
        durationAxis.duration = "";
        durationAxis.durationUnits = {
            DD: "",
            hh: "",
            mm: "",
            ss: ""
        };
        durationAxis.gridAlpha = 0;
        durationAxis.axisAlpha = 0;
        durationAxis.inside = false;
        durationAxis.position = "left";
        chart.addValueAxis(durationAxis);
        // GRAPHS
        // distance graph
        // latitude graph
        var latitudeGraph = new AmCharts.AmGraph();
        latitudeGraph.valueField = "Correct";
        latitudeGraph.id = "g1";
        latitudeGraph.classNameField = "bulletClass";
        latitudeGraph.title = "Marks Obtained";
        latitudeGraph.type = "line";
        latitudeGraph.valueAxis = latitudeAxis; // indicate which axis should be used
        latitudeGraph.lineColor = "#786c56";
        latitudeGraph.lineThickness = 1;
        latitudeGraph.legendValueText = "[[description]]/[[value]]";
        latitudeGraph.descriptionField = "townName";
        latitudeGraph.bullet = "round";
        latitudeGraph.bulletSizeField = "townSize"; // indicate which field should be used for bullet size
        latitudeGraph.bulletBorderColor = "#786c56";
        latitudeGraph.bulletBorderAlpha = 1;
        latitudeGraph.bulletBorderThickness = 2;
        latitudeGraph.bulletColor = "#000000";
        latitudeGraph.labelText = "[[townName2]]"; // not all data points has townName2 specified, that's why labels are displayed only near some of the bullets.
        latitudeGraph.labelPosition = "right";
        latitudeGraph.balloonText = "Marks:[[value]]";
        latitudeGraph.showBalloon = true;
        latitudeGraph.animationPlayed = true;
        chart.addGraph(latitudeGraph);
        // duration graph
        var durationGraph = new AmCharts.AmGraph();
        durationGraph.id = "g2";
        durationGraph.title = "Accuracy (%)";
        durationGraph.valueField = "duration";
        durationGraph.type = "line";
        durationGraph.valueAxis = durationAxis; // indicate which axis should be used
        durationGraph.lineColor = "#ff5755";
        durationGraph.balloonText = "Accuracy:[[value]]";
        durationGraph.lineThickness = 1;
        durationGraph.legendValueText = "Accuracy:[[value]]";
        durationGraph.bullet = "square";
        durationGraph.bulletBorderColor = "#ff5755";
        durationGraph.bulletBorderThickness = 1;
        durationGraph.bulletBorderAlpha = 1;
        durationGraph.dashLengthField = "dashLength";
        durationGraph.animationPlayed = true;
        chart.addGraph(durationGraph);
        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.zoomable = false;
        chartCursor.categoryBalloonDateFormat = "DD";
        chartCursor.cursorAlpha = 0;
        chartCursor.valueBalloonsEnabled = false;
        chart.addChartCursor(chartCursor);
        // LEGEND
        var legend = new AmCharts.AmLegend();
        legend.bulletType = "round";
        legend.equalWidths = false;
        legend.valueWidth = 120;
        legend.useGraphSettings = true;
        legend.color = "#333";
        chart.addLegend(legend);
        // WRITE
        chart.write("chartdiv");
    });
</script>
</head>
<body style="background-color:#eee;">
    <div style="color:#333; font-weight:bold; text-align:center;cursor: crosshair;"></div>
    <div id="chartdiv" style="width:100%; height:385px;cursor:crosshair"></div>
    <?php
    IGNORE:
    ?>
</body>