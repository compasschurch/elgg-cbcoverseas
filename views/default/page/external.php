<?php
/**
 * Elgg pageshell
 * The standard HTML page shell that everything else fits into
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['title']       The page title
 * @uses $vars['body']        The main content of the page
 * @uses $vars['sysmessages'] A 2d array of various message registers, passed from system_messages()
 */

// render content before head so that JavaScript and CSS can be loaded. See #4032
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
$header = elgg_view('page/elements/header', $vars);
$body = elgg_view('page/elements/body', $vars);
$footer = elgg_view('page/elements/footer', $vars);

// Set the content type
header("Content-type: text/html; charset=UTF-8");

$lang = get_current_language();

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
	<?php echo elgg_view('page/elements/head', $vars); ?>
</head>
<body>
<div class="elgg-page elgg-page-default">
	<div class="elgg-page-messages">
		<?php echo $messages; ?>
	</div>
	
	<header class="elgg-page-header">
		<div class="elgg-inner">
			<h1>
			<?php 
				echo elgg_view('output/url', array(
					'href' => elgg_get_site_url(),
					'text' => elgg_get_site_entity()->name,
					'class' => 'elgg-heading-site',
				));
			?>
			</h1>
		</div>
	</header>
	
	<div class="elgg-page-body">
		<div class="elgg-inner">
			<?php echo $body; ?>
		</div>
	</div>

	<footer class="elgg-page-footer">
		<div class="elgg-inner">
			<?php echo $footer; ?>
		</div>
	</footer>
</div>
<?php echo elgg_view('page/elements/foot'); ?>
</body>
</html>
