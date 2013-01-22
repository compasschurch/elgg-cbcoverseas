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
			'angular/directive/elggResponses/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggResponses/Controller"); ?>'.slice(0, -3),
			'angular/directive/elggResponses/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggResponses/factory"); ?>'.slice(0, -3),
			'angular/directive/elggRiver/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiver/Controller"); ?>'.slice(0, -3),
			'angular/directive/elggRiver/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiver/factory"); ?>'.slice(0, -3),
			'angular/directive/elggRiverComment/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiverComment/Controller"); ?>'.slice(0, -3),
			'angular/directive/elggRiverComment/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiverComment/factory"); ?>'.slice(0, -3),
			'angular/directive/elggRiverItem/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiverItem/Controller"); ?>'.slice(0, -3),
			'angular/directive/elggRiverItem/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggRiverItem/factory"); ?>'.slice(0, -3),
			'angular/directive/elggUsers/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggUsers/Controller"); ?>'.slice(0, -3),
			'angular/directive/elggUsers/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/elggUsers/factory"); ?>'.slice(0, -3),
			'angular/directive/focusOn/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/focusOn/factory"); ?>'.slice(0, -3),
			'angular/directive/whenScrolled/factory': '<?php echo elgg_get_simplecache_url("js", "angular/directive/whenScrolled/factory"); ?>'.slice(0, -3),
			'angular/module/Elgg': '<?php echo elgg_get_simplecache_url("js", "angular/module/Elgg"); ?>'.slice(0, -3),
			'angular/module/elggAdmin': '<?php echo elgg_get_simplecache_url("js", "angular/module/elggAdmin"); ?>'.slice(0, -3),
			'angular/module/elggDefault': '<?php echo elgg_get_simplecache_url("js", "angular/module/elggDefault"); ?>'.slice(0, -3),
			'angular/view/admin/plugins/settings/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/view/admin/plugins/settings/Controller"); ?>'.slice(0, -3),
			'angular/view/blog/view/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/view/blog/view/Controller"); ?>'.slice(0, -3),
			'angular/view/photos/all/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/view/photos/all/Controller"); ?>'.slice(0, -3),
			'angular/view/site/activity/Controller': '<?php echo elgg_get_simplecache_url("js", "angular/view/site/activity/Controller"); ?>'.slice(0, -3),
			'cbc/Overseas': '<?php echo elgg_get_simplecache_url("js", "cbc/Overseas"); ?>'.slice(0, -3),
			'elgg/Database': '<?php echo elgg_get_simplecache_url("js", "elgg/Database"); ?>'.slice(0, -3),
			'text': '<?php echo elgg_get_simplecache_url("js", "text"); ?>'.slice(0, -3)
		}
	});
</script>
