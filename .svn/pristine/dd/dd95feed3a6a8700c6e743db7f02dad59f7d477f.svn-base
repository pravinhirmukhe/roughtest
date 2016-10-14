<?php
$date = date("Y-m-d");
$group_id = $this->session->userdata('group_id');
?>

<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <?php if($group_id == 1){?>
        <div class="content-top clearfix">
            <div class="banner">
                <?php if (isset($subjects)) { ?>
                    <h5><?php echo $subjects[0]->sub_name; ?></h5>
                <?php } ?>
            </div>
            <div class=" col-lg-12">
                <?php for ($i = 0; $i < count($topic[0]); $i++) { ?>
                    <div class="col-md-3 content-top-1 mg" >
                        <h5 class="text-item17"><?php echo $topic[0][$i]->topic_name; ?></h5>
                        <h6>No of Questions </h6>
                        <div class="col-md-4 top-content">                            
                            <label><?php echo $queCount[$i][0]->total;?></label>
                        </div>
                        <div class="col-md-8 top-content1 text-right" style="padding:10px;">	   
                            <h6>Key Concepts </h6>
                            <?php if(!empty($keyConcept[$i])){?> 
                                <label style="color: green;">Y </label>
                            <?php }else {?>
                                <label style="color: red;">N </label>
                            <?php }?>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                <?php } ?> 
            </div> 
        </div>
        
        <div class="content-top clearfix">
            <div class="banner">
                <?php if (isset($subjects)) { ?>
                    <h5><?php echo $subjects[1]->sub_name; ?></h5>
                <?php } ?>
            </div>
            <div class=" col-lg-12">
                <?php for ($i = 0; $i < count($topic[1]); $i++) { ?>
                    <div class="col-md-3 content-top-1 mg" >
                        <h5 class="text-item17"><?php echo $topic[1][$i]->topic_name; ?></h5>
                        <h6>No of Questions </h6>
                        <div class="col-md-4 top-content">                            
                            <label><?php echo $queCount[$i][0]->total;?></label>
                        </div>
                        <div class="col-md-8 top-content1 text-right" style="padding:10px;">	   
                            <h6>Key Concepts </h6>
                            <?php if(!empty($keyConcept[$i])){?> 
                                <label style="color: green;">Y </label>
                            <?php }else {?>
                                <label style="color: red;">N </label>
                            <?php }?>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                <?php } ?> 
            </div> 
        </div>
        
        <div class="content-top clearfix">
            <div class="banner">
                <?php if (isset($subjects)) { ?>
                    <h5><?php echo $subjects[2]->sub_name; ?></h5>
                <?php } ?>
            </div>
            <div class=" col-lg-12">
                <?php for ($i = 0; $i < count($topic[2]); $i++) { ?>
                    <div class="col-md-3 content-top-1 mg" >
                        <h5 class="text-item17"><?php echo $topic[2][$i]->topic_name; ?></h5>
                        <h6>No of Questions </h6>
                        <div class="col-md-4 top-content">                            
                            <label><?php echo $queCount[$i][0]->total;?></label>
                        </div>
                        <div class="col-md-8 top-content1 text-right" style="padding:10px;">	   
                            <h6>Key Concepts </h6>
                            <?php if(!empty($keyConcept[$i])){?> 
                                <label style="color: green;">Y </label>
                            <?php }else {?>
                                <label style="color: red;">N </label>
                            <?php }?>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                <?php } ?> 
            </div> 
        </div>
        
        <div class="content-top clearfix">
            <div class="banner">
                <?php if (isset($subjects)) { ?>
                    <h5><?php echo $subjects[3]->sub_name; ?></h5>
                <?php } ?>
            </div>
            <div class=" col-lg-12">
                <?php for ($i = 0; $i < count($topic[3]); $i++) { ?>
                    <div class="col-md-3 content-top-1 mg" >
                        <h5 class="text-item17"><?php echo $topic[3][$i]->topic_name; ?></h5>
                        <h6>No of Questions </h6>
                        <div class="col-md-4 top-content">                            
                            <label><?php echo $queCount[$i][0]->total;?></label>
                        </div>
                        <div class="col-md-8 top-content1 text-right" style="padding:10px;">	   
                            <h6>Key Concepts </h6>
                            <?php if(!empty($keyConcept[$i])){?> 
                                <label style="color: green;">Y </label>
                            <?php }else {?>
                                <label style="color: red;">N </label>
                            <?php }?>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                <?php } ?> 
            </div> 
        </div>
        
        <!--graph-->
    <div class="content-top clearfix">
        <input type ="hidden" id="prev_date" value="">
        <div class="graph">
            <div class="graph-grid">
                <div class="col-md-6 graph-1">
                    <div class="grid-1">
                        <h5>User SignUp(Week)</h5>
                        <span id="show_week"><?php echo $date; ?></span>
                        <canvas id="bar1" height="300" width="500" style="width: 500px; height: 300px;"></canvas>
                        <script>
                                var barChartData = {
                                        labels : <?= $res_weekData ?>,
                                        datasets : [
                                                {
                                                        fillColor : "#FBB03B",
                                                        strokeColor : "#FBB03B",
                                                        data : <?= $res_weekcountData ?>
                                                }
                                        ]

                                };
                                        new Chart(document.getElementById("bar1").getContext("2d")).Bar(barChartData);
                        </script>
                    </div>
                </div>
                <div class="col-md-6 graph-2">
                    <div class="grid-1">
                        <h5>User SignUp(Year) <span ><a href="javascript:prev_year();">Prev</a></span><span id="nxt_link"><a href="javascript:next_year();">Next</a></span>
                            
                        </h5>
                        <span id="show_year"></span>
                      
                        <canvas id="line1" height="300" width="500" style="width: 500px; height: 300px;"></canvas>
                        <script>
                            var lineChartData = {
                                    labels : <?= $res_monthData ?>,
                                    datasets : [
                                            {
                                                    fillColor : "#fff",
                                                    strokeColor : "#1ABC9C",
                                                    pointColor : "#1ABC9C",
                                                    pointStrokeColor : "#1ABC9C",
                                                    data : <?= $res_countData ?>
                                            }
                                    ]

                            };
                            new Chart(document.getElementById("line1").getContext("2d")).Line(lineChartData);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
     <!--graph-->
    <div class="content-top clearfix">
        <div class="graph">
            <div class="graph-grid">
                <div class="col-md-6 graph-1">
                    <div class="grid-1">
                        <h5>User SignUp(Current Date)</h5>
                        <canvas id="bar" height="300" width="500" style="width: 500px; height: 300px;"></canvas>
                        <script>
                                var barChartData = {
                                        labels : <?= $res_dayData ?>,
                                        datasets : [
                                                {
                                                        fillColor : "#FBB03B",
                                                        strokeColor : "#FBB03B",
                                                        data : <?= $res_daycountData ?>
                                                }
                                        ]

                                };
                                        new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php } ?>
        <?php $this->load->view('admin/layout/footer'); ?>
    </div>
   
    <div class="clearfix"></div>
</div>
<script>
    $("document").ready(function(){
        $("#nxt_link").css("display","none");
        var date = new Date();
        var yr = date.getFullYear();
        $("#prev_date").val(yr);
        $("#show_year").html(yr);
    });
    function prev_year(){
       
        //prev.setDate(current_date.getDate() - 1);
        $("#nxt_link").css("display","block");
        var c_yr =$("#prev_date").val();
        var prev = c_yr - 1;
        $("#prev_date").val(prev);
        $("#show_year").html(prev);
        $.ajax({
            url: "<?php $siteurl?>Admin_controller/getPrevGraph",
            type: 'POST',
            dataType: "json",
            data: {
              sel_yr:prev
            },
            success: function(data) {
                if(data.res_monthData != 'null' && data.res_countData !='null'){
                    var lineChartData = {
                              labels : data.res_monthData,
                              datasets : [
                                      {
                                              fillColor : "#fff",
                                              strokeColor : "#1ABC9C",
                                              pointColor : "#1ABC9C",
                                              pointStrokeColor : "#1ABC9C",
                                              data :data.res_countData
                                      }
                              ]

                      };
                      new Chart(document.getElementById("line1").getContext("2d")).Line(lineChartData);
                }else{

                }
            },
            error: function(data) {
               alert("Error");
            }
            
         });
    }
    
    
     function next_year(){
       
        //prev.setDate(current_date.getDate() - 1);
        var c_yr =$("#prev_date").val();
        var prev = parseInt(c_yr) + 1;
        $("#prev_date").val(prev);
        $("#show_year").html(prev);
        $.ajax({
            url: "<?php $siteurl?>Admin_controller/getPrevGraph",
            type: 'POST',
            dataType: "json",
            data: {
              sel_yr:prev
            },
            success: function(data) {
                if(data.res_monthData != 'null' && data.res_countData !='null'){
                  var lineChartData = {
                            labels : data.res_monthData,
                            datasets : [
                                    {
                                            fillColor : "#fff",
                                            strokeColor : "#1ABC9C",
                                            pointColor : "#1ABC9C",
                                            pointStrokeColor : "#1ABC9C",
                                            data :data.res_countData
                                    }
                            ]

                    };
                    new Chart(document.getElementById("line1").getContext("2d")).Line(lineChartData);
                }else{

                }
            },
            error: function(data) {
               alert("Error");
            }
            
         });
    }
    
</script>