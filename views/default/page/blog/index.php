<?php
$title = elgg_echo('page:blog:index:title');

elgg_register_title_button();

$blogs = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'blog',
));

$content = '<ul class="elgg-list elgg-list-blog">';
foreach ($blogs as $blog) {
	$content .= '<li class="elgg-item">' . evan_view_entity('full', $blog) . '</li>';
}
$content .= '</ul>';

$body = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
	'sidebar' => elgg_view('blog/sidebar'),
	'filter' => false,
));

echo elgg_view_page($title, $body);