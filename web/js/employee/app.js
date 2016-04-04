'use strict';

 angular.module("config", [])

.constant("ENV", {
  "apiEndpoint": "/employee/v1/"
})

angular.module('employee.controllers', []);
angular.module('employee.services', []);
angular.module('employee', ['ionic', 'config', 'employee.controllers',
  'employee.services', 'ngMessages', 'LocalStorageModule'])

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

.factory('Account', function($http, $rootScope, ENV) {
  return {
    login: function(username, password) {
      return $http.post(ENV.apiEndpoint+'accounts/login', {
        username: username,
        password: password
      });
    }
  }
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
        Account.login($scope.user.username, $scope.user.password).success(function(data){
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
.controller('HomeCtrl', function($rootScope, $scope, $state) {
});

