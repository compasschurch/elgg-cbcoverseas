<?php global $CBC; ?>
// <script>
define(function(require) {
	var angular = require('angular');
	var Elgg =    require('angular/module/Elgg');
	
	var elggDefault = angular.module('elggDefault', ['Elgg']);
	
	<?php 
	foreach ($CBC->directives as $directive) {
		echo "elggDefault.directive('$directive', require('angular/directive/$directive/factory'));\n";
	}
	
	foreach ($CBC->filters as $filter) {
		echo "elggDefault.filter('$filter', require('angular/filter/$filter'));\n";
	}
	?>

	elggDefault.config(function($routeProvider) {
		<?php
		foreach ($CBC->views as $pattern => $view) {
			echo "\$routeProvider.when('$pattern', require('angular/view/$view/route'));\n";
		}
		?>
	});

	return elggDefault;
});
