
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
                        <form action="<?= site_url() ?>admin/Exercise-save" method="POST">
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
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Question Type</label><?php
                                            $qt = array();
                                            if ($qtype) {
                                                foreach ($qtype as $t) {
                                                    $qt[$t->id] = $t->type;
                                                }
                                            }
                                            echo form_dropdown('q_type', $qt, set_value('id'), 'id="q_type" class="form-control" placeholder="Select Question Type"');
                                            ?>
                                            <span class="help-block"><?php echo form_error('q_type'); ?></span>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Introduction</label>
                                            <textarea id="Introduction" name="Introduction" class="mceEditor" cols="70" rows="10"></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Introduction'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Question</label>
                                            <textarea id="Question" name="Question" class="mceEditor" cols="70" rows="10"></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Question'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Option 1</label>
                                            <textarea id="Op1" name="Op1" class="mceEditor" cols="70" rows="10"></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Op1'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Option 2</label>
                                            <textarea id="Op2" name="Op2" class="mceEditor" cols="70" rows="10"></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Op2'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Option 3</label>
                                            <textarea id="Op3" name="Op3" class="mceEditor" cols="70" rows="10"></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Op3'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Option 4</label>
                                            <textarea id="Op4" name="Op4" class="mceEditor" cols="70" rows="10"></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Op4'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Answer</label>
                                            <?php echo form_dropdown('Answer', array('1' => "Option 1", '2' => "Option 2",'3'=>"Option 3",'4'=>"Option 4"), set_value('Answer'), 'class="form-control" id="Answer" placeholder="Answer"'); ?>
                                            <span class="help-block"><?php echo form_error('Answer'); ?></span>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Solution</label>
                                        <textarea id="Solution" name="Solution" class="mceEditor" cols="70" rows="10"></textarea>

                                        <span class="help-block"><?php echo form_error('Solution'); ?></span>
                                    </div>
                                </div>
                            </div>
                                
                             <div class="row">
                                <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Difficulty Level</label>
                                            <?php echo form_dropdown('Difficulty_level', array('Easy' => "Easy", 'Medium' => "Medium",'Hard'=>"Hard"), set_value('Difficulty_level'), 'class="form-control" id="Difficulty_level" placeholder="Difficulty_level"'); ?>
                                            <span class="help-block"><?php echo form_error('Difficulty_level'); ?></span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Submit</button>
                                <a href="<?php print base_url(); ?>admin/Exercise"><button type="button" class="btn default">Cancel</button></a>
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