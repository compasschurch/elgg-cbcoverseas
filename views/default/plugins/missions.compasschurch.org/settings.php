<?php

$posters = $vars['plugin']->posters;

?>

<div class="elgg-input-wrapper">
	<label>Who can post:</label><br/>
	<textarea name="params[posters]" class="elgg-input-textarea"><?php echo $posters; ?></textarea>
</div>

<pre>
	<?php echo cbcoverseas_get_activity_email_content(); ?>
</pre>