
<style type="text/css">
    p{
        font-weight: normal;
        font-style: normal;
        font-size: 15px;
        color: #999999; 
    }
</style>
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
                            <div class="form-group">
                                <label>Name</label>
                                <p id="question">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data_update->name; ?></p>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <p id="answer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data_update->description; ?></p>
                            </div>
                            
                        </div>
                    </div>
                        <div class="modal-footer">
                            <!--<button type="submit" class="btn btn-default">Submit</button>-->
                            <center> <a href="<?php print base_url(); ?>admin/Groups"><button type="button" class="btn btn-primary">Back</button></a></center>
                        </div>
                        
                        <!--</modal>-->

                    </div>  
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>