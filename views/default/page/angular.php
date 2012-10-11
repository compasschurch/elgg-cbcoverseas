<?php
/**
 * Elgg Angular-enabled pageshell
 */

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
		<div class="elgg-inner" data-ng-view>
			<!-- Angular fills in this area -->
		</div>
	</div>
	<div class="elgg-page-footer">
		<div class="elgg-inner">
			<?php echo $footer; ?>
		</div>
	</div>
</div>
<?php echo elgg_view('page/elements/foot'); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.0.6/require.min.js"></script>
<script>
	define('jquery', function() { return jQuery; });
	define('elgg', function() { return elgg; });
	define('angular', function() { return angular; });
	define('angular/module/ngResource', function() { return angular; });
	define('angular/module/ngSanitize', function() { return angular; });
	define('moment', function() { return moment; });
	define('showdown', function() { return Showdown; });
	requirejs.config({
		baseUrl: "/ajax/view",
		deps: ['angular/module/Elgg'],
		callback: function() {
			angular.bootstrap(document.body, ['Elgg']);
		}
	});
</script>
</body>
</html>