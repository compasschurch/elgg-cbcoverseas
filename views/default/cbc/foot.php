<?php

global $CBC;

$requireConfig = array(
	'baseUrl' => '/ajax/view/js',
	'paths' => array(),
	'shim' => array(
		'jquery/tinymce' => array(
			'deps' => array('jquery', 'tinymce'),
			'exports' => 'jQuery.prototype.tinymce',
		),
	),
);

foreach ($CBC->modules as $module) {
	$requireConfig['paths'][$module] = substr(elgg_get_simplecache_url("js", $module), 0, -3);
}

?>

<script>
	define('jquery', function() { return jQuery; });
	define('elgg', function() { return elgg; });
	define('angular', function() { return angular; });
	define('angular/module/ngResource', function() { return angular.module('ngResource'); });
	define('angular/module/ngSanitize', function() { return angular.module('ngSanitize'); });
	define('moment', function() { return moment; });
	define('pagedown', function() { return Markdown; });
	define('tinymce', function() { return tinymce; });
	requirejs.config(<?php echo json_encode($requireConfig); ?>);
</script>
