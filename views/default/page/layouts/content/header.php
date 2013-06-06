<?php
/**
 * Main content header
 *
 * Title and title menu
 *
 * @uses $vars['title']   Title text (override)
 * @uses $vars['context'] Page context (override)
 */

$context = elgg_extract('context', $vars, elgg_get_context());

$title = elgg_extract('title', $vars, elgg_echo($context));
$title = elgg_view_title($title, array('class' => 'elgg-heading-main'));

$menu = elgg_view_menu('title', array(
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

echo <<<HTML
	$menu
	$title
HTML;
