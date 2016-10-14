<style type="text/css">
    p{
        font-weight: normal;
        font-style: normal;
        font-size: 15px;
        color: #999999; 
    }
</style>
<?php $recruiterData = $recruiterData[0];?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb');?>
        <!--//banner-->
        <!--content-->
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive">
                        <!--<modal>-->
                        <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <p id="question">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $recruiterData->first_name; ?>&nbsp;<?php echo $recruiterData->last_name; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <p id="answer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $recruiterData->company; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <p id="answer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $recruiterData->email; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recruiterData->phone; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Group</label>
                                            <?php if($recruiterData->group_id == '1'){ ?>
                                                <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo "Admin" ?></p>
                                            <?php }else{ ?>
                                                 <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo "Recruiter" ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label>Website</label>
                                            <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recruiterData->website; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recruiterData->location; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No Of Employee</label>
                                            <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recruiterData->no_of_employee; ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>FB Link</label>
                                            <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recruiterData->fb_link; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Linkedin Link</label>
                                            <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recruiterData->linkedin_link; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>FB Link Of Company</label>
                                            <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recruiterData->com_fb_link; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Linkedin Link Of Company</label>
                                            <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recruiterData->com_linkedin_link; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Description</label>
                                            <p id="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recruiterData->company_desc; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="submit" class="btn btn-default">Submit</button>-->
                            <center> <a href="<?php print base_url(); ?>admin/Company"><button type="button" class="btn btn-primary">Back</button></a></center>
                        </div>
                        
                        <!--</modal>-->

                    </div>  
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>