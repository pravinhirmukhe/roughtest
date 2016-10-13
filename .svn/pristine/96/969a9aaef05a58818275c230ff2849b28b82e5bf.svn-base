function getPage(page)
{
    $("#feeds_center").html("<img src='assets/images/hex-loader2.gif' />");
    $.ajax
            ({
                type: "POST",
                url: "app/includes/feeds_handler.php",
                data: "page=" + page,
                success: function (result)
                {
                    $("#feeds_center").html(result);
                }
            });
}
function setSub(subid, topicid, ex_type)
{
    $("#feeds_center").html("<img src='assets/images/hex-loader2.gif' />");
    $.ajax
            ({
                type: "POST",
                url: "app/includes/set.php?SUB",
                data: {
                    "subid": subid,
                    "topicid": topicid,
                    "ex_type": ex_type
                },
                success: function (result)
                {
                    $("#feeds_center").html(result);
                }
            });
}
function completeKc(subid, topicid, ex_type)
{
    $("#feeds_center").html("<img src='assets/images/hex-loader2.gif' />");
    $.ajax
            ({
                type: "POST",
                url: "app/includes/set.php?completeKc",
                data: {
                    "subid": subid,
                    "topicid": topicid,
                    "ex_type": ex_type
                },
                success: function (result)
                {
                    $("#feeds_center").html(result);
                }
            });
}
function setKc(subid, topicid)
{
    $("#feeds_center").html("<img src='assets/images/hex-loader2.gif' />");
    $.ajax
            ({
                type: "POST",
                url: "app/includes/set.php?KC",
                data: {
                    "subid": subid,
                    "topicid": topicid
                },
                success: function (result)
                {
                    $("#feeds_center").html(result);
                }
            });
}
function getQ(qid, type) {
    //type will define if next butoon was pressed or next
    if (document.getElementById('o1').checked) {
        var val = 1;
    }
    else if (document.getElementById('o2').checked) {
        var val = 2;
    }
    else if (document.getElementById('o3').checked) {
        var val = 3;
    }
    else if (document.getElementById('o4').checked) {
        var val = 4;
    }
    else {
        var val = 'U';
    }

    $.ajax({
        type: "POST",
        url: "app/includes/set.php?getQ",
        data: {
            "qid": qid,
            "op": val,
            "type": type
        },
        success: function (result) {
            $("#feeds_center").html(result);
        }
    });
}
function getHomeSidemenu() {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?home_sidemenu",
        data: "data=1",
        success: function (result) {
            $("#hidden").html(result);
        }
    });
}
function showDppT() {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?dppt",
        success: function (result) {
            $("#dpp_t").html(result);
        }
    });
}
function directQ(ansForQid, qid, type) {
    //type will define if next butoon was pressed or next
    if (document.getElementById('o1').checked) {
        var val = 1;
    }
    else if (document.getElementById('o2').checked) {
        var val = 2;
    }
    else if (document.getElementById('o3').checked) {
        var val = 3;
    }
    else if (document.getElementById('o4').checked) {
        var val = 4;
    }
    else {
        var val = 'U';
    }
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?directQ",
        data: {
            "ansForQid": ansForQid,
            "qid": qid,
            "op": val,
            "type": type
        },
        success: function (result) {
            $("#feeds_center").html(result);
        }
    });
}
function askEndTest(id) {
    if (document.getElementById('o1').checked) {
        var val = 1;
    }
    else if (document.getElementById('o2').checked) {
        var val = 2;
    }
    else if (document.getElementById('o3').checked) {
        var val = 3;
    }
    else if (document.getElementById('o4').checked) {
        var val = 4;
    }
    else {
        var val = 'U';
    }
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?AskEndTest",
        data: {
            "test": "end",
            "qid": id,
            "val": val
        },
        success: function (result) {
            $("#feeds_center").html(result);
        }
    });
}
function endTest(val) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?endTest",
        data: "response=" + val,
        success: function (result) {
            $("#feeds_center").html(result);
        }
    });
}
function getFriends() {
    $("#feeds_center").html("<img src='assets/images/hex-loader2.gif' />");
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?friends",
        data: "response=friends",
        success: function (result) {
            $("#feeds_center").html(result);
        }
    });
}

function search() {
    query = document.getElementById("search_q").value;
    if (query.length == 0) {
        //empty search query
    }
    else if (query.length < 3) {
        alert("Length must be greater than 2");
    }
    else {
        $("#feeds_center").html("<img src='assets/images/hex-loader2.gif' />");
        $.ajax({
            type: "POST",
            url: "app/includes/set.php?people",
            data: "data=" + query,
            success: function (result) {
                $("#feeds_center").html(result);
            }
        });
        getHomeSidemenu();
    }
}
function f_profile(fid) {
    $("#feeds_center").html("<img src='assets/images/hex-loader2.gif' />");
    $.ajax({
        type: "GET",
        url: "app/includes/profile_handler.php",
        data: "fid=" + fid,
        success: function (result) {
            $("#feeds_center").html(result);
        }
    });
}

function try_register() {
    var form = document.getElementById("register");
    var formData = $(form).serialize();
    document.getElementById('submit').disabled = true;
    $('#loader').html("<img src='assets/images/loading.gif' >");
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?register",
        data: "data=" + formData,
        success: function (result) {
            document.getElementById('submit').disabled = false;
            $('#loader').html("");
            $("#reg_err").html(result);
        }
    });
}
function addfriend(uid) {
    document.getElementById("button_" + uid).innerHTML = "<input type=button class='btn btn-default' value='Requesting' DISABLED />";
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?addfriend",
        data: "data=" + uid,
        success: function (result) {
            document.getElementById("button_" + uid).innerHTML = result;
        }
    });
}
function set_schedule() {
    date = document.getElementById('sc_date').value;
    tid = document.getElementById('tid').value;
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?schedule",
        data: {"date": date,
            "tid": tid
        },
        success: function (result) {
            document.getElementById('result').innerHTML = result;
            $("#sch_modal").modal("hide");
            setTimeout(function () {
                getPage('SCHEDULER');
            }, 1000);
        }
    });
}
function delProf(key) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?delprof",
        data: "key=" + key,
        success: function (result) {
            getPage('PROFILE');
        }
    });
}
function delAca(key) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?delAca",
        data: "key=" + key,
        success: function (result) {
            getPage('PROFILE');
        }
    });
}
function setInstructions(subid, topicid, ex_type) {
    $.ajax({
        type: "GET",
        url: "app/includes/instructions.php",
        data: "ex_type=" + ex_type,
        success: function (result) {
            document.getElementById('exam_inst').innerHTML = result;
            document.getElementById('start_exam_btn').innerHTML = "<a href=# data-dismiss='modal' class='btn btn-success' onclick='setSub(" + subid + "," + topicid + "," + ex_type + ")'>Start Exam</a>";

        }
    });
}
function toggle_visibility(id) {
    var e = document.getElementById("exercise_options" + id);
    if (e.style.display == 'block' || e.style.display == '')
        e.style.display = 'none';
    else
        e.style.display = 'block';
}
function setMod(mod) {
    if (mod == "professional") {
        document.getElementById("professional").style.display = 'block';
    }
    else {
        document.getElementById("professional").style.display = 'none';
    }

    if (mod == "academic") {
        document.getElementById("academic").style.display = 'block';
    }
    else {
        document.getElementById("academic").style.display = 'none';
    }

    if (mod == "achievements") {
        //code
        document.getElementById("achievements").style.display = 'block';
    }
    else {
        document.getElementById("achievements").style.display = 'none';
    }
    if (mod == "certificates") {

        document.getElementById("certificates").style.display = 'block';
    }
    else {
        document.getElementById("certificates").style.display = 'none';
    }
    if (mod == "soc_work") {
        document.getElementById("soc_work").style.display = 'block';
    }
    else {
        document.getElementById("soc_work").style.display = 'none';
    }
    if (mod == "extra") {

        document.getElementById("extra").style.display = 'block';
    }
    else {
        document.getElementById("extra").style.display = 'none';
    }

    if (mod == "sports") {

        document.getElementById("sports").style.display = 'block';
    }
    else {
        document.getElementById("sports").style.display = 'none';
    }

    if (mod == "documents") {

        document.getElementById("documents").style.display = 'block';
    }
    else {
        document.getElementById("documents").style.display = 'none';
    }

    if (mod == "pro_act") {
        document.getElementById("pro_act").style.display = 'block';
    }
    else {
        document.getElementById("pro_act").style.display = 'none';
    }

    if (mod == "roughsheet_stat") {

        document.getElementById("roughsheet_stat").style.display = 'block';
    }
    else {
        document.getElementById("roughsheet_stat").style.display = 'none';
    }
    if (mod == "all") {
        document.getElementById("professional").style.display = 'block';
        document.getElementById("academic").style.display = 'block';
        //document.getElementById("achievements").style.display = 'block';
        //document.getElementById("certificates").style.display = 'block';
        //document.getElementById("soc_work").style.display = 'block';
        //document.getElementById("extra").style.display = 'block';
        //document.getElementById("sports").style.display = 'block';
        //document.getElementById("documents").style.display = 'block';
        //document.getElementById("pro_act").style.display = 'block';
        //document.getElementById("roughsheet_stat").style.display = 'block';
    }
    else {

        //hide elements under development
        document.getElementById("achievements").style.display = 'none';
        document.getElementById("certificates").style.display = 'none';
        document.getElementById("soc_work").style.display = 'none';
        document.getElementById("extra").style.display = 'none';
        document.getElementById("sports").style.display = 'none';
        document.getElementById("documents").style.display = 'none';
        document.getElementById("pro_act").style.display = 'none';
        document.getElementById("roughsheet_stat").style.display = 'none';

    }
}
//amol
function function_update() {
    //code

    var birth_val = document.getElementById("birth_d").value;

    if (birth_val == null || birth_val == "") {
        document.getElementById("profile_error").innerHTML = "<div class='alert alert-info'>Birthdate is manadatory</div>";
    } else
    {
        var gender_u;
        var gender_m = document.getElementById("gender_m").checked;


        if (gender_m) {
            gender_u = 'male';
        } else
        {
            gender_u = 'female';
        }

        var home_town = document.getElementById("h_town").value;
        var current_c = document.getElementById("current_c").value;
        var contact = document.getElementById("contact_u").value;

        var in_o_c = document.getElementById("in_c_u").value;

        $("#feeds_center").html("<img src='assets/images/hex-loader2.gif' />");

        $.ajax({
            type: "POST",
            url: "app/includes/set.php?profile_update",
            data: {
                "birth_val": birth_val,
                "gender": gender_u,
                "home_town": home_town,
                "current_c": current_c,
                "contact": contact,
                "in_c": in_o_c
            }, success: function (result) {
                getPage('PROFILE');
                document.getElementById("profile_options").innerHTML = '<p>Updated Successful</p>';
            }
        });
    }
}
function getDppQ(qid, type) {
    //type will define if next butoon was pressed or next
    if (document.getElementById('o1').checked) {
        var val = 1;
    }
    else if (document.getElementById('o2').checked) {
        var val = 2;
    }
    else if (document.getElementById('o3').checked) {
        var val = 3;
    }
    else if (document.getElementById('o4').checked) {
        var val = 4;
    }
    else {
        var val = 'U';
    }

    $.ajax({
        type: "POST",
        url: "app/includes/set.php?getQ",
        data: {
            "qid": qid,
            "op": val,
            "type": type
        },
        success: function (result) {
            $("#feeds_center").html(result);
        }
    });
}
function refreshBadge() {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?refreshBadge",
        success: function (result) {
            $("#print_badge").html(result);
        }
    });
}
function f_confirm(fid) {

    $.ajax({
        type: "POST",
        url: "app/includes/set.php?confirmF",
        data: "fid=" + fid,
        success: function (result) {
            $("#button_" + fid).html(result);
            refreshBadge();
        }
    });
}
function unfriend(fid) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?unfriend",
        data: "fid=" + fid,
        success: function (result) {
            $("#button_" + fid).html(result);
        }
    });
}
function f_reject(uid) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?rejectU",
        data: "uid=" + uid,
        success: function (result) {
            $("#button_" + uid).html(result);
            refreshBadge();
        }
    });
}
function f_confirm_menu(fid) {

    $.ajax({
        type: "POST",
        url: "app/includes/set.php?confirmF",
        data: "fid=" + fid,
        success: function (result) {
            $("#fr_data_" + fid).html(result);
            refreshBadge();
        }
    });
}
function f_reject_menu(uid) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?rejectU",
        data: "uid=" + uid,
        success: function (result) {
            $("#request_" + uid).html("");
            refreshBadge();
        }
    });
}

function getdpp(tval) {
    //code
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?dpp",
        data: "data=" + tval,
        success: function (result) {
            $("#feeds_center").html(result);
        }
    });
}

function instructionsDppTpp(type, val) {
    $.ajax({
        type: "GET",
        url: "app/includes/instructions.php",
        data: "ex_type=" + type,
        success: function (result) {
            document.getElementById('exam_inst').innerHTML = result;
            if (type == 'DPP') {
                document.getElementById('start_exam_btn').innerHTML = "<a href=# data-dismiss='modal' class='btn btn-success' onclick='getdpp(" + val + ")'>Start Exam</a>";
            }
            else {
                document.getElementById('start_exam_btn').innerHTML = "<a href=# data-dismiss='modal' class='btn btn-success' onclick='gettpp(" + val + ")'>Start Exam</a>";
            }
        }
    });
}