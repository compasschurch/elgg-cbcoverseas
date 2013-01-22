<?php

global $CBC;

$requireConfig = array(
	'baseUrl' => '/ajax/view/js',
	'paths' => array(),
);

foreach ($CBC->modules as $module) {
	$requireConfig['paths'][$module] = substr(elgg_get_simplecache_url("js", $module), 0, -3);
}

?>

<script>
	define('jquery', function() { return jQuery; });
	define('elgg', function() { return elgg; });
	define('angular', function() { return angular; });
	define('angular/module/ngResource', function() { return angular; });
	define('angular/module/ngSanitize', function() { return angular; });
	define('moment', function() { return moment; });
	define('pagedown', function() { return Markdown; });
	requirejs.config(<?php echo json_encode($requireConfig); ?>);
</script>
