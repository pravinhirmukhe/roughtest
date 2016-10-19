
<div id="page-wrapper" class="gray-bg dashbard-1" ng-controller="subject">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <!--//banner-->
        <!--content-->
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive">
                        <form action="<?= site_url() ?>admin/Qtype-save" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input type="text" name="type" id="type" class="form-control" value="<?php echo set_value('type'); ?>"  placeholder="Type"/>
                                        <span class="help-block"><?php echo form_error('type'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Submit</button>
                                <a href="<?php print base_url(); ?>admin/Qtype"><button type="button" class="btn default">Cancel</button></a>
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
   
    function validateAlpha(e) {
        var textInput = e.value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
        e.value = textInput;
    }
</script>