// JavaScript Document

var app = angular.module('app', ['ngResource', 'ngRoute']);

app.config(function($routeProvider,$locationProvider) {
	
	//$locationProvider.html5Mode(true);
	
	$routeProvider.when('/login',{
		templateUrl : 'views/login.html',
		controller: 'LoginController'
	});
	$routeProvider.when('/news',{
		templateUrl : 'views/home.html',
		controller: 'HomeController'
	});
	$routeProvider.when('/news/:id/edit',{
		templateUrl : 'views/addnews.html',
		controller: 'AddNewsController'
	});
	$routeProvider.when('/news/new',{
		templateUrl : 'views/addnews.html',
		controller: 'AddNewsController'
	});
	
	$routeProvider.otherwise({
		redirectTo: '/login'
	});
});

app.factory('ApiService', function() {
  return {
      url : 'http://localhost/angularjs/api/angularjs'
  };
});

app.controller('LoginController',function($scope,$location) {
	$scope.credentials = { username : "admin" , password: "123"};
	
	$scope.login = function() {
		if($scope.credentials.username == "admin") {
			$location.path("/news");
		}
	}
});
app.controller('AddNewsController',function($scope,$location,$resource,ApiService,$routeParams) {
	var NewsUpdate = $resource(ApiService.url + '/newsupdate/id/:id', { id : '@id' } );
	if($routeParams.id) {
		var newsUpdate = NewsUpdate.get($routeParams, function() {
			$scope.newsupdate = newsUpdate; 
		});		
	} else {
		$scope.newsupdate = { title: '' , description : '' };
	}
	/*var News = $resource(ApiService.url + '/newsupdates');
	var news = News.query(function() {
		$scope.news = news;
	});*/
	
	$scope.saveNews = function() {
		
		var newsUpdate = new NewsUpdate($scope.newsupdate);
		newsUpdate.$save(function(response) {
			$scope.newsupdate = { title: '' , description : '' };
			alert('Record saved');
		});
	}
});
app.controller('HomeController',function($scope,$resource,ApiService) {
	/*$http.get('news.json').success(function(data) {
		$scope.news = data;
	});*/
	var News = $resource(ApiService.url + '/newsupdates');
	var news = News.query(function() {
		$scope.news = news;
	});
});