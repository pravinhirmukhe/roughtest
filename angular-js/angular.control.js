if (!alertify.errorAlert) {
    //define a new errorAlert base on alert
    alertify.dialog('errorAlert', function factory() {
        return{
            build: function () {
                var errorHeader = '<span class="glyphicons glyphicons-remove-sign" '
                        + 'style="vertical-align:middle;color:#e10000;">'
                        + '</span> <b style="color:red">Error</b>';
                this.setHeader(errorHeader);
            }
        };
    }, true, 'alert');
}


app = angular.module('rough', ['ngRoute', 'ngSanitize']);
app.config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
        $httpProvider.interceptors.push('myInterceptor');
    }]);
app.run(function ($rootScope, Data, facebookService) {
    $rootScope.subid = 0;
    $rootScope.tid = 0;
    $rootScope.forgetemail = "";
    $rootScope.months = [{val: 1, name: 'Jan'}, {val: 2, name: 'Feb'}, {val: 3, name: 'Mar'}, {val: 4, name: 'Apr'}, {val: 5, name: 'May'}, {val: 6, name: 'Jun'}, {val: 7, name: 'Jul'}, {val: 8, name: 'Aug'}, {val: 9, name: 'Sep'}, {val: 10, name: 'Oct'}, {val: 11, name: 'Nov'}, {val: 12, name: 'Dec'}]
    $rootScope.date = new Date();
    $rootScope.FBID = FBID;
    $rootScope.fb_friends = [];
    $rootScope.chpuser = {flag: false, cpass: "", pass: "", repass: ""};
    $rootScope.contact = {sub: "", msg: ""};
    $rootScope.setKc = function (sid, tid) {
        $rootScope.subid = sid;
        $rootScope.tid = tid;
    }
    $rootScope.resendAct = function ($email) {
        Data.ReSendActv($.param({email: $email})).success(function (d) {
            if (d.s == '1') {
                $('#reg_act_info').html('<center><h4>Activation Mail send Successful.<br>Verify yourself by clicking on the link sent to your mail box.</h4></center>');
            } else if (d.s == '2') {
                $('#reg_act_info').html('<center><h4>Activation Mail sending Failed.<br>But did not sent mail. please contact to roughsheet support team! error(' + d.msg + ')</h4></center>');
            }
        })
    }
    $rootScope.setInstructions = function (subid, topicid, ex_type) {
        Data.SetInstr($.param({ex_type: ex_type})).success(function (d) {
            document.getElementById('exam_inst').innerHTML = d;
            document.getElementById('start_exam_btn').innerHTML = "<a href=# data-dismiss='modal' onclick='setSub(" + subid + "," + topicid + "," + ex_type + ")' class='btn btn-success'>Start Exam</a>";
        });
    }
    $rootScope.instructionsDppTpp = function (ex_type, val) {
        Data.SetInstr($.param({ex_type: ex_type})).success(function (d) {
            document.getElementById('exam_inst').innerHTML = d;
            if (ex_type == 'DPP') {
                document.getElementById('start_exam_btn').innerHTML = "<a href=# data-dismiss='modal' class='btn btn-success' onclick='getdpp(" + val + ")'>Start Exam</a>";
            }
            else {
                document.getElementById('start_exam_btn').innerHTML = "<a href=# data-dismiss='modal' class='btn btn-success' onclick='gettpp(" + val + ")'>Start Exam</a>";
            }
        });
    }
    Data.GetSideviewd().success(function (d) {
        $('#sidemenu').html(d);
    });
//    $rootScope.setSub = function (subid, topicid, ex_type) {
//        Data.GetExam($.param({subid: subid, topicid: topicid, ex_type: ex_type})).success(function (d) {
//            $('#exambody').html(d);
//            $('#examwizard').modal('show');
//        });
//    }
    $rootScope.mconfirmed = function (di) {
        Data.GetMConfirmed($.param({fid: di, f: "frsh"})).success(function (d) {
//            $scope.fs = d;
        });
    }
    $rootScope.mreject = function (di) {
        Data.GetMReject($.param({uid: di, f: "frsh"})).success(function (d) {
//            $scope.fs = d;
        });
    }
    $rootScope.changepass = function () {
        if ($rootScope.chpuser.pass == "") {
            alertify.errorAlert("<b style='color:red'>Password field Should not be empty!</b>");
        } else if ($rootScope.chpuser.repass == "") {
            alertify.errorAlert("<b style='color:red'>Re-Password field Should not be empty!</b>");
        } else if ($rootScope.chpuser.pass != $rootScope.chpuser.repass) {
            alertify.errorAlert("<b style='color:red'>Password fields Dose not match!</b>");
        } else {
            Data.ChangePass($.param({pass: $rootScope.chpuser.pass})).success(function (d) {
                if (d == "1") {
                    $rootScope.chpuser = {flag: false, cpass: "", pass: "", repass: ""};
                    alertify.alert('Success', "<b style='color:green'>Password changed succefully!</b>");
                    $('.change_pass').modal('hide');
                }
            });
        }
    }
    $rootScope.checkpass = function () {
        if ($rootScope.chpuser.cpass == "") {
            alertify.errorAlert("<b style='color:red'>Password field Should not be empty!</b>");
        } else {
            Data.CheckUPass($.param({cpass: $rootScope.chpuser.cpass})).success(function (d) {
                if (d == "1") {
                    $rootScope.chpuser.flag = true;
                    alertify.alert('Success', "<b style='color:green'>Password is correct!</b>");
                } else {
                    $rootScope.chpuser.flag = false;
                    alertify.errorAlert("<b style='color:red'>Password is incorrect!</b>");
                }
            });
        }

    }
    $rootScope.contact_us = function () {
        if ($rootScope.contact.sub == "") {
            alertify.errorAlert("<b style='color:red'>Subject field not empty</b>");
        } else if ($rootScope.contact.msg == "") {
            alertify.errorAlert("<b style='color:red'>Message field not empty</b>");
        } else {
            Data.ContactUsTo($.param($rootScope.contact)).success(function (d) {
                if (d.s == "1") {
                    $rootScope.contact = {sub: "", msg: ""};
                    alertify.alert('Success', "<b style='color:green'>Maile Send Successfully!</b>");
                    $('.contact_form').modal('hide');
                } else {
                    alertify.errorAlert("<b style='color:red'>Mail Did not send! (" + d.msg + ")</b>");
                }
            });
        }

    }
    $rootScope.recoverpass = function (email) {
        if (email == "" && email.length == 0) {
            alertify.errorAlert("Email Field Can not be empty!");
        } else {
            Data.CheckEmail($.param({email: email})).success(function (d) {
                if (d.s != '1') {
                    alertify.errorAlert("Email dose not Exist!");
                } else {
                    Data.ForgetPassword($.param({email: email})).success(function (d) {
                        if (d.s == "1") {
                            alertify.alert('Success', d.msg);
                        } else {
                            alertify.errorAlert(d.msg);
                        }
                    });
                }
            });
        }
    }
    $rootScope.reg = {
        fb_link: "",
        f_name: "",
        l_name: "",
        gender: "",
        dob: {y: "", m: "", d: ""},
        i_code_present: "",
        i_code: "",
//        res_captcha: "",
        regemail: "",
        password: "",
        repass: "",
        location: "",
        locations: "",
        currently: "",
        institute: "",
        institutes: "",
        branch: "",
        branchs: "",
        graduationyear: "",
        payment_id: ""
    };
    $rootScope.fb = function () {
        facebookService.getLogin().then(function (response) {
            data = response;
            Data.FbLogin($.param(data)).success(function (d) {
                if (d.status == 1) {
                    window.location = site_url;
                } else if (d.status == 2) {
                    $rootScope.reg.fb_link = data.link;
                    $rootScope.reg.f_name = data.first_name;
                    $rootScope.reg.l_name = data.last_name;
                    $rootScope.reg.regemail = data.email;
                    data.gender = data.gender.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                        return letter.toUpperCase();
                    });
                    $('input:radio[value=' + data.gender + ']').prop('checked', true);
                    $('.reg_model').modal('show');
                } else {
                    $('#fblogin_info').html("<center><h2>Your Account not Activated. Please Activate first or contact to administration!!</h2></center>")
                    $('.fblogin').modal('show');
                }
            });
        });
    };
    $rootScope.getFBFriends = function () {
        $res = [];
        if ($rootScope.FBID.length == 0 && $rootScope.FBID == "") {
            alertify.errorAlert('Your Account not connected to Facebook!!');
        } else {
            facebookService.getFBFriends().then(function (response) {
                var friend_data = response.data;
                var results = '';
                for (var i = 0; i < friend_data.length; i++) {
                    $res.push({
                        id: friend_data[i].id,
                        img: "https://graph.facebook.com/" + friend_data[i].id + "/picture",
                        name: friend_data[i].name, profile: "https://www.facebook.com/app_scoped_user_id/" + friend_data[i].id
                    });
                }
                $rootScope.fb_friends = $res;
            });
        }
    }
    $rootScope.getFBConnect = function () {
        facebookService.getLogin().then(function () {
            data = response;
            Data.GetFBConnect($.param(data)).success(function (d) {
                if (d.s == '1') {
                    $rootScope.FBID = d.fbid;
                } else {
                    alertify.errorAlert('Your Account not connected to Facebook!!');
                }
            });
        });
    }
});
app.controller('examcontrol', ['$scope', '$rootScope', '$http', 'Data', '$routeParams', function ($scope, $rootScope, $http, Data, $routeParams) {
        Data.GetExam($.param({subid: $routeParams.sid, topicid: $routeParams.tid, ex_type: $routeParams.ext})).success(function (d) {
            $scope.examcontainer = d;
        });
        Data.GetSideviewd().success(function (d) {
            $('#sidemenu').html(d);
        });
    }]);
app.controller('galacticoscontrol', ['$scope', '$rootScope', '$http', 'Data', '$routeParams', function ($scope, $rootScope, $http, Data, $routeParams) {
        Data.GetRanking().success(function (d) {
            $scope.ranksub = d;
        });
        $scope.getRankingDomain = function (id) {
            Data.GetRankingDomains($.param({subid: id})).success(function (d) {
                $("#rankContainer").html(d);
            });
        }
        getRankingType = function (subid, type) {
            Data.GetRankingTypes($.param({subid: subid, type: type})).success(function (d) {
                $("#rtype").html(d);
            });
        }
        generateRank = function (subid, domain, type) {
            Data.GetgenerateRanks($.param({subid: subid, domain: domain, type: type})).success(function (d) {
                $("#rank").html(d);
            });
        }
    }]);
app.controller('focuscontrol', ['$scope', '$rootScope', '$http', 'Data', '$routeParams', function ($scope, $rootScope, $http, Data, $routeParams) {
        Data.GetFocusArea().success(function (d) {
            $scope.focus = d;
        });
    }]);
app.controller('performancecontrol', ['$scope', '$rootScope', '$http', 'Data', '$routeParams', function ($scope, $rootScope, $http, Data, $routeParams) {
        Data.GetPerformance().success(function (d) {
            $scope.perform = d;
        });
        $scope.getGraph = function (subid) {
            Data.Getgraphs($.param({subid: subid})).success(function (d) {
                $str = "<center>";
                $str += '<button onclick="changePerfMonth(' + subid + ',\'PREVIOUS\');">Previous</button>';
                $str += '<button onclick="changePerfMonth(' + subid + ',\'NEXT\');">Next</button>';
                $str += "</center>";
                $str += d;
                $("#perf_graph").html($str);
                $scope.getRankGraphs(subid);
                $scope.getRankGraphPC(subid);
            });
        }
        $scope.getRankGraphs = function (subid) {
            Data.GetRankGraph($.param({subid: subid})).success(function (d) {
                $("#perf_graph_pw").html("Percentile Weekly" + d);
            });
        }
        $scope.getRankGraphPC = function (subid) {
            Data.GetRankGraphPCs($.param({subid: subid})).success(function (d) {
                $("#perf_graph_pc").html("Percentile Cumulative" + d);
            });
        }
        $scope.getRankGraphW = function (subid) {
            Data.GetRankGraphWs($.param({subid: subid})).success(function (d) {
                $("#perf_graph_w").html("Weekly" + d);
            });
        }
        $scope.getRankGraphC = function (subid) {
            Data.GetRankGraphCs($.param({subid: subid})).success(function (d) {
                $("#perf_graph_c").html("Cumulative" + d);
            });
        }
        changePerfMonth = function (subid, t) {
            Data.GetChangePerfMonth($.param({subid: subid, type: t})).success(function (d) {
                $scope.getGraph(subid);
            });
        }
    }]);
app.controller('dppcontrol', ['$scope', '$rootScope', '$http', 'Data', '$routeParams', function ($scope, $rootScope, $http, Data, $routeParams) {
        Data.GetTDPPS().success(function (d) {
            $scope.tdpps = d;
        });
        Data.GetTPP().success(function (d) {
            $scope.tpp = d;
        });
//        Data.GetSideviewd().success(function (d) {
//            $('#sidemenu').html(d);
//        });
    }]);
app.controller('friendcontrol', ['$scope', '$rootScope', '$http', 'Data', '$routeParams', function ($scope, $rootScope, $http, Data, $routeParams) {
        Data.GetFriends().success(function (d) {
            $scope.friends = d;
//            alert(JSON.stringify($scope.friends));
        });
        Data.GetSideviewd().success(function (d) {
            $('#sidemenu').html(d);
        });
        $scope.unfriend = function (d) {
            Data.GetUnfriend($.param({fid: d, f: "frli"})).success(function (d) {
                $scope.friends = d;
            });
        }
        $scope.confirmed = function (d) {
            Data.GetConfirmed($.param({fid: d, f: "frli"})).success(function (d) {
                $scope.friends = d;
            });
        }
        $scope.reject = function (di) {
            Data.GetReject($.param({uid: di, f: "frli"})).success(function (d) {
                $scope.friends = d;
            });
        }
    }]);
app.controller('profilecontrol', ['$scope', '$rootScope', '$http', 'Data', '$routeParams', function ($scope, $rootScope, $http, Data, $routeParams) {
        $('.datepicker').datepicker();
        $('.datepicker').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        $('.profilelist').click(function () {
            $(this).addClass('active').siblings().removeClass('active');
        });
        $scope.edit = false;
        $scope.personal = false;
        $scope.prof = false;
        $scope.acad = [false, false, false, false];
        $scope.setting = {public: [], private: []};
        $scope.permission = {};
        $scope.selfields = ['Name', 'DOB', 'Gender', 'City', 'Hometown', 'Contact', 'Email', 'InstitutionOrCompany', 'Pic', 'invitation'];
        $scope.show = {
            complete: false,
            professional: false,
            acadmic: false,
            certificates: false,
            achievement: false,
            social: false,
            extraca: false,
            sports: false,
            documents: false,
            privacy: false
        };
        Data.GetProfile($.param({fid: $routeParams.fid})).success(function (d) {
            $scope.f = d.prof;
            $scope.othdata = d.othdata;
            $scope.uid = d.uid;
            $scope.fid = d.fid;
            $scope.fields = d.fields;
            if (d.privacy != "0") {
                $scope.setting = d.privacy;
            }
            if (d.permission != "0") {
                $scope.permission = d.permission;
            }
        });
        Data.GetSideview($.param({fid: $routeParams.fid})).success(function (d) {
            $('#sidemenu').html(d);
        });
        $scope.setEdit = function (d) {
            if (d == "1") {
                $scope.edit = true;
            } else {
                $scope.edit = false;
            }
        }
        $scope.setPersonal = function () {
            $('.datepicker').datepicker();
            $scope.personal = true;
        }
        $scope.setProfession = function (id) {
            $('.datepicker').datepicker();
            $scope.othdata.prof_info[id].prof = true;
        }
        $scope.setAcad = function (id) {
            $scope.acad[id] = true;
        }
        $scope.deleteProfession = function (id) {
            $('.datepicker').datepicker();
            $scope.othdata.prof_info[id].prof = false;
            $scope.othdata.prof_info.splice(id, 1);
            Data.SetUpdateProf($.param({'prof': JSON.stringify($scope.othdata.prof_info)})).success(function (d) {
                if (d.s == "1") {
                    alertify.success('Updated Successfuly!!');
                    $scope.f = d.prof;
                    $scope.othdata = d.othdata;
                    $scope.uid = d.uid;
                    $scope.fid = d.fid;
                    $scope.personal = false;
                    $scope.acad = [false, false, false, false];
                } else {
                    alertify.error('Updateting Failed!!');
                }
            });
        }
        $scope.updatePer = function (f) {
            Data.SetUpdatePer($.param($scope.f)).success(function (d) {
                if (d.s == "1") {
                    alertify.success('Updated Successfuly!!');
                    $scope.f = d.prof;
                    $scope.othdata = d.othdata;
                    $scope.uid = d.uid;
                    $scope.fid = d.fid;
                    $scope.personal = false;
                    $scope.acad = [false, false, false, false];
                } else {
                    alertify.error('Updateting Failed!!');
                }
            });
        }
        $scope.updateProf = function (f) {
            Data.SetUpdateProf($.param({'prof': JSON.stringify($scope.othdata.prof_info)})).success(function (d) {
                if (d.s == "1") {
                    alertify.success('Updated Successfuly!!');
                    $scope.f = d.prof;
                    $scope.othdata = d.othdata;
                    $scope.uid = d.uid;
                    $scope.fid = d.fid;
                    $scope.personal = false;
                    $scope.acad = [false, false, false, false];
                } else {
                    alertify.error('Updateting Failed!!');
                }
            });
        }
        $scope.updateAcad = function () {
            Data.SetUpdateAcad($.param({'acad': JSON.stringify($scope.othdata.academics)})).success(function (d) {
                if (d.s == "1") {
                    alertify.success('Updated Successfuly!!');
                    $scope.f = d.prof;
                    $scope.othdata = d.othdata;
                    $scope.uid = d.uid;
                    $scope.fid = d.fid;
                    $scope.personal = false;
                    $scope.acad = [false, false, false, false];
                } else {
                    alertify.error('Updateting Failed!!');
                }
            });
        }
        $scope.setActive = function (i, d) {
            $.each($scope.show, function (k, v) {
                $scope.show[k] = false;
            });
            $scope.show[d] = true;
            $(i).addClass('active').siblings().removeClass('active');
        }
        $scope.publicprivacy = function (name, id) {
            var idxn = $scope.setting.public.indexOf(name);
            if (idxn > -1) {
                $scope.setting.public.splice(idxn, 1);
            }
            else {
                $scope.setting.public.push(name);
            }
        }
        $scope.privateprivacy = function (name) {
            var idxn = $scope.setting.private.indexOf(name);
            if (idxn > -1) {
                $scope.setting.private.splice(idxn, 1);
            }
            else {
                $scope.setting.private.push(name);
            }
        }
        $scope.privacySave = function () {
            Data.SetPrivacySetting($.param({setting: $scope.setting})).success(function (d) {
                if (d.s == "1") {
                    $scope.setting = d.setting;
                    alertify.success(d.msg);
                } else {
                    alertify.error(d.msg);
                }
            });
        }
    }]);
app.controller('userlogin', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.user = {};
        $scope.login = function () {
            Data.Login($.param($scope.user)).success(function (d) {
                if (d.s == '1') {
                    $scope.status = d.s;
                    $scope.msg = d.msg;
                    setTimeout(function () {
                        window.location = site_url;
                    }, 1000);
                }
                if (d.s == '0') {
                    $scope.status = d.s;
                    $scope.msg = d.msg;
                }
            });
        };
    }]);
app.controller('firendsearch', ['$scope', '$rootScope', '$http', 'Data', '$routeParams', function ($scope, $rootScope, $http, Data, $routeParams) {
        $scope.fs = [];
        if ($routeParams.data.length == 0 || $routeParams.data == "") {
            //empty search query
            alertify.alert("Error", "Search Field Empty");
        }
        else if ($routeParams.data.length < 3) {
            alertify.alert("Error", "Length must be greater than 2");
        }
        else {
            Data.GetFriendSearch($.param({data: $routeParams.data})).success(function (d) {
                $scope.fs = d;
            });
        }
        $scope.unfriend = function (di) {
            Data.GetUnfriend($.param({fid: di, f: "frsh", data: $routeParams.data})).success(function (d) {
                $scope.fs = d;
            });
        }
        $scope.confirmed = function (di) {
            Data.GetConfirmed($.param({fid: di, f: "frsh", data: $routeParams.data})).success(function (d) {
                $scope.fs = d;
            });
        }
        $scope.reject = function (di) {
            Data.GetReject($.param({uid: di, f: "frsh", data: $routeParams.data})).success(function (d) {
                $scope.fs = d;
            });
        }
        $scope.addfriend = function (di) {
            Data.GetAddfriend($.param({id: di, data: $routeParams.data})).success(function (d) {
                if (d.s == "1") {
                    $scope.fs = d;
                } else {
                    alertify.alert("Error", d.msg);
                }
            });
        }
    }]);
app.controller('schedulemodal', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        Data.GetSubject().success(function (d) {
            $scope.subjects = d;
        });
        $scope.refreshTopics = function ($sid) {
            Data.GetTopics($.param({sub_id: $sid})).success(function (d) {
                $scope.topics = d;
            });
        }
        Data.GetSideviewd().success(function (d) {
            $('#sidemenu').html(d);
        });
    }]);
app.controller('homepage', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        Data.GetQuote().success(function (d) {
            $scope.quote = d;
        });
        Data.GetTodolist().success(function (d) {
            $scope.todo = d;
        });
        Data.GetSideviewd().success(function (d) {
            $('#sidemenu').html(d);
        });
    }]);
app.controller('studymaterial', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        Data.GetSubjectStudy().success(function (d) {
            $scope.subject = d;
        });
        $scope.toggle_top = function (id, sid, tid) {
            $('#' + id).slideToggle('slow');
            $rootScope.subid = sid;
            $rootScope.tid = tid;
        }
        Data.GetSideviewd().success(function (d) {
            $('#sidemenu').html(d);
        });
    }]);
app.controller('keyconcepts', ['$scope', '$rootScope', '$http', 'Data', '$routeParams', function ($scope, $rootScope, $http, Data, $routeParams) {
        Data.GetKeyConcepts($.param({subid: $routeParams.sid, topicid: $routeParams.tid})).success(function (d) {
            if (d.s == "1") {
                $scope.kc = d;
            } else {
                $scope.msg = d.msg;
                $scope.kc = d;
            }
        });
        Data.GetSideviewd().success(function (d) {
            $('#sidemenu').html(d);
        });
    }]);
app.controller('plannerController', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        Data.GetSideviewd().success(function (d) {
            $('#sidemenu').html(d);
        });
        $scope.cal = "";
        $cal = {y: ($rootScope.date.getYear() + 1900), m: ($rootScope.date.getMonth() + 1)}
        localStorage.setItem('date', JSON.stringify($cal));
        Data.GetCal($.param($cal)).success(function (d) {
            $scope.cal = d;
        });
        $scope.previous = function () {
            $cal = JSON.parse(localStorage.getItem('date'));
            if ($cal.m == 1) {
                $cal.m = 12;
                $cal.y = ($cal.y - 1);
            } else {
                $cal.m = $cal.m - 1;
            }
            localStorage.setItem('date', JSON.stringify($cal));
            Data.GetCalPrevNext($.param($cal)).success(function (d) {
                $scope.cal = d;
            });
        }
        $scope.next = function () {
            $cal = JSON.parse(localStorage.getItem('date'));
            if ($cal.m == 12) {
                $cal.m = 1;
                $cal.y = ($cal.y + 1);
            } else {
                $cal.m = $cal.m + 1;
            }
            localStorage.setItem('date', JSON.stringify($cal));
            Data.GetCalPrevNext($.param($cal)).success(function (d) {
                $scope.cal = d;
            });
        }

    }]);
app.controller('register', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.flag = false;
        $scope.flage = true;
        $scope.flagi = true;
        $scope.flagp = true;
        $scope.cities = [];
        var pay = {};
        Data.GetCities().success(function (d) {
            $scope.cities = d;
        });
        Data.GetBranches().success(function (d) {
            $scope.branchs = d;
        });
        Data.GetPayGetWay().success(function (d) {
            pay = d;
        });
        $scope.getCaldays = function (y, m) {
            Data.CalDays($.param({year: y, month: m})).success(function (d) {
                $scope.caldays = d;
            });
        };
        Data.GetInstitutes().success(function (d) {
            $scope.institute = d;
        });
        $scope.pay = function () {
            var options = {
                "key": "" + pay.key_id,
                "amount": "" + parseFloat(pay.amount) * 100, // 2000 paise = INR 20
                "name": "" + pay.name,
                "description": "" + pay.description,
                "image": site_url + "assets/images/" + pay.image,
                "handler": function (response) {
                    $rootScope.reg.payment_id = response.razorpay_payment_id;
                    $('#register').submit();
                },
                "prefill": {
                    "name": $rootScope.reg.f_name + " " + $rootScope.reg.l_name,
                    "email": $rootScope.reg.regemail
                },
                "notes": {
                    "address": ""
                },
                "theme": {
                    "color": "#449D44"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
        $scope.signup = function () {
//            document.getElementById('submit').disabled = true;
            $('#loader').html("<img src='assets/images/loading.gif' >");
            $.each($scope.reg, function (k, v) {
                if (k != "dob" || k != "i_code") {
                    if ($rootScope.reg[k] == "") {
                        $scope.flag = ErrorDisplay(k, {status: 2, msg: k + ' is Required', d: true});
                    } else {
                        $scope.flag = ErrorDisplay(k, {status: 1, msg: '', d: false});
                    }
                }
                if (k == "dob") {
                    if ($rootScope.reg[k].y == "" || $rootScope.reg[k].m == "" || $rootScope.reg[k].d == "") {
                        $scope.flag = ErrorDisplay('dob_y', {status: 2, msg: 'Date of birth Year Required', d: true});
                        $scope.flag = ErrorDisplay('dob_m', {status: 2, msg: 'Date of birth Month Required', d: true});
                        $scope.flag = ErrorDisplay('dob_d', {status: 2, msg: 'Date of birth Date Required', d: true});
                    } else {
                        $scope.flag = ErrorDisplay('dob_y', {status: 1, msg: '', d: false});
                        $scope.flag = ErrorDisplay('dob_m', {status: 1, msg: '', d: false});
                        $scope.flag = ErrorDisplay('dob_d', {status: 1, msg: '', d: false});
                    }
                }
                if (k == "i_code") {
                    $scope.flag = ErrorDisplay(k, {status: 1, msg: '', d: false});
                }
            });
            if ($rootScope.reg.regemail != "") {
                Data.CheckEmail($.param({email: $rootScope.reg.regemail})).success(function (d) {
                    if (d.s == '1') {
                        $scope.flage = ErrorDisplay('regemail', {status: 2, msg: 'Email Already Exist', d: true});
                    } else {
                        if ($rootScope.reg.i_code_present == "yes" && $rootScope.reg.i_code != "") {
                            Data.CheckICode($.param({i_code: $rootScope.reg.i_code})).success(function (d) {
                                if (d.s == '0') {
                                    $scope.flagi = ErrorDisplay('i_code', {status: 2, msg: 'Invitation Code Does not Exist', d: true});
                                } else {
                                    $scope.flagi = ErrorDisplay('i_code', {status: 1, msg: '', d: false});
                                }
                            });
                        }
                        if ($rootScope.reg.i_code_present == "no" && $rootScope.reg.payment_id == "") {
                            alertify.errorAlert("<b style='color:red'>You have to pay first.</b>");
                            $scope.flagi = ErrorDisplay('pay', {status: 2, msg: 'You have to pay first.', d: false});
                        } else {
                            $scope.flagi = ErrorDisplay('pay', {status: 1, msg: '', d: true});
                        }
                        if ($rootScope.reg.password != $rootScope.reg.repass) {
                            $scope.flagp = ErrorDisplay('repass', {status: 2, msg: 'Password does not match', d: true});
                        } else {
                            $scope.flagp = ErrorDisplay('repass', {status: 1, msg: "", d: false});
                            if ($scope.flag && $scope.flage && $scope.flagi && $scope.flagp) {
                                Data.Signup($.param($scope.reg)).success(function (d) {
                                    $('#loader').html("");
                                    if (d.s == '1') {
                                        $('#reg_info').html('<center><h4>User Registration Successful.<br>Verify yourself by clicking on the link sent to your mail box.</h4></center>');
                                    } else if (d.s == '2') {
                                        $('#reg_info').html('<center><h4>User Registration Successful.<br>But did not sent mail. please contact to roughsheet support team!</h4></center>');
                                    }
                                });
                            }
                        }
                    }
                });
            }
        }
    }]);
app.controller('contactus', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.flag = false;
        $scope.user = {
            Name: "",
            Email: "",
            Subject: "",
            Message: ""
        };
        $scope.send = function () {
            $.each($scope.user, function (k, v) {
                if ($scope.user[k] == "") {
                    $scope.flag = ErrorDisplay(k, {status: 2, msg: k + ' is Required', d: true});
                } else {
                    $scope.flag = ErrorDisplay(k, {status: 1, msg: '', d: false});
                }
            });
            if ($scope.flag) {
                Data.ContactMe($.param($scope.user)).success(function (d) {
                    if (d.s == "1") {
                        $x = ErrorDisplay('submit_id', {status: 1, msg: 'Mail Send Successfully.', d: true});
                    } else {
                        $x = ErrorDisplay('submit_id', {status: 2, msg: d.msg, d: true});
                    }
                });
            }
        }
    }]);