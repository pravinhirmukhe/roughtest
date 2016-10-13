
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
                        <form action="<?= site_url() ?>admin/KC-save" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Topic Name</label><?php
                                            $gr = array();
                                            if ($topics) {
                                                foreach ($topics as $g) {
                                                    $gr[$g->topic_id] = $g->topic_name;
                                                }
                                            }
                                            echo form_dropdown('topic_id', $gr, set_value('topic_id'), 'id="topic_id" class="form-control" placeholder="Select Topic"');
                                            ?>
                                            <span class="help-block"><?php echo form_error('topic_id'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea id="kc_text" name="kc_text" class="mceEditor" cols="85" rows="10"></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('kc_text'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Submit</button>
                                <a href="<?php print base_url(); ?>admin/KeyConcepts"><button type="button" class="btn default">Cancel</button></a>
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
</script>