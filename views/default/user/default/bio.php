<?php

$user = $vars['entity'];

?>

<article class="clearfix">
	<div class="float-alt mlm mbm"><?php echo elgg_view_entity_icon($user, 'large'); ?></div>
	<h2><?php echo evan_view_entity('link', $user); ?></h2>
	<div class="elgg-subtext"><?php echo elgg_view('output/text', array('value' => $user->briefdescription)); ?></div>
	<?php echo elgg_view('output/longtext', array('value' => $user->description)); ?>
</article>