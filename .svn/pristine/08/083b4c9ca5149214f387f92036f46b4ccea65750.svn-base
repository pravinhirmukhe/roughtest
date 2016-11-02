
app = angular.module('adminrough', ['ngSanitize']);
app.config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
        //$httpProvider.interceptors.push('myInterceptor');
    }]);
app.run(function ($rootScope, Data) {
    $rootScope.subid = 0;
    $rootScope.tid = 0;
    $rootScope.forgetemail = "";
    $rootScope.months = [{val: 1, name: 'Jan'}, {val: 2, name: 'Feb'}, {val: 3, name: 'Mar'}, {val: 4, name: 'Apr'}, {val: 5, name: 'May'}, {val: 6, name: 'Jun'}, {val: 7, name: 'Jul'}, {val: 8, name: 'Aug'}, {val: 9, name: 'Sep'}, {val: 10, name: 'Oct'}, {val: 11, name: 'Nov'}, {val: 12, name: 'Dec'}]
    $rootScope.date = new Date();
    $rootScope.fb_friends = [];
    $rootScope.chpuser = {flag: false, cpass: "", pass: "", repass: ""};
    $rootScope.contact = {sub: "", msg: ""};
    $rootScope.setKc = function (sid, tid) {
        $rootScope.subid = sid;
        $rootScope.tid = tid;
    }

});
app.controller('subject', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.topic = [];
        $scope.user = {};
        $scope.getTopicName = function (id) {
            Data.GetTopic($.param({id: id})).success(function (d) {
                $scope.topic = d;
            });
        };
    }]);
app.controller('userprofile', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {

        $scope.edit = false;
        $scope.fid = "";
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
        $scope.getData  = function (id) {
            
        Data.GetUserProfile($.param({fid: id})).success(function (d) {
           
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
        };


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

    }]);




