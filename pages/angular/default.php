<?php
/**
 * Elgg Angular-enabled pageshell
 */

$vars = array();

// render content before head so that JavaScript and CSS can be loaded. See #4032
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
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
	
	<div class="elgg-page-header">
		<div class="elgg-inner">
			<?php echo $header; ?>
		</div>
	</div>
	
	<nav class="elgg-page-nav">
		<div class="elgg-inner">
			<?php echo elgg_view_menu('site'); ?>
		</div>
	</nav>

	<div class="elgg-page-body">
		<div class="elgg-inner" data-ng-view>
			<!-- Main content loaded here -->
			<div class="elgg-ajax-loader centered"></div>
		</div>
	</div>
</div>

<?php echo elgg_view('page/elements/foot'); ?>

<script>
require(['angular', 'angular/module/elggDefault'], function(angular) {
	angular.bootstrap(document.body, ['elggDefault']);
})
</script>

</body>
</html>
