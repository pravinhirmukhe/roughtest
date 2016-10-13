/**
 * 
 * @type @exp;angular@call;module
 */

app = angular.module('flybuy', ['ui.bootstrap']);
app.config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    }]);
app.run(function ($rootScope, Data) {
    $rootScope.changeStatus = function (k, i, t) {
        chStatus = {key: k, id: i, tab: t};
        Data.ChangeStat($.param(chStatus)).success(function (d) {
            if (d.status) {
                oTable.fnDraw();
            } else {
                alert("Error");
                oTable.fnDraw();
            }
        });
    }
});
app.controller('manage_owner', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {

    }]);
app.controller('searchbar', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.terminal = [];
        $scope.user = {};
        $scope.supplier = {};
        $scope.admin = {};
        $scope.airport = "Select Airport";
        $scope.getTer = function (id) {
            Data.Get_Terminal(id).success(function (d) {
                $scope.terminal = d;
            });
        };
        $scope.get_vendorlist = function (id) {
//            alert(id);
          $http.post(site_url + "admin/Admin_controller/get_vendorlist/"+id).success(function (data) {
            $scope.supplier = data;
        });
        };
    }]);
app.controller('State', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.state = [];
        $scope.userdata = {};
        $scope.airport = "Select State";
        $scope.getState = function (id) {
            Data.Get_State(id).success(function (data) {
                $scope.state = data;
            });
        };
    }]);
app.controller('notification', ['$scope', '$rootScope', '$http', function ($scope, $rootScope, $http) {
        $scope.vendor = {};
        $scope.user = {};
        $scope.noti = {};
         $http.post(site_url + "admin/Admin_controller/get_notification").success(function (data) {
            $scope.noti = data;
        });
//         $http.post(site_url + "User_controller/getcategory_add").success(function (data) {
//            $scope.user = data;
//        });
       
    }]);
