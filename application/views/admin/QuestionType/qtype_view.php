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
                        
                            <div class="modal-body">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <p id="type">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $qtype->type; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="<?php print base_url(); ?>admin/Qtype"><button type="button" class="btn default">Back</button></a>
                            </div>
                       
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
</script>