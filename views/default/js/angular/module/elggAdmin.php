// <script>
define(function(require) {
	var angular = require('angular');
	var Elgg = require('angular/module/Elgg');
	
	var elggAdmin = angular.module('elggAdmin', ['Elgg']);
	
	elggAdmin.directive('elggUsers', require('angular/directive/elggUsers/factory'));

	elggAdmin.config(function($routeProvider) {
		$routeProvider.when('/admin/plugins/:plugin/settings', {
			template: require('text!angular/view/admin/plugins/settings/template.html'),
			controller: require('angular/view/admin/plugins/settings/Controller'),
			resolve: {
				plugin: function(elggDatabase, $route) {
					return elggDatabase.getPlugin($route.current.params.plugin);
				}
			}
		});
	});
	
	return elggAdmin;
})