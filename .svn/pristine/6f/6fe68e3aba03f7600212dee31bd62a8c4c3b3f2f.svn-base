<?php
//these are shortlisted users
$id = $this->uri->segment(4);
?>
<script>

</script>
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
                            <input type="hidden" name="key" value="id"/>
                            <input type="hidden" name="tab" value="rs_job"/>
                            <div class="panel panel-default">
                                <div class="panel-heading" style="border-radius: 0px;padding: 0px">
                                    <h3 class="panel-title pull-left" style="padding: 8px">System Users <small></small></h3>
                                    <span class="pull-right btn-group">
                                        <a><button type="button"  title="pay" onclick="payment()" id="pay" class="btn btn-success">PAY</button></a>

                                    </span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <table id="getData" class="dataTable table table-bordered table-hover table-striped">
                                        <thead>

                                            <tr>
                                                <th style="min-width:30px; width: 30px; text-align: center;">
                                                    <input name="select_all" value="1" type="checkbox" class="select_all"/>
                                                </th>
                                                <?php foreach ($permission as $value) { ?>
                                                    <th class="col-xs-2" style="width:80px;min-width:80px;"><?php echo $value; ?></th>
                                                <?php } ?>
                                                <th style="width:80px; text-align:center;">Actions</th>
                                            </tr>

                                        </thead>
                                        <tbody>


                                            <?php for ($i = 0; $i < count($userDetails); $i++) { ?>
                                                <tr>
                                                    <td style="width:80px; text-align:center;"> <input name="select[]"  value="<?php $userDetails[$i]->UID; ?>" type="checkbox" class="select shortlist"/></td>
                                                    <td><?php echo $userDetails[$i]->UID_FirstName; ?></td>
                                                    <td><?php echo $userDetails[$i]->UID_Gender; ?></td>
                                                    <td><?php echo $userDetails[$i]->UID_Contact; ?></td>
                                                    <td><?php echo $userDetails[$i]->UID_Hometown; ?></td>
                                                    <td><?php echo $userDetails[$i]->UID_Email; ?></td>
                                                    <td></td>
                                                </tr>
                                            <?php } ?> 


                                        </tbody>
                                        <tfoot class="dtFilter">

                                            <tr class="active">
                                                <th style="min-width:30px; width: 30px; text-align: center;">

                                                </th>
                                                <?php foreach ($permission as $value) { ?>
                                                    <th class="col-xs-1"></th>
                                                <?php } ?>
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
    var ids = [];
    $(document).ready(function () {

        //get_all_rank();

        //select all checkbox
        $('input[name="select_all"]').click(function () {
            $(".select").prop('checked', $(this).prop('checked'));
        });


    });
    $("#pay").click(function () {
        ids.length = 0;
        $("input:checkbox[name=select]:checked").each(function () {
            ids.push($(this).val());
        });
        if (ids.length == 0) {
            alert("Select Atleast One User");
        } else {
            //alert(ids);
            //location.href ='<?= site_url() ?>admin/Rank/shortlist/'+ids;
        }
    });
    function validateAlpha() {
        var textInput = document.getElementById("cname").value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
        document.getElementById("cname").value = textInput;
    }
</script>