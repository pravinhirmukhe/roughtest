<?php
/*echo "<pre>";
print_r($_POST);print_r($subjectName);print_r($marks);print_r($userName);
echo "</pre>";
die();*/
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <!--//banner-->
        <!--content-->
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive">
                        <form id="xform" onsubmit="return bulkDelete()">
                            <input type="hidden" name="key" value="kc_id"/>
                            <input type="hidden" name="tab" value="rs_key_concepts_27062015"/>
                            <div class="panel panel-default">
                                <div class="panel-heading" style="border-radius: 0px;padding: 0px">
                                    <h3 class="panel-title pull-left" style="padding: 8px">Key Concepts<small></small></h3>
                                    <span class="pull-right btn-group">
                                        <button type="button" class="btn btn-default" onclick="oTable.fnDraw();" title="Refresh"><i class="fa fa-refresh"></i></button>
                                        
                                    </span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <table id="getData1" class="dataTable table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th style="min-width:30px; width: 30px; text-align: center;">
                                                    <input name="select_all" value="1" type="checkbox" class="select_all"/>
                                                </th>
                                                <th class="col-xs-2" style="text-align: center;">Rank</th>
                                                <th class="col-xs-2" style="text-align: center;">Student Name</th>
                                                <th class="col-xs-1">10th Percentage</th>
                                                <th class="col-xs-1">12th Percentage</th>
                                                <th class="col-xs-2">Subject</th>
                                                <th style="width:80px; text-align:center;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php //for($i=0;$i<count($filtered_uid_arr);$i++){
                                            if ($arr_count != 0) {
                                                for ($i = 0; $i < $arr_count; $i++) {
                                                    if ($current_rank > $rank_limit) {
                                                        break;
                                                    } else {
                                                        $current_user = $filtered_uid_arr[$i];
                                                        $f_d_fetch = $this->site->getUserInfo($current_user);

                                                        //for the rowspan value we can check in data2sort array that how many of such marks entries are present for that subject 
                                                        if ($last_marks != $data2sort[$current_user]) {
                                                            $last_marks = $data2sort[$current_user];
                                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><input name="select" value="1" type="checkbox"/></td>
                                                <td style="text-align: center;"> <?php echo $current_rank; ?></td>
                                                <td><?php echo $userName[$i][0]->UID_FirstName .' '.$userName[$i][0]->UID_LastName; ?> </td>
                                                <td><?php echo $marks['tenth'][$i]; ?></td>
                                                <td><?php echo $marks['twelth'][$i]; ?></td>
                                                <td><?php echo $subjectName[0]->sub_name; ?></td>
                                                <td><button type="button" class="btn btn-default">View Profile</button></td>
                                            </tr>
                                           <?php
                    $current_rank++;
                } else {
                    ?>
                                            <tr>
                                                <td style="text-align: center;"><input name="select" value="1" type="checkbox"/></td>
                                                <td style="text-align: center;"> <?php echo $current_rank; ?></td>
                                                <td><?php echo $userName[$i][0]->UID_FirstName .' '.$userName[$i][0]->UID_LastName; ?> </td>
                                                <td><?php echo $marks['tenth'][$i]; ?></td>
                                                <td><?php echo $marks['twelth'][$i]; ?></td>
                                                <td><?php echo $subjectName[0]->sub_name; ?></td>
                                                <td><button type="button" class="btn btn-default">View Profile</button></td>
                                            </tr>
                                              <?php
                }
            }
        }
    } else {
        ?>
        <tr><td colspan="7">Ranks not calculated yet.</td></tr>
        <?php
    }
    ?>
                                        </tbody>
                                        <tfoot class="dtFilter">
                                            <tr class="active">
                                                <th style="min-width:30px; width: 30px; text-align: center;">
                                                    <!--<input name="select_all" value="1" type="checkbox" class="select_all"/>-->
                                                </th>
                                                <th class="col-xs-1"></th>
                                                <th class="col-xs-1"></th>
                                                <th class="col-xs-1"></th>
                                                <th class="col-xs-2"></th>
                                                <th class="col-xs-2"></th>
                                               
                                                <th style="width:80px; text-align:center;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>  
                            </div>  
                        </form>
                    </div>  
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<script>
    
    function validateAlpha() {
        var textInput = document.getElementById("cname").value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
        document.getElementById("cname").value = textInput;
    }
</script>