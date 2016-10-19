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
                        <form id="rank_form" action="javascript:sub();" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Subject Name</label>
                                                <select name='subid' data-placeholder='Subject Name' class="form-control">
                                                    <option value="">Select Subject</option>
                                                    <?php
                                                    foreach ($subject as $r) {
                                                        echo "<option value='" . $r->sub_id . "'>" . $r->sub_name . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            <span class="help-block"><?php echo form_error('sub_id'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Select Domain</label>
                                                 <select name="domain" class="form-control" data-placeholder='Select Domain'>
                                                    <option value="">Select Domain</option>
                                                    <option value="global">OVERALL</option>
                                                    <option value="friends">FRIENDS</option>
                                                </select>
                                            <span class="help-block"><?php echo form_error('domain'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Select Rank Type</label>
                                                 <select name="type" class="form-control" data-placeholder='Select Type'>
                                                    <option value="">Select Type</option>
                                                    <option value="cumulative">Cumulative</option>
                                                    <option value="weekly">Weekly</option>
                                                </select>
                                            <span class="help-block"><?php echo form_error('domain'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                   
                                    <center> <button type="submit" class="btn btn-default">Submit</button></center>
                                    
                                </div>
                                
                                <!--table-->
                                <div id="rankData" class="" style="display:none">
                                    <hr>
                                    <?php $this->load->view('admin/Rank/rank_details') ?>
                                </div>
                                <!--end table-->
                            </div>
                            <div class="modal-footer">
                               <!-- <button type="submit" class="btn btn-default">Submit</button>
                                <a href="<?php //print base_url(); ?>admin/KeyConcepts"><button type="button" class="btn default">Cancel</button></a>-->
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
    function sub(){
        var subid = $('select[name=subid').val();
        var domain = $('select[name=domain').val();
        var type = $('select[name=type').val();
        if(subid != '' && domain != '' && type != ''){
            $.ajax({
                type : 'POST',
                url : '<?= site_url() ?>admin/Rank/show-Rank',
                data : {subid:subid,
                domain:domain,
                type:type},
                success: function(response){
                    //alert(response);
                     $("#rankData").css("display","block");
                     $('#getData1 tbody').empty();
                     $('#getData1 tbody').append(response);
                }
            });

        }else{
            alert("Fill All Information");
        }


    }
</script>