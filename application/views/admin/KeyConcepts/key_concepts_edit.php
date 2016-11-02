<script>
   
</script>
<div id="page-wrapper" class="gray-bg dashbard-1" ng-controller="subject">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <?php
        
        $kc = $kc[0];
        $sub=$sub[0];
        
        ?>
        <!--//banner-->
        <!--content-->
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive">
                        <form action="<?= site_url() ?>admin/KC-update/<?= $id ?>" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Subject Name</label>
                                            
                                                <select name='sub_id' ng-model="user.sub_id" data-placeholder='Subject Name'class="form-control"  value="<?= setValue(set_value('sub_id'), $sub->sub_id);?>" ng-change="getTopic(user.sub_id)">
                                                    <option value="">Select Subject</option>
                                                    <?php
                                                    
                                                    foreach ($subject as $r) {
                                                        if ($sub->sub_id == $r->sub_id)
                                                            echo "<option value='" . $r->sub_id . "' selected='selected'>" . $r->sub_name . "</option>";
                                                        else
                                                            echo "<option value='" . $r->sub_id . "'>" . $r->sub_name . "</option>";
                                                    }
                                            
                                                    ?>
                                                </select>
                                            <span class="help-block"><?php echo form_error('sub_id'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                   
                                    <div class="form-group col-md-6" ng-init="getTopicName('<?= $sub->sub_id; ?>')">
                                        <div class="form-group">
                                            <label>Topic Name</label>
                                                 <select name="topic_id" class="form-control" value="<?= setValue(set_value('topic_id'),$kc->topic_id);?>">
                                                    <option value="">Select Topic</option>
                                                    <option value="{{t.topic_id}}" ng-selected="<?= $kc->topic_id; ?> == t.topic_id" ng-repeat="t in topic">{{t.topic_name}}</option>
                                                </select>
                                            <span class="help-block"><?php echo form_error('topic_id'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!--<div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Topic Name</label><?php
                                            /*$gr = array();
                                            if ($topics) {
                                                foreach ($topics as $g) {
                                                    $gr[$g->topic_id] = $g->topic_name;
                                                }
                                            }
                                            echo form_dropdown('topic_id', $gr, set_value('topic_id', $kc->topic_id), 'id="topic_id" class="form-control" placeholder="Select Topic"');
                                            */?>
                                            <span class="help-block"><?php //echo form_error('topic_id'); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>-->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea id="kc_text" name="kc_text" class="mceEditor" cols="85" rows="10" value="<?php echo $kc->kc_text; ?>"><?php echo $kc->kc_text; ?></textarea>
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
     $(document).ready(function(){
       // alert(tinyMCE.get('kc_text').getContent());
      
    });
    function validateAlpha() {
        var textInput = document.getElementById("cname").value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
        document.getElementById("cname").value = textInput;
    }
</script>