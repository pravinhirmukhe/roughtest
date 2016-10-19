<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <?php
        $jobData = $jobData[0];
        $branch = $jobData->graduation_branch;
        $branchArr =array();
        $branchArr = explode(", ",$branch);
        $allBranchArr = array('cs' => 'Computer Science', 'IT' => 'IT', 'entc' => 'ENTC', 'mech' => 'Mechanical', 'civil' => 'Civil', 'MBA' => 'MBA');
        ?>
        <!--//banner-->
        <!--content-->
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive">
                        <form action="<?= site_url() ?>admin/Job/Job-update/<?= $id ?>" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" id="title" class="form-control" value="<?=  setValue(set_value('title'), $jobData->title); ?>"oninput="validateAlpha(this);"  placeholder="Name"/>
                                            <span class="help-block"><?php echo form_error('title'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <?php echo form_dropdown('location', array(''=>"Select",'pune' => "pune", 'mumbai' => "Mumbai"), set_value(set_value('location'), $jobData->location), 'class="form-control" id="location" placeholder="Location"'); ?>
                                            <span class="help-block"><?php echo form_error('location'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Work Description</label>
                                            <textarea id="work_description" name="work_description" class="form-control" placeholder="Work Description" value="<?php echo $jobData->work_description; ?>"><?php echo $jobData->work_description; ?></textarea>
                                            <span class="help-block"><?php echo form_error('work_description'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <label>Minimum requirements of the Student</label> <hr style="margin-top: 0px;">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Graduation Year</label>
                                            <?php echo form_dropdown('graduation_year', array(''=>"Select",'2010' => "2010", '2011' => "2011",'2012' => "2012"), set_value(set_value('graduation_year'), $jobData->graduation_year), 'class="form-control" id="graduation_year" placeholder="Graduation Year"'); ?>
                                            <span class="help-block"><?php echo form_error('graduation_year'); ?></span>
                                        </div>
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label>Graduation Branch</label>
                                            <input style="margin-left: 40%;" type="checkbox" id="checkbox" >Select All
                                            <select id="branch" name="branch[]" multiple="multiple" class="form-control">
                                                
                                                <option value="cs" <?php if(in_array("cs", $branchArr)) echo "selected";else echo '';?>>Computer Science</option>
                                                <option value="IT" <?php if(in_array("IT", $branchArr)) echo "selected";else echo '';?>>IT</option>
                                                <option value="entc" <?php if(in_array("entc", $branchArr)) echo "selected";else echo'';?>>ENTC</option>
                                                <option value="mech" <?php if(in_array("mech", $branchArr)) echo "selected";else echo '';?>>Mechanical</option>
                                                <option value="civil" <?php if(in_array("civil", $branchArr)) echo "selected";else echo '';?>>Civil</option>
                                                <option value="MBA" <?php if(in_array("MBA", $branchArr)){ echo "selected";}else{ echo '';}?>>MBA</option>
                                                
                                            </select>
                                             <span class="help-block"><?php echo form_error('branch'); ?></span>
                                          
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>College CGPA</label>
                                                <input type="text" name="college_CGPA" id="college_CGPA" class="form-control" value="<?php echo set_value(set_value('college_CGPA'), $jobData->college_CGPA); ?>"  placeholder="College CGPA"/>
                                                <span class="help-block"><?php echo form_error('college_CGPA'); ?></span>
                                            </div>
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <label>Cost to Company</label>
                                            <input type="text" name="cost_to_company" id="cost_to_company" class="form-control" value="<?php echo set_value(set_value('cost_to_company'), $jobData->cost_to_company); ?>"  placeholder="Cost to Company"/>
                                            <span class="help-block"><?php echo form_error('cost_to_company'); ?></span>
                                           
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>10 th Percentage</label>
                                                <input type="text" name="tenth_percentage" id="tenth_percentage" class="form-control" value="<?php echo set_value(set_value('tenth_percentage'),$jobData->tenth_percentage); ?>"  placeholder="10th Percentage"/>
                                                <span class="help-block"><?php echo form_error('tenth_percentage'); ?></span>
                                            </div>
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <label>12th Percentage</label>
                                            <input type="text" name="twelth_percentage" id="twelth_percentage" class="form-control" value="<?php echo set_value(set_value('twelth_percentage'),$jobData->twelth_percentage); ?>"  placeholder="12th Percentage"/>
                                                <span class="help-block"><?php echo form_error('twelth_percentage'); ?></span>
                                           
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="checkbox-inline">
                                                <label><input type="checkbox" id="bond" name="bond" <?= $jobData->bond == "1" ? "checked" : "" ?>> Bond</label>
                                            </div>
                                        </div>
                                    </div>
                                
                                <div class="row" id="bond_details">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Bond Length</label>
                                            <?php echo form_dropdown('bond_lengh', array(''=>"Select",'1year' => "1year", '2year' => "2year",'6Month' => "6Month"), set_value(set_value('bond_lengh'),$jobData->bond_lengh), 'class="form-control" id="bond_lengh" placeholder="Bond Lengh"'); ?>
                                            <span class="help-block"><?php echo form_error('bond_lengh'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Bond Value</label>
                                        <input type="text" name="bond_value" id="bond_value" class="form-control" value="<?php echo set_value(set_value('bond_value'),$jobData->bond_value); ?>"  placeholder="Bond Value"/>
                                        <span class="help-block"><?php echo form_error('bond_value'); ?></span>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Expected Date Of Joining</label>
                                            <input type="date" name="expected_doj" value="<?php echo set_value(set_value('expected_doj'),$jobData->expected_doj); ?>" class="form-control1 ng-invalid ng-invalid-required">
                                            <span class="help-block"><?php echo form_error('expected_doj'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Recruitment Round Details</label>
                                            <textarea id="no_recruitment_round" name="no_recruitment_round" class="form-control" placeholder="Recruitment Details" value="<?php echo $jobData->no_recruitment_round; ?>"><?php echo $jobData->no_recruitment_round; ?></textarea>
                                            <span class="help-block"><?php echo form_error('no_recruitment_round'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo form_dropdown('active', array('1' => "Yes", '0' => "No"), setValue(set_value('active'), $jobData->active), 'class="form-control" placeholder="Is Active"'); ?>
                                            <span class="help-block"><?php echo form_error('active'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Submit</button>
                                <a href="<?php print base_url(); ?>admin/Job/job"><button type="button" class="btn default">Cancel</button></a>
                            </div>
                        </form>

                    </div>  
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#branch").select2();
        $("#checkbox").click(function(){
            if($("#checkbox").is(':checked') ){
                $.fn.select2.defaults.reset();
                $("#branch > option").prop("selected","selected");
                $("#branch").trigger("change");
            }else{
                $("#branch > option").removeAttr("selected");
                 $("#branch").trigger("change");
             }
        });
    $(document).ready(function(){
        var bondval = $("#bond").val();
        if(bondval == 1){
            $("#bond_details").css("display","block");
        }else{
            $("#bond_details").css("display","none");
        }
        $("#bond").change(function() {
            if(this.checked) {
               $("#bond_details").css("display","block");
            }else{
                $("#bond_details").css("display","none");
                $("#bond_value").val('');
                //$('#bond_lengh')[0].selectedIndex = 0;
                $("#MySelectBox").val("");
                //$('#bond_lengh').text="Select";
            }
        });
    })
    
    function validateAlpha() {
        var textInput = e.value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
        e.value = textInput;
    }
</script>
