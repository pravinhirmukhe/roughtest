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
                                            <label>Subject Name<span style="color:red">*</span></label>
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
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Select Domain<span style="color:red">*</span></label>
                                                 <select name="domain" class="form-control" data-placeholder='Select Domain'>
                                                    <option value="">Select Domain</option>
                                                    <option value="global">OVERALL</option>
                                                    <option value="friends">FRIENDS</option>
                                                </select>
                                            <span class="help-block"><?php echo form_error('domain'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Select Rank Type<span style="color:red">*</span></label>
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
                                    
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Xth Percentage</label>
                                            <?php echo form_dropdown('Xth', array(''=>"Select",'40-50' => "40-50", '50-60' => "50-60",'60-70' => "60-70",'70-80' => "70-80",'80-90' => "80-90",'90-100' => "90-100"), set_value('Xth'), 'class="form-control" id="Xth" placeholder="Xth"'); ?>
                                            <span class="help-block"><?php echo form_error('Xth'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>XIIth Percentage</label>
                                            <?php echo form_dropdown('XIIth', array(''=>"Select",'40-50' => "40-50", '50-60' => "50-60",'60-70' => "60-70",'70-80' => "70-80",'80-90' => "80-90",'90-100' => "90-100"), set_value('XIIth'), 'class="form-control" id="XIIth" placeholder="XIIth"'); ?>
                                            <span class="help-block"><?php echo form_error('XIIth'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Diploma Percentage</label>
                                            <?php echo form_dropdown('diploma', array(''=>"Select",'40-50' => "40-50", '50-60' => "50-60",'60-70' => "60-70",'70-80' => "70-80",'80-90' => "80-90",'90-100' => "90-100"), set_value('diploma'), 'class="form-control" id="diploma" placeholder="diploma"'); ?>
                                            <span class="help-block"><?php echo form_error('diploma'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Degree Percentage</label>
                                            <?php echo form_dropdown('degree', array(''=>"Select",'40-50' => "40-50", '50-60' => "50-60",'60-70' => "60-70",'70-80' => "70-80",'80-90' => "80-90",'90-100' => "90-100"), set_value('degree'), 'class="form-control" id="degree" placeholder="degree"'); ?>
                                            <span class="help-block"><?php echo form_error('degree'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <?php echo form_dropdown('location', array(''=>"Select",'Pune' => "Pune", 'mumbai' => "Mumbai"), set_value('location'), 'class="form-control" id="location" placeholder="Location"'); ?>
                                            <span class="help-block"><?php echo form_error('location'); ?></span>
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
    function validateAlpha() {
        var textInput = document.getElementById("cname").value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
        document.getElementById("cname").value = textInput;
    }
    $(document).ready(function(){
         
        //get_all_rank();
        
        //select all checkbox
        $('input[name="select_all"]').click(function () {
            $(".select").prop('checked', $(this).prop('checked'));
        });
        
           
    });
    //get ids from selected checkbox
    $("#shortlist").click(function(){
        ids.length=0;
        $("input:checkbox[name=select]:checked").each(function(){
           ids.push($(this).val());
        });
        if(ids.length==0){
            alert("Select Atleast One User");
        }else{
            //alert(ids);
            location.href ='<?= site_url() ?>admin/Rank/shortlist/'+ids;
        }
        });
            
    

    
    function sub(){
        var subid = $('select[name=subid').val();
        var domain = $('select[name=domain').val();
        var type = $('select[name=type').val();
        var location = $('select[name=location').val();
        var Xth = $('select[name=Xth').val();
        var XIIth = $('select[name=XIIth').val();
        var diploma = $('select[name=diploma').val();
        var degree = $('select[name=degree').val();
        
        if(subid != '' && domain != '' && type != ''){
            $.ajax({
                type : 'POST',
                url : '<?= site_url() ?>admin/Rank/show-Rank',
                data : {subid:subid,
                        domain:domain,
                        type:type,
                        location:location,
                        Xth:Xth,
                        XIIth:XIIth,
                        diploma:diploma,
                        degree:degree},
                success: function(response){
                    //alert(response);
                     $("#rankData").css("display","block");
                     $('#getData1 tbody').empty();
                     $('#getData1 tbody').append(response);
                }
            });

        }else{
            alert("Fill Required Information");
        }


    }
</script>