<?php
/**
 * Elgg Angular-enabled pageshell
 */

elgg_load_js('requirejs');
elgg_load_js('pagedown');
elgg_load_js('moment');
elgg_load_js('angular');
elgg_load_js('angular/module/ngResource');
elgg_load_js('angular/module/ngSanitize');


// render content before head so that JavaScript and CSS can be loaded. See #4032
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
$topbar = elgg_view('page/elements/topbar', $vars);
$header = elgg_view('page/elements/header', $vars);
$footer = elgg_view('page/elements/footer', $vars);

// Set the content type
header("Content-type: text/html; charset=UTF-8");

?>
<!doctype html>
<html>
<head>
	<?php echo elgg_view('page/elements/head', $vars); ?>
</head>
<body>
<div class="elgg-page elgg-page-default">
	<div class="elgg-page-messages">
		<?php echo $messages; ?>
	</div>
	
	<?php if (elgg_is_logged_in()): ?>
	<div class="elgg-page-topbar">
		<div class="elgg-inner">
			<?php echo $topbar; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="elgg-page-header">
		<div class="elgg-inner">
			<?php echo $header; ?>
		</div>
	</div>
	<div class="elgg-page-body">
		<div class="elgg-inner">
			<?php echo $vars['body']; ?>
		</div>
	</div>
</div>
<?php echo elgg_view('page/elements/foot'); ?>
<script>
	define('jquery', function() { return jQuery; });
	define('elgg', function() { return elgg; });
	define('angular', function() { return angular; });
	define('angular/module/ngResource', function() { return angular; });
	define('angular/module/ngSanitize', function() { return angular; });
	define('moment', function() { return moment; });
	define('pagedown', function() { return Markdown; });
	requirejs.config({
		baseUrl: "/ajax/view/js",
		paths: {
			'activitystreams/Collection': '<?php echo elgg_get_simplecache_url("js", "activitystreams/Collection"); ?>'.slice(0, -3),
			'angular/directive/cbcPosters/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/directive/cbcPosters/Controller"); ?>'.slice(0, -3),
			'angular/directive/cbcPosters/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/cbcPosters/factory"); ?>'.slice(0, -3),
			'angular/directive/elggRiver/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiver/Controller"); ?>'.slice(0, -3),
			'angular/directive/elggRiver/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiver/factory"); ?>'.slice(0, -3),
			'angular/directive/elggRiverComment/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiverComment/Controller"); ?>'.slice(0, -3),
			'angular/directive/elggRiverComment/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiverComment/factory"); ?>'.slice(0, -3),
			'angular/directive/elggRiverItem/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiverItem/Controller"); ?>'.slice(0, -3),
			'angular/directive/elggRiverItem/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiverItem/factory"); ?>'.slice(0, -3),
			'angular/directive/focusOn/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/focusOn/factory"); ?>'.slice(0, -3),
			'angular/view/site/activity/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/view/site/activity/Controller"); ?>'.slice(0, -3),
			'angular/module/Elgg': '<?php echo elgg_get_simplecache_url("js", "angular/module/Elgg"); ?>'.slice(0, -3),
			'cbc/Overseas': '<?php echo elgg_get_simplecache_url("js", "cbc/Overseas"); ?>'.slice(0, -3),
			'elgg/River': '<?php echo elgg_get_simplecache_url("js", "elgg/River"); ?>'.slice(0, -3),
			'text': '<?php echo elgg_get_simplecache_url("js", "text"); ?>'.slice(0, -3)
		},
		deps: ['angular/module/Elgg'],
		callback: function() {
			angular.bootstrap(document.body, ['Elgg']);
		}
	});
</script>
</body>
</html>