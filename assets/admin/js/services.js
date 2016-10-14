app.service('Data', function ($http) {
    this.GetTopic = function ($id) {
        return $http.get(site_url + "User_controller/getTerminal/" + $id);
    };
   });