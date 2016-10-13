
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="<?php echo base_url(); ?>assets/js/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/pie.js" type="text/javascript"></script>
        <?php
        $uid = $this->session->userdata('UID');
        $c = $cv;
        $i = $iv;
        $add = $c + $i;
        $u = $this->session->userdata('limit') - $add;
//SAVING USER SESSION
//        $USER_SESSION = $_SESSION["ROUGHSHEET_SCI"];
//        session_unset($_SESSION);
//        $_SESSION['UID'] = $uid;
//        $_SESSION["ROUGHSHEET_SCI"] = $USER_SESSION;
        ?>
        <script>
            function changeColor() {
                chart.dataProvider[0].color = "#24B060";
                chart.dataProvider[1].color = "#ff0000";
                chart.dataProvider[2].color = "#FFBF00";
                chart.validateData();
            }
            var chart;
            var legend;
            var chartData = [
                {
                    "type": "Correct",
                    "total": "<?php echo $c; ?>"
                },
                {
                    "type": "Incorrect",
                    "total": "<?php echo $i; ?>"
                },
                {
                    "type": "Skipped",
                    "total": "<?php echo $u; ?>"
                }
            ];
            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "type";
                chart.valueField = "total";
                chart.colorField = "color";
                // LEGEND
                legend = new AmCharts.AmLegend();
                legend.align = "center";
                legend.markerType = "circle";
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                chart.addLegend(legend);
                // WRITE
                chart.write("chartdiv");
                changeColor();
            });
        </script>
    </head>
    <body>
    <!--<p>Graphical Analysis</p>-->
        <div id="chartdiv" style="width: 100%; height:300px;"></div>
    </body>
</html>