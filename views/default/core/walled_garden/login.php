<?php
/**
 * Walled garden login
 */

$title = elgg_get_site_entity()->name;
$welcome = elgg_echo('walled_garden:welcome');
$welcome .= ': <br/>' . $title;

$menu = elgg_view_menu('walled_garden', array(
	'sort_by' => 'priority',
	'class' => 'elgg-menu-general elgg-menu-hz',
));

$login_box = elgg_view('core/account/login_box', array('module' => 'walledgarden-login'));

echo <<<HTML
<div class="elgg-col elgg-col-1of2">
	<div class="elgg-inner">
		<h1 class="elgg-heading-walledgarden">
			$welcome
		</h1>
		$menu
		<p>This is the new (more secure) home of the Jordan team!
		<p>You should have already received a new username + password if you were signed up for the Squarespace site.
	</div>
</div>
<div class="elgg-col elgg-col-1of2">
	<div class="elgg-inner">
		$login_box
	</div>
</div>
HTML;
