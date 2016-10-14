
/**
 * 
 * @type @exp;angular@call;module
 */
app = angular.module('flybuy', ['ui.bootstrap', 'ngSanitize']);
app.config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    }]);
//app.run(function ($rootScope, Data) {
//});
app.controller('searchbar', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.terminal = [];
        $scope.airport = {};
        $scope.getTer = function (id) {
            Data.GetTerminal(id).success(function (d) {
                $scope.terminal = d;
            });
        }
    }]);

app.controller('Profile', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.state = [];
        $scope.city = [];
        $scope.userdata = {};
//        $scope.airport = "Select State";
        $scope.getState = function (id) {
            Data.Get_State(id).success(function (data) {
                $scope.state = data;
            });
        };
        $scope.getCity = function (id) {
            Data.Get_City(id).success(function (data) {
                $scope.city = data;
            });
        };
        $scope.setDefault = function (id) {
//            alert(id);
            Data.set_Default(id).success(function (data) {
                $scope.city = data;
            });
        };
    }]);

app.controller('category', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.cat = {};
        $scope.sub_cat = {};
        $scope.product = {};
        $scope.menu = {};

        $http.post(site_url + "User_controller/getcategory_add").success(function (data) {
            $scope.cat = data;
        });
        $http.post(site_url + "User_controller/get_menu").success(function (data) {
            $scope.menu = data;
        });
        $scope.get_category = function ($id) {
            $('#drop' + $id).css('display', 'block').addClass('alert-success');
            $http.post(site_url + "User_controller/get_category/" + $id).success(function (data) {
                $scope.sub_cat = data;
            });
            $http.post(site_url + "User_controller/getcatproduct/" + $id).success(function (data) {
                $scope.product = data;
            });
        };

        $scope.get_catproduct = function ($id) {
//            alert($id);
            $scope.product = {};
            $http.post(site_url + "User_controller/get_catproduct/" + $id).success(function (data) {
                $scope.product = data;
                window.location.replace(site_url + 'Product');
            });
        };
        $scope.get_catproduct1 = function ($id) {
//            alert($id);
            $scope.product = {};
            $http.post(site_url + "User_controller/getcatproduct/" + $id).success(function (data) {
                $scope.product = data;
//                window.location.reload(site_url+'Product');
            });
        };
        $scope.get_subcategory = function ($id) {
            $('#sdrop' + $id).css('display', 'block').addClass('alert-success');
            $http.post(site_url + "User_controller/get_subcategory/" + $id).success(function (data) {
                $scope.sub_cat = data;
            });
        };
    }]);
app.controller('product', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.cat = {};
        $scope.sub_cat = {};
        $scope.menu = {};
        $http.post(site_url + "User_controller/get_menu").success(function (data) {
            $scope.menu = data;
        });
        $http.post(site_url + "User_controller/getcategory_add").success(function (data) {
            $scope.cat = data;
        });
        $scope.get_category = function ($id) {
            $scope.sub_cat = {};
            $http.post(site_url + "User_controller/get_category/" + $id).success(function (data) {
                $scope.sub_cat = data;
            });
        };

        $scope.get_catproduct = function ($id) {
//            alert($id);
            $scope.product = {};
            $http.post(site_url + "User_controller/get_catproduct/" + $id).success(function (data) {
                $scope.product = data;
                window.location.reload(site_url + 'views/user/layout/product-grid-block');
            });
        };
        $scope.get_catproduct1 = function ($id) {
//            alert($id);
            $scope.product = {};
            $http.post(site_url + "User_controller/getcatproduct/" + $id).success(function (data) {
                $scope.product = data;
//                window.location.reload(site_url+'Product');
            });
        };
    }]);
app.controller('product_search', ['$scope', '$rootScope', '$http', 'Data', function ($scope, $rootScope, $http, Data) {
        $scope.cart = {};
        $http.post(site_url + "User_controller/cart_item").success(function (data) {
            $scope.cart = data;
        });
        $scope.Add_cart = function (id) {
            var q = $("input[name='qty[]']:text").val();
            if (q > 1) {
                $qty = q;
            } else {
                $qty = 1;
            }
            data = {
                id: id,
                qty: $qty
            };
            $.ajax({
                url: site_url + "User_controller/Add_To_Cart",
                data: data,
                cache: false,
                type: 'POST',
                success: function (data) {
                    $scope.cart = data;
                    var data = JSON.parse(data);
//                    alert(data.res);
//                    if (data) {
//                        $('#success').text('Item Add Successfully');
//                        $('#div_success').css('display', 'block').addClass('alert-success');
////                        window.location.reload(site_url + 'views/user/layout/header');
//                    } else if(data==2){
//                        $('#success').text('Item Adding Failed');
//                        $('#div_success').css('display', 'block').addClass('alert-danger');
//                    }
                    if (data.s==1) {
                        $('#success').text(data.res);
                        $('#div_success').css('display', 'block').addClass('alert-success');
                        window.location.reload(site_url + 'views/user/layout/header');
                    } else if (data.s == 2) {
                        $('#success').text('Only  '+data.res+'  Items In Stock');
                        $('#div_success').css('display', 'block').addClass('alert-info');
                    }else if(data.s == 3){
                         $('#success').text(data.res);
                        $('#div_success').css('display', 'block').addClass('alert-warning');
                    }
                    else{
                         $('#success').text('Item Adding Failed');
                        $('#div_success').css('display', 'block').addClass('alert-danger');
                    }
//                     alert($scope.cart);
                }
            });
        };
        $scope.Compare = function (id) {
            data = {
                id: id
            };
            $.ajax({
                url: site_url + "User_controller/Compare_Product",
                data: data,
                cache: false,
                type: 'POST',
                success: function (data) {
                    $scope.cart = data;
                    if (data != "") {
                        $('#success').text('Item Add Successfully For Compare');
                        $('#div_success').css('display', 'block').addClass('alert-success');
                        window.location.reload(site_url + 'views/user/layout/productslider');
                    } else {
                        $('#success').text('Item Adding Failed');
                        $('#div_success').css('display', 'block').addClass('alert-danger');
                    }
//                     alert($scope.cart);
                }
            });
        };
        $scope.remove_cart = function (rowid) {
            data = {
                id: rowid
            };
            var key = confirm('Do You Want to Delete Record?');
            if (key == true) {
                $.ajax({
                    type: "POST",
                    url: site_url + 'User_controller/remove_From_Cart',
                    data: data,
                    cache: false,
                    success: function (data)
                    {
                        $('.basket-item-count').html(data);
                        location.reload();
                    }
                });
            }
        };
    }]);
