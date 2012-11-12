// <script>
define(function(require) {
	var angular = require('angular');    
	var ngSanitize = require('angular/module/ngSanitize');
	var ngResource = require('angular/module/ngResource');
	
	var Elgg = angular.module('Elgg', ['ngSanitize', 'ngResource']);
	
	// Move this to a "pagedown" module?
	var pagedown = require('pagedown');
	Elgg.value('markdown', new pagedown.Converter());
	
	// Move these to a "moment" module?
	var moment = require('moment');
	Elgg.value('moment', moment);
	Elgg.filter('fromNow', function() {
	    return function(dateString) {
	        return moment(new Date(dateString)).fromNow();
	    };
	});
	Elgg.filter('calendar', function() {
	    return function(dateString) {
	        return moment(new Date(dateString)).calendar();
	    };
	});
	
	// Super-handy for forcing focus based on model values
	Elgg.directive('focusOn', require('angular/directive/focusOn/factory'));
	
	// Infinite scrolling made simple
	Elgg.directive('whenScrolled', require('angular/directive/whenScrolled/factory'));
	
	// Elgg-specific stuff
	Elgg.value('elgg', require('elgg'));
	Elgg.service('elggDatabase', require('elgg/Database'));
	Elgg.value('elggSession', require('elgg/session'));
	Elgg.value('elggLoggedInUser', require('elgg/session').user);
		
	Elgg.config(function($routeProvider, $locationProvider) {
		$locationProvider.html5Mode(true);
		$routeProvider.otherwise({
			redirectTo: function() { 
				var targetHref = window.location.href;
				window.history.back();
				setTimeout(function() {
					window.location.href = targetHref;
				}, 0);
				
			}
		});
	});
	
	// CBC Overseas extensions
	Elgg.directive('cbcPosters', require('angular/directive/cbcPosters/factory'));
	Elgg.service('cbcOverseas', require('cbc/Overseas'));
	
	return Elgg;
});