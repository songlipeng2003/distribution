'use strict';

 angular.module("config", [])

.constant("ENV", {
  "apiEndpoint": "/employee/v1/"
})

angular.module('employee.services', []);
angular.module('employee.controllers', ['employee.services']);
angular.module('employee', ['ionic', 'config', 'employee.controllers',
  'employee.services', 'ngMessages', 'LocalStorageModule', 'ngResource'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider
    .state('home', {
      url: '/home',
      templateUrl: '/templates/employee/home.html',
      controller: 'HomeCtrl'
    })
    .state('rank', {
      url: '/rank',
      templateUrl: '/templates/employee/rank.html',
      controller: 'RankCtrl'
    })
    .state('spread', {
      url: '/spread',
      templateUrl: '/templates/employee/spread.html',
      controller: 'RankCtrl'
    })
    .state('login', {
      url: '/login',
      templateUrl: '/templates/employee/login.html',
      controller: 'LoginCtrl'
    });
     $urlRouterProvider.otherwise('/login');
})
.run(function ($rootScope, $state, $window, localStorageService) {
  var isLogin = localStorageService.get('isLogin');
  if(isLogin){
    $rootScope.isLogin = true;
    $rootScope.currentUser = localStorageService.get('currentUser');
  }else{
    $rootScope.isLogin = false;
    $rootScope.currentUser = {};
  }
  $rootScope.login = function(user){
    localStorageService.set('isLogin', true);
    localStorageService.set('currentUser', user);
    $rootScope.isLogin = true;
    $rootScope.currentUser = user;
    $state.go('home');
  }

  $rootScope.checkLogin = function(){
    if(!$rootScope.isLogin){
      $state.go('login');
    }
  }
})


// services
angular.module('employee.services')

.factory('Account', function($resource, ENV) {
  return $resource(ENV.apiEndpoint + 'accounts', {}, {
    login: {
      url: ENV.apiEndpoint + 'accounts/login',
      method:'POST',
    }
  });
})
.factory('Employee', function($rootScope, $resource, ENV) {
  return $resource(ENV.apiEndpoint + 'employee', {}, {
    query: {params: {'access-token': $rootScope.currentUser.token}, isArray: true}
  });
});


// controllers
angular.module('employee.controllers')

.controller('LoginCtrl', function($rootScope, $scope, $state, $ionicPopup, Account) {
  $scope.user = {};
  // if($rootScope.isLogin){
  //   $rootScope.login($rootScope.currentUser);
  // }
  $scope.login = function(form){
    if(form.$valid){
        Account.login($scope.user, function(data){
          if(data.code===0){
            $rootScope.login(data.data);
          }else{
            $ionicPopup.alert({
              title: '登录失败',
              template: data.msg
            })
          }
        });
    }
  }
})
.controller('HomeCtrl', function() {
})
.controller('RankCtrl', function($scope, $state, Employee) {
  $scope.employees = [];
  $scope.page = 0;
  $scope.haveMore = true;
  $scope.pageSize = 10;

  $scope.listByPage = function(clear){
    return Employee.query({page: $scope.page, pageSize: $scope.pageSize}, function(result){
      var data = result;
      if(data.length==$scope.pageSize){
        $scope.haveMore = true;
        $scope.page = $scope.page + 1;
      }else{
        $scope.haveMore = false;
      }
      if(clear){
        $scope.employees = data;
      }else{
        $scope.employees = $scope.employees.concat(data);
      }

      $scope.$broadcast('scroll.infiniteScrollComplete');
    })
  };

  $scope.loadMore = function(){
      if($scope.haveMore){
        $scope.listByPage(false);
    }
  }

  $scope.refreshData = function(){
    $scope.page = 0;
    $scope.listByPage(true);
  }
})
.controller('SpreadCtrl', function() {
});
