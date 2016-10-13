
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <?php
        
        $groups = $groups[0];
        
        ?>
        <!--//banner-->
        <!--content-->
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive">
                        <form action="<?= site_url() ?>admin/Groups-update/<?= $id ?>" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <?php if($id ==1){?>   <!--name for group admin should not edit for auth is_login function is using name of admin group-->
                                            <input type="text" name="name" id="name" class="form-control" value="<?=  setValue(set_value('name'), $groups->name); ?>"oninput="validateAlpha();"  placeholder="Name" readonly/>
                                            <?php }else { ?>
                                            <input type="text" name="name" id="name" class="form-control" value="<?=  setValue(set_value('name'), $groups->name); ?>"oninput="validateAlpha();"  placeholder="Name"/>
                                            
                                            <?php } ?>
                                            <span class="help-block"><?php echo form_error('name'); ?></span>
                                        </div>
                                    </div>
                                   
                                </div>
                                 
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea id="description" name="description" class="form-control" placeholder="Description" value="<?php echo $groups->description; ?>"><?php echo $groups->description; ?></textarea>
                                            <span class="help-block"><?php echo form_error('description'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                               
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Submit</button>
                                <a href="<?php print base_url(); ?>admin/Groups"><button type="button" class="btn default">Cancel</button></a>
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
        //var textInput = document.getElementById("cname").value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
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