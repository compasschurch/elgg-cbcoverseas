define(function(require) {
    var angular = require('angular');    
    var ngSanitize = require('angular/module/ngSanitize');
    var ngResource = require('angular/module/ngResource');
    var moment = require('moment');
    var Showdown = require('showdown');
    var elgg = require('elgg');
    
    var Elgg = angular.module('Elgg', ['ngSanitize', 'ngResource']);
    
    // Move this to a "showdown" module?
    Elgg.value('showdown', new Showdown.converter());
    
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
    
    
    // Actual Elgg-specific stuff
    Elgg.value('elgg', elgg);
    
    Elgg.directive('elggRiverItem', require('angular/directive/elggRiverItem/factory'));
    
    Elgg.directive('elggRiverComment', require('angular/directive/elggRiverComment/factory'));
    
    Elgg.config(function($routeProvider) {
		$routeProvider.when('/activity', {
			template: require('text!angular/view/site/activity/template.html'),
			controller: require('angular/view/site/activity/Controller')
		}).otherwise({redirectTo:'/activity'});
	});
	
    Elgg.value('elggSession', require('elgg/session'));
    
    return Elgg;
});