

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
                        <form action="<?= site_url() ?>admin/User-save" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" id="cname" class="form-control" value="<?php echo set_value('first_name'); ?>"oninput="validateAlpha(this);"  placeholder="First Name"/>
                                            <span class="help-block"><?php echo form_error('first_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" oninput="validateAlpha(this);"  placeholder="Last Name" />
                                            <span class="help-block"><?php echo form_error('last_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email" />
                                            <span class="help-block"><?php echo form_error('email'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Company</label>
                                            <input type="text" name="company" id="company" class="form-control" value="<?php echo set_value('company'); ?>" placeholder="Company" />
                                            <span class="help-block"><?php echo form_error('company'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" class="form-control" value="<?php echo set_value('password'); ?>" placeholder="Password" />
                                            <span class="help-block"><?php echo form_error('password'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Re type Password</label>
                                            <input type="password" name="repassword" id="repassword" class="form-control" value="<?php echo set_value('repassword'); ?>" placeholder="Re Type Password" />
                                            <span class="help-block"><?php echo form_error('repassword'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone'); ?>" placeholder="Phone" oninput="validateNumber(this);"/>
                                            <span class="help-block"><?php echo form_error('phone'); ?></span>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Group</label><?php
                                            $gr = array();
                                            if ($groups) {
                                                foreach ($groups as $g) {
                                                    $gr[$g->id] = $g->name;
                                                }
                                            }
                                            echo form_dropdown('group_id', $gr, set_value('group_id'), 'id="group_id" class="form-control" placeholder="Select Group" ng-model="group_id"');
                                            ?>
                                            <span class="help-block"><?php echo form_error('group_id'); ?></span>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row recruiter" style="display:none">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Website</label>
                                            <input type="text" name="website" id="website" class="form-control" value="<?php echo set_value('website'); ?>" placeholder="Website" />
                                            <span class="help-block"><?php echo form_error('website'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <?php echo form_dropdown('location', array(''=>"Select",'pune' => "pune", 'mumbai' => "Mumbai"), set_value('location'), 'class="form-control" id="location" placeholder="Location"'); ?>
                                            <span class="help-block"><?php echo form_error('location'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row recruiter" style="display:none">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>No of Employee</label>
                                            <?php echo form_dropdown('no_of_employee', array(''=>"Select",'upto_10' => "Up to 10", '11-100' => "11 - 100",'101-1000'=>"101 - 1000",'1000+'=>"1000+"), set_value('no_of_employee'), 'class="form-control" placeholder="no_of_employee"'); ?>
                                            <span class="help-block"><?php echo form_error('no_of_employee'); ?></span>
                                        </div>
                                    </div>
                                     <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Company Description</label>
                                            <textarea id="company_desc" name="company_desc" class="form-control" placeholder="Company Description"></textarea>
                                            <span class="help-block"><?php echo form_error('company_desc'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row recruiter" style="display:none">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>FB Link</label>
                                            <input type="text" name="fb_link" id="fb_link" class="form-control" value="<?php echo set_value('fb_link'); ?>" placeholder="FB Link" />
                                            <span class="help-block"><?php echo form_error('fb_link'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Linkedin Link</label>
                                            <input type="text" name="linkedin_link" id="linkedin_link" class="form-control" value="<?php echo set_value('linkedin_link'); ?>" placeholder="Linkedin Link" />
                                            <span class="help-block"><?php echo form_error('linkedin_link'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row recruiter" style="display:none">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>FB Link Of Company</label>
                                            <input type="text" name="com_fb_link" id="com_fb_link" class="form-control" value="<?php echo set_value('com_fb_link'); ?>" placeholder="FB Link" />
                                            <span class="help-block"><?php echo form_error('com_fb_link'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Linkedin Link Of Company</label>
                                            <input type="text" name="com_linkedin_link" id="com_linkedin_link" class="form-control" value="<?php echo set_value('com_linkedin_link'); ?>" placeholder="Linkedin Link" />
                                            <span class="help-block"><?php echo form_error('com_linkedin_link'); ?></span>
                                        </div>
                                    </div>
                                   
                                    
                                    
                                </div>   
                                  
                                <div class="row">   
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Is Active</label>
                                            <?php echo form_dropdown('active', array('1' => "Yes", '0' => "No"), set_value('active'), 'class="form-control" placeholder="Is Active"'); ?>
                                            <span class="help-block"><?php echo form_error('active'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Submit</button>
                                <a href="<?php print base_url(); ?>admin/Users"><button type="button" class="btn default">Cancel</button></a>
                            </div>
                        </form>

                    </div>  
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<script src="<?= USERASSETS ?>js/jquery.min.js" type="text/javascript"></script>
<script>
    function validateAlpha(e) {
        //updated by neeta
        var textInput = e.value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
        e.value = textInput;
        //end
    }
   
    function validateNumber(e) {
        //updated by neeta
        var textInput = e.value;
        textInput = textInput.replace(/[^0-9]/g, "");
        e.value = textInput;
        //end
    }
    $(document).ready(function () {
        //if compalsory fields of recuiter is blank
    
       if($("#group_id").val() == '2')
       {
          $(".recruiter").css("display","block");
             $('#group_id option[value="2"]').attr("selected", "selected")
       }
       
        $( "#group_id" ).change(function() {
            if($("#group_id option:selected").val()=='2')  //if recruiter
            {
                $(".recruiter").css("display","block");
            }else{
                $(".recruiter").css("display","none");
                $("#website").val('');
                $("#location").selectedIndex = -1;
                $("#no_of_employee").selectedIndex = -1;
            }
        });
    });
   
</script>