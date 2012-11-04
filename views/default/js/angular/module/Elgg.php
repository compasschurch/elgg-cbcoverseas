// <script>
define(function(require) {
	var angular = require('angular');    
	var ngSanitize = require('angular/module/ngSanitize');
	var ngResource = require('angular/module/ngResource');
	var moment = require('moment');
	var pagedown = require('pagedown');
	var elgg = require('elgg');
	var ElggDatabase = require('elgg/Database');
	
	var Elgg = angular.module('Elgg', ['ngSanitize', 'ngResource']);
	
	// Move this to a "pagedown" module?
	Elgg.value('markdown', new pagedown.Converter());
	
	// Move these to a "moment" module?
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
	
	// Actual Elgg-specific stuff
	Elgg.value('elgg', elgg);
	Elgg.value('elggDatabase', new ElggDatabase());
	Elgg.value('elggSession', require('elgg/session'));
	
	Elgg.directive('elggRiver', require('angular/directive/elggRiver/factory'));
	Elgg.directive('elggRiverComment', require('angular/directive/elggRiverComment/factory'));
	Elgg.directive('elggRiverItem', require('angular/directive/elggRiverItem/factory'));
	Elgg.directive('elggUsers', require('angular/directive/elggUsers/factory'));
	
	Elgg.config(function($routeProvider, $locationProvider) {
		$locationProvider.html5Mode(true);
		$routeProvider.when('/activity', {
			template: require('text!angular/view/site/activity/template.html'),
			controller: require('angular/view/site/activity/Controller')
		});
	});
	
	var CbcOverseas = require('cbc/Overseas');
	// CBC Overseas extensions
	Elgg.directive('cbcPosters', require('angular/directive/cbcPosters/factory'));
	Elgg.value('cbcOverseas', new CbcOverseas());
	
	return Elgg;
});