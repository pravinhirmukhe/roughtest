var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var present_year = new Date().getFullYear();
            var option_str="";
            for(var i=2000;i<=present_year;i++){
               option_str=option_str+"<option value='"+i+"'>"+i+"</option>";
            }
var pos;
var month_str="";
   for(var m=1;m<=12;m++){
      pos=m-1;
      month_str=month_str+"<option value='"+m+"'>"+months[pos]+"</option>";
   }
    
function addData(page)
	{
           document.getElementById(page+"_plus").style.display='none';
           var c=document.getElementById(page+"_count");
           var page_val=c.value;
           if (page_val=='undefined' || page_val<0 || page_val=='null') {
            //code
            //Tampering
            document.getElementById(page+'_err').innerHTML='<div class="alert alert-warning">Code Tampering Detected.</div>';
           }else if(page_val>=5){
            document.getElementById(page+'_err').innerHTML='<div class="alert alert-warning">You have reached the limit.</div>';
           }else{
            //page_val++;
            var e=document.getElementById(page+"_1");
            //c.value=page_val;
            //var next_val=page_val+1;
            document.getElementById(page+"_save").innerHTML="<a class='btn btn-default' onclick=saveAboveData('"+page+"') >SAVE</a>";
            
            if (page=="professional_area") {
             //code
             e.innerHTML="<form id='professional_area_form'><table class='table' style='font-size:12px;'><tr><th>Year</th><td>From <select name='start_year'>"+option_str+"</select><select name='start_month'>"+month_str+"</select>  To <select name='to_year'>"+option_str+"</select><select name='to_month'>"+month_str+"</select></td><th>Job Type</th><td><select name='jtype'><option value='Full Time'>Full Time</option><option value='Part Time'>Part Time</option><option value='Internship'>Internship</option></select></td></tr><tr><th>Company</th><td><input type='text' class='form-control' name='"+page+"_cname' ></td><th>Location</th><td><input type='text' class='form-control' name='"+page+"_cloc' ></td></tr><tr><th>Designation</th><td><input type='text' class='form-control' name='"+page+"_cdesig' ></td><th>Functional area</th><td><input type='text' class='form-control' name='"+page+"_cfa' ></td></tr></table></form>";
            }
            else if (page=="") {
             //code
           
            }
            else if (page=="") {
             //code
           
            }
            else if (page=="") {
             //code
           
            }
            else if (page=="") {
             //code
           
            }
            else if (page=="") {
             //code
           
            }
            else if (page=="") {
             //code
           
            }
           }
	}
        
function saveAboveData(page){
   var form=document.getElementById(page+"_form");
   var formData = $(form).serializeArray();
               $.ajax({
                        type: "POST",
			url: "app/includes/profile_handler.php?SAVE",
			data: {
                           "page":page,
                           "data":formData
                              },
                        success: function(result)
			{
                                if (result.indexOf("inappropriate value")>-1) {
                                 //code
                                 $("#"+page+'_err').html(result);
                                }
                                else{
                                 $("#"+page).html(result);
                                 val=document.getElementById(page+"_count").value;
                                 val++;
                                 document.getElementById(page+"_count").value=val;
                                }
                                
			}
               });
}
function editThisProf(key,sy,sm,ty,tm,jt,cn,cl,cd,cfa){
            document.getElementById("professional_options_"+key).innerHTML="<a onclick=\"function_update_professional('"+key+"')\" class='btn btn-default'>Save</a><a onclick=\"cancel_update_professional('"+key+"','"+sy+"','"+sm+"','"+ty+"','"+tm+"','"+jt+"','"+cn+"','"+cl+"','"+cd+"','"+cfa+"')\" class='btn btn-danger'>Cancel</a>";
            document.getElementById("professional_area_edit_"+key).innerHTML="<table class='table' style='font-size:12px;border: hidden;'><tr><th>Year</th><td>From <select id='start_year_"+key+"'>"+option_str+"</select><select id='start_month_"+key+"'>"+month_str+"</select>  To <select id='to_year_"+key+"'>"+option_str+"</select><select id='to_month_"+key+"'>"+month_str+"</select></td><th>Job Type</th><td><select id='jtype_"+key+"'><option value='Full Time'>Full Time</option><option value='Part Time'>Part Time</option><option value='Internship'>Internship</option></select></td></tr><tr><th>Company</th><td><input type='text' class='form-control input-sm' id='professional_cname_"+key+"' value='"+cn+"' ></td><th>Location</th><td><input type='text' class='form-control input-sm' id='professional_area_cloc_"+key+"' value='"+cl+"' ></td></tr><tr><th>Designation</th><td><input type='text' class='form-control input-sm' id='professional_area_cdesig_"+key+"' value='"+cd+"' ></td><th>Functional area</th><td><input type='text' class='form-control input-sm' id='professional_area_cfa_"+key+"' value='"+cfa+"' ></td></tr></table>";
}
function editAcademic(){
               $.ajax({
                        type: "POST",
			url: "app/includes/profile_handler.php?ACADEMIC",
			data: {
                           "page":"Academic",
                           "data":"EditAca"
                        },
                        success: function(result)
			{
                           $('#js_func').html(result);
                           $("#academic_options").html("<a onclick='update_academic()' class='btn btn-default'>Save</a>");
			}
               });
}
function update_academic(){
   var formData=[];
            formData[0]=document.getElementById('coll_name').value;
            formData[1]=document.getElementById('coll_loc').value;
            formData[2]=document.getElementById('coll_branch').value;
            formData[3]=document.getElementById('coll_year').value;
            formData[4]=document.getElementById('coll_grade').value;
            formData[5]=document.getElementById('dip_name').value;
            formData[6]=document.getElementById('dip_loc').value;
            formData[7]=document.getElementById('dip_branch').value;
            formData[8]=document.getElementById('dip_year').value;
            formData[9]=document.getElementById('dip_grade').value;
            formData[10]=document.getElementById('xii_c_name').value;
            formData[11]=document.getElementById('xii_c_loc').value;
            formData[12]=document.getElementById('xii_c_branch').value;
            formData[13]=document.getElementById('xii_c_year').value;
            formData[14]=document.getElementById('xii_c_grade').value;
            formData[15]=document.getElementById('x_c_name').value;
            formData[16]=document.getElementById('x_c_loc').value;
            formData[17]=document.getElementById('x_c_medium').value;
            formData[18]=document.getElementById('x_c_year').value;
            formData[19]=document.getElementById('x_c_grade').value;
            
               $.ajax({
                        type: "POST",
			url: "app/includes/profile_handler.php?ACADEMIC",
			data: {
                           "page":"Academic",
                           "data":formData
                        },
                        success: function(result)
			{
                           $('#js_func').html(result);
                           $("#academic_options").html("<a id='edit_academic_info' style='float: right;'><span class='glyphicon glyphicon-edit' onclick=\"editAcademic()\"  aria-hidden='true'>Edit</span></a>");
			}
               });   
}
function getProPic(){
//alert("hiii");
   var file_data = $("#pro_pic_path").prop("files")[0];   
    var form_data = new FormData();                  
    form_data.append("file", file_data);
    $.ajax({
                url: "app/includes/profile_handler.php?PROPIC",
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(result){
                    alert(result); 
                }
     });
//   var path=document.getElementById('pro_pic_path').value;
//   $.ajax({
//                        type: "POST",
//			url: "app/includes/profile_handler.php?PROPIC",
//			data: {
//                           "page":"Propic",
//                           "data":path
//                        },
//                        success: function(result)
//			{
//                           alert(result);
//			}
//               });   
   
}
function cancel_update_professional(key,sy,sm,ty,tm,jt,cn,cl,cd,cfa){
   document.getElementById("professional_area_edit_"+key).innerHTML="<table class='table' style='font-size:12px;border: hidden;'><tr><th>Year</th><td><div id='year_"+key+"'>"+sm+" / "+sy+"  To "+tm+" / "+ty+"</div></td><th>Job Type</th><td><div id='jt_"+key+"'>"+jt+"</div></td></tr><tr><th>Company</th><td><div id='p_company_"+key+"'>"+cn+"</div></td><th>Location</th><td><div id='p_location_"+key+"'>"+cl+"</div></td></tr><tr><th>Designation</th><td><div id='p_designation_"+key+"'>"+cd+"</div></td><th>Functional area</th><td><div id='p_f_area_"+key+"'>"+cfa+"</div></td></tr></table>";
   document.getElementById("professional_options_"+key).innerHTML="<a href=# onclick='delProf($key);' style='float:left;'>Delete</a><a id='edit_professional_info' style='float: right;'><span class='glyphicon glyphicon-edit' onclick=\"editThisProf('"+key+"','"+sy+"','"+sm+"','"+ty+"','"+tm+"','"+jt+"','"+cn+"','"+cl+"','"+cd+"','"+cfa+"')\"  aria-hidden='true'>Edit</span></a>";
   document.getElementById("professional_area_err").innerHTML="";
}
function function_update_professional(key){
   var sy=document.getElementById("start_year_"+key).value;
   var sm=document.getElementById("start_month_"+key).value;
   var ty=document.getElementById("to_year_"+key).value;
   var tm=document.getElementById("to_month_"+key).value;
   var jt=document.getElementById("jtype_"+key).value;
   var cn=document.getElementById('professional_cname_'+key).value;
   var cl=document.getElementById('professional_area_cloc_'+key).value;
   var cd=document.getElementById('professional_area_cdesig_'+key).value;
   var cfa=document.getElementById('professional_area_cfa_'+key).value;
   var datastr=key+"__"+sy+"__"+sm+"__"+ty+"__"+tm+"__"+jt+"__"+cn+"__"+cl+"__"+cd+"__"+cfa;
   var page="professional_area";
   
   $.ajax({
                        type: "POST",
			url: "app/includes/profile_handler.php?UPDATE",
			data: {
                           "page":page,
                           "data":datastr
                              },
                        success: function(result)
			{
                                if (result.indexOf("inappropriate value")>-1) {
                                 //code
                                 $("#"+page+'_err').html(result);
                                }
                                else{
                                 document.getElementById(page).innerHTML=result;
                                 sm--;
                                 var sm_data=months[sm];
                                 tm--;
                                 var tm_data=months[tm];
                                 toggleButtons(page);
document.getElementById("professional_options_"+key).innerHTML="<a href=# onclick='delProf($key);' style='float:left;'>Delete</a><a style='float: right;' onclick=\"editThisProf('"+key+"','"+sy+"','"+sm_data+"','"+ty+"','"+tm_data+"','"+jt+"','"+cn+"','"+cl+"','"+cd+"','"+cfa+"')\" ><span class='glyphicon glyphicon-edit' aria-hidden='true'>Edit</span></a>";
                                }
			}
               });
}
function toggleButtons(page){
   document.getElementById(page+"_plus").style.display='block';
   document.getElementById(page+"_save").innerHTML="";
   document.getElementById(page+"_err").innerHTML="";
}
