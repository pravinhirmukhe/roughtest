/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//window.fbAsyncInit = function () {
    FB.init({
        appId: "951223461670082",
        status: true,
        cookie: true,
        xfbml: true,
        version: 'v2.7'
    });
//};
app.filter('range', function () {
    return function (input, total) {
        total = total.split("-");
        tot1 = parseInt(total[0]);
        tot2 = parseInt(total[1]);
        for (var i = tot1; i > tot2; i--) {
            input.push(i);
        }
        return input;
    };
});
app.filter('in_array', function () {
    return function (input, total) {
        if ($.inArray(input, total) == -1) {
            return false
        } else {
            return input;
        }
    };
});
app.filter('daterange', function () {
    return function (input, total) {
        tot1 = parseInt(new Date().getFullYear());
        tot2 = tot1 - parseInt(total);
        for (var i = tot1; i > tot2; i--) {
            input.push(i);
        }
        return input;
    };
});
app.factory('myInterceptor',
        function ($q, $rootScope) {
            var interceptor = {
                'request': function (config) {
                    $rootScope.loading = 1;
                    // Successful request method
                    return config; // or $q.when(config);
                },
                'response': function (response) {
                    $rootScope.loading = 0;
                    // successful response
                    return response; // or $q.when(config);
                },
                'requestError': function (rejection) {
                    // an error happened on the request
                    // if we can recover from the error
                    // we can return a new request
                    // or promise
                    return response; // or new promise
                    // Otherwise, we can reject the next
                    // by returning a rejection
                    // return $q.reject(rejection);
                },
                'responseError': function (rejection) {
                    // an error happened on the request
                    // if we can recover from the error
                    // we can return a new response
                    // or promise
                    return rejection; // or new promise
                    // Otherwise, we can reject the next
                    // by returning a rejection
                    // return $q.reject(rejection);
                }
            };
            return interceptor;
        });
app.factory('facebookService', function ($q) {
    return {
        getLogin: function () {
            var deferred = $q.defer();
            FB.login(function (response) {
                if (response.authResponse) {
                    FB.api('/me', {fields: 'id,first_name,last_name,email,gender,link'}, function (response) {
                        if (!response || response.error) {
                            deferred.reject('Error occured');
                        } else {
                            deferred.resolve(response);
                        }
                    });
                }
            }, {scope: 'email,user_friends'});
            return deferred.promise;
        },
        getFBFriends: function () {
            var deferred = $q.defer();
            FB.api('/me/friends', function (response) {
                if (!response || response.error) {
                    deferred.reject('Error occured');
                } else {
                    deferred.resolve(response);
                }
            });
            return deferred.promise;
        }
    }
});
app.service('Data', function ($http) {
    this.Login = function ($data) {
        return $http.post(site_url + "User_controller/login", $data);
    };
    this.GetPayGetWay = function ($data) {
        return $http.post(site_url + "User_controller/getPayGetWay", $data);
    };
    this.CheckUPass = function ($data) {
        return $http.post(site_url + "User_controller/checkpass", $data);
    };
    this.GetCities = function ($data) {
        return $http.post(site_url + "User_controller/getCities", $data);
    };
    this.GetInstitutes = function ($data) {
        return $http.post(site_url + "User_controller/getInstitutes", $data);
    };
    this.GetBranches = function ($data) {
        return $http.post(site_url + "User_controller/getBranches", $data);
    };
    this.ChangePass = function ($data) {
        return $http.post(site_url + "User_controller/changepass", $data);
    };
    this.CalDays = function ($data) {
        return $http.post(site_url + "User_controller/calDays", $data);
    };
    this.Signup = function ($data) {
        return $http.post(site_url + "User_controller/signup", $data);
    };
    this.CheckEmail = function ($data) {
        return $http.post(site_url + "User_controller/checkEmail", $data);
    };
    this.CheckICode = function ($data) {
        return $http.post(site_url + "User_controller/checkICode", $data);
    };
    this.ContactMe = function ($data) {
        return $http.post(site_url + "User_controller/contactus", $data);
    };
    this.ContactUsTo = function ($data) {
        return $http.post(site_url + "User_controller/contactusto", $data);
    };
    /*Home*/
    this.GetQuote = function ($data) {
        return $http.post(site_url + "User_controller/getQuote", $data);
    };
    this.FbLogin = function ($data) {
        return $http.post(site_url + "fblogin", $data);
    };
    this.ReSendActv = function ($data) {
        return $http.post(site_url + "User_controller/resendAct", $data);
    };
    this.ForgetPassword = function ($data) {
        return $http.post(site_url + "User_controller/forgetpass", $data);
    };
    this.GetFBConnect = function ($data) {
        return $http.post(site_url + "User_controller/getFBConnect", $data);
    };
    /*Home*/

    /*Planner*/
    this.GetCal = function ($data) {
        return $http.post(site_url + "Planner_controller/getCal", $data);
    };
    this.GetCalPrevNext = function ($data) {
        return $http.post(site_url + "Planner_controller/getCal", $data);
    };
    this.GetSubject = function ($data) {
        return $http.post(site_url + "Planner_controller/getSubjects", $data);
    };
    this.GetTopics = function ($data) {
        return $http.post(site_url + "Planner_controller/getTopics", $data);
    };
    this.GetTodolist = function ($data) {
        return $http.post(site_url + "Planner_controller/todolist", $data);
    };
    /*Planner*/

    /*Study Material*/
    this.GetSubjectStudy = function ($data) {
        return $http.post(site_url + "Study_controller/getSubjects", $data);
    };
    this.GetKeyConcepts = function ($data) {
        return $http.post(site_url + "Study_controller/setKC", $data);
    };
    this.SetInstr = function ($data) {
        return $http.post(site_url + "Study_controller/setInstr", $data);
    };
    this.GetExam = function ($data) {
        return $http.post(site_url + "Study_controller/getExam", $data);
    };
    /*Study Material*/

    /*Friends*/
    this.GetFriends = function ($data) {
        return $http.post(site_url + "Friends_controller/getFriends", $data);
    };
    this.GetProfile = function ($data) {
        return $http.post(site_url + "Friends_controller/getProfile", $data);
    };
    this.GetSideview = function ($data) {
        return $http.post(site_url + "Friends_controller/getSideMenu", $data);
    };
    this.GetSideviewd = function () {
        return $http.post(site_url + "Friends_controller/getSideMenud");
    };
    this.SetUpdatePer = function ($data) {
        return $http.post(site_url + "Friends_controller/setUpdatePer", $data);
    };
    this.SetUpdateProf = function ($data) {
        return $http.post(site_url + "Friends_controller/setUpdateProf", $data);
    };
    this.SetUpdateAcad = function ($data) {
        return $http.post(site_url + "Friends_controller/setUpdateAcad", $data);
    };
    this.GetFriendSearch = function ($data) {
        return $http.post(site_url + "Friends_controller/search", $data);
    };
    this.GetUnfriend = function ($data) {
        return $http.post(site_url + "Friends_controller/unfriend", $data);
    };
    this.GetConfirmed = function ($data) {
        return $http.post(site_url + "Friends_controller/confirm", $data);
    };
    this.GetReject = function ($data) {
        return $http.post(site_url + "Friends_controller/reject", $data);
    };
    this.GetMConfirmed = function ($data) {
        return $http.post(site_url + "Friends_controller/mconfirm", $data);
    };
    this.GetMReject = function ($data) {
        return $http.post(site_url + "Friends_controller/mreject", $data);
    };
    this.GetAddfriend = function ($data) {
        return $http.post(site_url + "Friends_controller/addfriend", $data);
    };
    this.SetPrivacySetting = function ($data) {
        return $http.post(site_url + "Friends_controller/setPrivacySetting", $data);
    };
    /*Friends*/


    /*DPPS*/

    this.GetTDPPS = function ($data) {
        return $http.post(site_url + "Practice_controller/getTPPS", $data);
    };
    this.GetTPP = function ($data) {
        return $http.post(site_url + "Practice_controller/getTPP", $data);
    };

    /*DPPS*/

    /*Focus Area*/

    this.GetFocusArea = function ($data) {
        return $http.post(site_url + "Focus_controller/getFocusArea", $data);
    };

    /*Focus Area*/
    /*Performance*/

    this.GetPerformance = function ($data) {
        return $http.post(site_url + "Performance_controller/getPerformance", $data);
    };
    this.Getgraphs = function ($data) {
        return $http.post(site_url + "Performance_controller/getGraph", $data);
    };
    this.GetRankGraph = function ($data) {
        return $http.post(site_url + "Performance_controller/getRankGraph", $data);
    };
    this.GetRankGraphPCs = function ($data) {
        return $http.post(site_url + "Performance_controller/getRankGraphPC", $data);
    };
    this.GetRankGraphWs = function ($data) {
        return $http.post(site_url + "Performance_controller/getRankGraphW", $data);
    };
    this.GetRankGraphCs = function ($data) {
        return $http.post(site_url + "Performance_controller/getRankGraphC", $data);
    };
    this.GetChangePerfMonth = function ($data) {
        return $http.post(site_url + "Performance_controller/changepermonth", $data);
    };
    /*Performance*/

    /*Ranking*/
    this.GetRanking = function ($data) {
        return $http.post(site_url + "Rank_controller/getRanking", $data);
    };
    this.GetRankingDomains = function ($data) {
        return $http.post(site_url + "Rank_controller/getRankingDomains", $data);
    };
    this.GetRankingTypes = function ($data) {
        return $http.post(site_url + "Rank_controller/getRankingTypes", $data);
    };
    this.GetgenerateRanks = function ($data) {
        return $http.post(site_url + "Rank_controller/getGenerateRanks", $data);
    };
    /*Ranking*/



});