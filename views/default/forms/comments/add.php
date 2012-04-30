<?php
/**
 * Elgg comments add form
 *
 * @package Elgg
 *
 * @uses ElggEntity $vars['entity'] The entity to comment on
 * @uses bool       $vars['inline'] Show a single line version of the form?
 */

$entity = $vars['entity'];

if ($entity && $entity->canComment()) {
?>
	<div>
		<?php echo elgg_view('input/plaintext', array('name' => 'generic_comment')); ?>
	</div>
	<footer class="elgg-foot">
		<?php echo elgg_view('input/submit', array('value' => elgg_echo("generic_comments:post"))); ?>
	</footer>
<?php
	
	echo elgg_view('input/hidden', array(
		'name' => 'entity_guid',
		'value' => $vars['entity']->getGUID()
	));
}
