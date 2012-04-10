<?php
/**
 * View for blog objects
 *
 * @package Blog
 */

$blog = $vars['entity'];

$byline = evan_view_entity('byline', $blog);
$tags = elgg_view('output/tags', array('tags' => $blog->tags));
$comments_link = '';

// The "on" status changes for comments, so best to check for !Off
if ($blog->comments_on != 'Off') {
	$comments_count = $blog->countComments();
	//only display if there are commments
	if ($comments_count != 0) {
		$comments_link = elgg_view('output/url', array(
			'href' => $blog->getURL() . '#blog-comments',
			'text' => elgg_echo("comments") . " ($comments_count)",
			'is_trusted' => true,
		));
	}
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'blog',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$summary = elgg_view('object/elements/summary', array_merge($vars, array(
	'entity' => $blog,
	'title' => false,
	'metadata' => $metadata,
	'subtitle' => "$byline $comments_link",
	'tags' => $tags,
)));

$icon = elgg_view_entity_icon($blog->getOwnerEntity(), 'tiny');

$body = elgg_view('output/longtext', array(
	'value' => $blog->description,
	'class' => 'blog-post',
));

?>

<article>
	<h3><?php echo evan_view_entity('link', $blog); ?></h3>
	<?php
		echo elgg_view('object/elements/full', array(
			'summary' => $summary,
			'icon' => $icon,
			'body' => $body,
		));
	?>
</article>