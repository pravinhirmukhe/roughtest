<script>
   
</script>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <?php
        
        $qtype = $qtype[0];
        
        
        ?>
        <!--//banner-->
        <!--content-->
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive">
                        <form action="<?= site_url() ?>admin/Qtype-update/<?= $id ?>" method="POST">
                            <div class="modal-body">
                               
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" name="type" id="type" class="form-control" value="<?php echo set_value(set_value('type'),$qtype->type); ?>"  placeholder="Type"/>
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
     $(document).ready(function(){
       // alert(tinyMCE.get('kc_text').getContent());
      
    });
    function validateAlpha() {
        var textInput = document.getElementById("cname").value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
        document.getElementById("cname").value = textInput;
    }
</script>