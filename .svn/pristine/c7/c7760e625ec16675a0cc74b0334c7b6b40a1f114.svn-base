
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <?php
        
        $exercise = $exercise[0];
        
        ?>

        <!--//banner-->
        <!--content-->
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive">
                        <form action="#" method="POST">
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
                                            echo form_dropdown('topic_id', $gr, set_value(set_value('topic_id'), $exercise->topic_id), 'id="topic_id" class="form-control" placeholder="Select Topic" disabled');
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
                                            echo form_dropdown('q_type', $qt, set_value(set_value('id'), $exercise->q_type), 'id="q_type" class="form-control" placeholder="Select Question Type" disabled');
                                            ?>
                                            <span class="help-block"><?php echo form_error('q_type'); ?></span>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Introduction</label>
                                            <textarea id="Introduction" name="Introduction" class="mceEditor" cols="70" rows="10" value="<?php echo $exercise->Introduction;?>"><?php echo $exercise->Introduction;?></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Introduction'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Question</label>
                                            <textarea id="Question" name="Question" class="mceEditor" cols="70" rows="10" value="<?php echo $exercise->Question;?>"><?php echo $exercise->Question;?></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Question'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Option 1</label>
                                            <textarea id="Op1" name="Op1" class="mceEditor" cols="70" rows="10" value="<?php echo $exercise->Op1;?>"><?php echo $exercise->Op1;?></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Op1'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Option 2</label>
                                            <textarea id="Op2" name="Op2" class="mceEditor" cols="70" rows="10" value="<?php echo $exercise->Op2;?>"><?php echo $exercise->Op2;?></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Op2'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Option 3</label>
                                            <textarea id="Op3" name="Op3" class="mceEditor" cols="70" rows="10" value="<?php echo $exercise->Op3;?>"><?php echo $exercise->Op3;?></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Op3'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Option 4</label>
                                            <textarea id="Op4" name="Op4" class="mceEditor" cols="70" rows="10" value="<?php echo $exercise->Op4;?>"><?php echo $exercise->Op4;?></textarea>
                                        
                                            <span class="help-block"><?php echo form_error('Op4'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Answer</label>
                                            <?php echo form_dropdown('Answer', array('1' => "Option 1", '2' => "Option 2",'3'=>"Option 3",'4'=>"Option 4"), setValue(set_value('Answer'), $exercise->Answer), 'class="form-control" id="Answer" placeholder="Answer" disabled'); ?>
                                            <span class="help-block"><?php echo form_error('Answer'); ?></span>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Solution</label>
                                        <textarea id="Solution" name="Solution" class="mceEditor" cols="70" rows="10" value="<?php echo $exercise->Solution;?>"><?php echo $exercise->Solution;?></textarea>

                                        <span class="help-block"><?php echo form_error('Solution'); ?></span>
                                    </div>
                                </div>
                            </div>
                                
                             <div class="row">
                                <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Difficulty Level</label>
                                            <?php echo form_dropdown('Difficulty_level', array('Easy' => "Easy", 'Medium' => "Medium",'Hard'=>"Hard"), set_value(set_value(set_value('Difficulty_level'), $exercise->Difficulty_level), $exercise->Difficulty_level), 'class="form-control" id="Difficulty_level" placeholder="Difficulty_level" disabled'); ?>
                                            <span class="help-block"><?php echo form_error('Difficulty_level'); ?></span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <a href="<?php print base_url(); ?>admin/Exercise"><button type="button" class="btn default">Back</button></a>
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