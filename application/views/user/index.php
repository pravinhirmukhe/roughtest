<div class="shadow">
</div>
<ol id="tour" style="display:none;">
    <li data-target="img">Welcome to Roughsheet! Click to continue.</li>
    <li data-target=".sm_color5">Planner is the section, where you’ll plan out the way you want to study, while we’ll devise a revision 
        plan simultaneously for you</li>
    <li data-target=".sm_color1">Study Material is the section where all the study material, for the course that you’ve selected, is.</li>
    <li data-target=".sm_color2">Practice Problem Sheets is the section where you’ll get the Daily Practice Problem Sheets, on each of the 
        four subjects, on a daily basis, and you’ll also get a Topic Practice Problem Sheet, of a specific topic of a 
        specific subject, for regular revision.</li>
    <li data-target=".sm_color3">Focus Areas is the section where we indicate your weaknesses (if any), once we’ve collected substantial 
        data about your performance.</li>
    <li data-target=".sm_color4" data-angle="250">My Performance is the section where you’ll get detailed information about the way you have been 
        performing in the four subjects.</li>
    <!--<li data-target=".to_do_list" data-angle="310" data-options="distance:50">Todasy to do list</li>-->
</ol>
<div class="container-fluid" style="background:#ebebeb;bottom:0;">
    <div class="col-md-2" style="background:#fff;" id='sidemenu'>
        <?php $this->load->view('user/layout/sidemenu'); ?>
    </div>
    <div id="feeds_center" class="col-md-10" style="background:transparent;margin-top:10px;" ng-view>
    </div>
    <div id="exam_center" class="col-md-8" style="background:transparent;margin-top:10px;"></div>
</div>
