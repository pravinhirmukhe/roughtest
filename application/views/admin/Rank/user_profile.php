<div id="page-wrapper" class="gray-bg dashbard-1" ng-controller="userprofile">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <?php
        //get id from url
        $id = $this->uri->segment(4);
        
        ?>
       
        <!--//banner-->
        <!--content-->
        <div class="content-top" ng-init="getData('<?= $id ?>')">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive" style="font-size: 14px;">
                        
                        <!--<modal>-->
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Name </label>
                                        <p ng-show="(permission != '0' && 'UID_FirstName' | in_array:permission)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.UID_FirstName}}</span> <span ng-show="(permission != '0' && 'UID_LastName' | in_array:permission
                                            ) || uid == fid">{{f.UID_LastName}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6" ng-show="(permission != '0' && 'UID_Gender' | in_array:permission)">
                                    <div class="form-group">
                                        <label ng-show="(permission != '0' && 'UID_Gender' | in_array:permission)">Gender </label>
                                            
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.UID_Gender}}</p>
                                    </div>
                                </div>
                           
                                <div class="form-group col-md-6" ng-show="(permission != '0' && 'UID_CurrentCity' | in_array:permission)">
                                    <div class="form-group">
                                        <label ng-show="(permission != '0' && 'UID_CurrentCity' | in_array:permission) || uid == fid">City</label>
                                        <p>{{f.UID_CurrentCity}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6" ng-show="(permission != '0' && 'UID_Hometown' | in_array:permission)">
                                    <div class="form-group">
                                        <label ng-show="(permission != '0' && 'UID_Hometown' | in_array:permission
                                            ) || uid == fid">Home Town</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.UID_Hometown}}</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-6" ng-show="(permission != '0' && 'UID_DOB' | in_array:permission)">
                                    <div class="form-group">
                                        <label ng-show="(permission != '0' && 'UID_DOB' | in_array:permission
                                            ) || uid == fid">Date of Birth</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.UID_DOB}}</p>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-6" ng-show="(permission != '0' && 'UID_Email' | in_array:permission)">
                                    <div class="form-group">
                                        <label ng-show="(permission != '0' && 'UID_Email' | in_array:permission
                                            ) || uid == fid">Email</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.UID_Email}}</p>
                                    </div>
                                </div>
                                
                            
                                <div class="form-group col-md-6" ng-show="(permission != '0' && 'UID_CurrentInstitutionOrCompany' | in_array:permission)">
                                    <div class="form-group">    
                                        <label ng-show="(permission != '0' && 'UID_CurrentInstitutionOrCompany' | in_array:permission
                                            ) || uid == fid">Institution Or Company</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.UID_CurrentInstitutionOrCompany}}</p>
                                    </div>
                                </div>
                               
                                <div class="form-group col-md-6" ng-show="(permission != '0' && 'UID_Contact' | in_array:permission)">
                                        <label ng-show="(permission != '0' && 'UID_Contact' | in_array:permission) || uid == fid">Contact</label>
                                        <p ng-show="(permission != '0' && 'UID_Contact' | in_array:permission
                                            ) || uid == fid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.UID_Contact}}</p>
                                </div>
                            </div>
                            
                            
                            <div ng-show="(permission != '0' && 'prof_arr' | in_array:permission)" >
                                
                                <div class ="row" ng-repeat="f in othdata.prof_info">
                                    <h3>Professional Info </h3><hr>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Company</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.cname}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.cloc}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.desig}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Functional area</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{f.func_area}}</p>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                            
                <!--acadamics-->
                        <div ng-show="(permission != '0' && 'academics' | in_array:permission)">   
                            <h3>Academics</h3><hr>
                    <!--degree-->        
                            <div class="row" ng-if='((othdata.academics[0] || othdata.academics[1] || othdata.academics[2] || othdata.academics[3] || othdata.academics[4]))'>
                                <h4>Degree</h4><br>
                                
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>College</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[0]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[1]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[2]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Grade/Percentage</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[4]}}</p>

                                    </div>
                                </div>
                            </div>
                <!--diploma-->
                            <div class="row" ng-if='((othdata.academics[5] || othdata.academics[6] || othdata.academics[7] || othdata.academics[8] || othdata.academics[9]))'>
                                <h4>Diploma</h4><br>
                                
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>College</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[5]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[6]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[7]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Grade/Percentage</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[9]}}</p>

                                    </div>
                                </div>
                            </div>
                    <!--XIIth-->
                            <div class="row" ng-if='((othdata.academics[10] || othdata.academics[11] || othdata.academics[12] || othdata.academics[13] || othdata.academics[14]))'>
                                <h4>Xth</h4><br>
                                
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>School</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[10]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[11]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Board</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[12]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Grade/Percentage</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[14]}}</p>

                                    </div>
                                </div>
                            </div>
                   <!--Xth-->
                            <div class="row" ng-if='((othdata.academics[15] || othdata.academics[16] || othdata.academics[17] || othdata.academics[18] || othdata.academics[19]))'>
                                <h4>Xth</h4><br>
                                
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>School</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[15]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[16]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Board</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[17]}}</p>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Grade/Percentage</label>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{othdata.academics[19]}}</p>

                                    </div>
                                </div>
                            </div>
                        </div>        

                           
                        </div>
                        <div class="modal-footer">
                            <center><a href="<?php print base_url(); ?>admin/Rank/studentRank"><button type="button" class="btn default">Back</button></a></center>
                        </div>
                                
                    </div>
                                
                            </div>



                        </div>
                    </div>  
                </div>
            </div>
            <div class="clearfix"> </div>
      


<script src="<?= USERASSETS ?>js/jquery.min.js" type="text/javascript"></script>
<script>
            function validateAlpha(e) {
                //updated by neeta
                var textInput = e.value;
                //var textInput = document.getElementById("cname").value;
                textInput = textInput.replace(/[^A-Za-z ]/g, "");
                e.value = textInput;
                //end
            }
            function validateNumber(e) {
                //updated by neeta
                var textInput = e.value;
                textInput = textInput.replace(/[^0-9]/g, "");
                e.value = textInput;
                //end
            }


</script>