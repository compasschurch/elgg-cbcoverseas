// <script>
define(function(require) {
	var angular = require('angular');
	var Elgg = require('angular/module/Elgg');
	
	var elggDefault = angular.module('elggDefault', ['Elgg']);
	
	elggDefault.directive('elggResponses', require('angular/directive/elggResponses/factory'));
	elggDefault.directive('elggRiver', require('angular/directive/elggRiver/factory'));
	elggDefault.directive('elggRiverComment', require('angular/directive/elggRiverComment/factory'));
	elggDefault.directive('elggRiverItem', require('angular/directive/elggRiverItem/factory'));

	elggDefault.config(function($routeProvider) {
		$routeProvider.when('/activity', {
			template: require('text!angular/view/site/activity/template.html'),
			controller: require('angular/view/site/activity/Controller'),
			resolve: {
				river: function(elggDatabase) {
					return elggDatabase.getActivity();
				}
			}
		}).when('/blog/view/:guid', {
			template: require('text!angular/view/blog/view/template.html'),
			controller: require('angular/view/blog/view/Controller'),
			resolve: {
				blog: function(elggDatabase, $route) {
					return elggDatabase.getEntity($route.current.params.guid);
				}
			}
		});
	});
	return elggDefault;
})