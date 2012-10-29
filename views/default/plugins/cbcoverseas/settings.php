<?php

$plugin = $vars['plugin'];

?>

<div class="elgg-input-wrapper">
	<label><?php echo elgg_echo('object:plugin:cbcoverseas:posters:label'); ?></label><br/>
	<textarea name="params[posters]" class="elgg-input-textarea"><?php echo $plugin->posters; ?></textarea>
</div>

Preview of what the daily email notification looks like:
<pre>
	<?php echo cbcoverseas_get_activity_email_content(); ?>
</pre>